<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quote;
use App\Http\Repositories\CommonRepository;
use App\Http\Repositories\ValidationRepository;
use Carbon\Carbon;

class QuoteController extends Controller
{
    public function index()
    {
        return view('quote.list');
    }

    public function quoteList(Request $request,CommonRepository $commonRepo) 
    {
        $columns = array('sl_no', 'title', 'quote', 'published_on' ,'status','action');
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $totalData = Quote::count();
        $quotes = $commonRepo->getQuotes()
          ->when($order == 'sl_no', function ($query) use ($dir) {
              $query->orderBy('created_at', $dir);
          })
          ->when($search != '', function ($query) use ($search) {
              $query->where(function ($subquery) use ($search) {
                  $subquery->orWhere('quote','LIKE',"%{$search}%");
              });
          });

      if (empty($search)) {
          $totalFiltered = $totalData;
          $quotes = $quotes->when($limit > 0, function ($query) use ($start, $limit) {
              $query->offset($start)
                  ->limit($limit);
          })->get();
      } else {
          $totalFiltered = $quotes->count();
          $quotes = $picnics->when($limit > 0, function ($query) use ($start, $limit) {
              $query->offset($start)
                  ->limit($limit);
          })
          ->get();
      }
    $data  = [];
    if(!empty($quotes)){
        foreach($quotes as $quote){
            $nestedData['DT_RowId'] = 'row_'.$quote->id;
            $nestedData['quote'] = $quote->quote;
            $nestedData['published_on']= Carbon::parse($quote->created_at)->format('M d, Y, h:i:a');
            $nestedData['action'] = '';
            // $nestedData['action'] .= '<a href="'.route('viewPicnic', base64_encode($quote->id)).'"
            // class="'.config('buttons.view-class').'" title="View"> '.config('buttons.view-icon').'</a>&nbsp;&nbsp;';

            $nestedData['action'] .= '<a href="javascript:void(0)" id="edit-quote-button" data-id="'.$quote->id.'" class="'.config('buttons.edit-class').'" title="Edit"> '.config('buttons.edit-icon').'</a>&nbsp;&nbsp;';

            $nestedData['action'] .= '<a href="javascript:void(0)" data-id="'.$quote->id.'"
            class="'.config('buttons.delete-class').'" title="Delete"> '.config('buttons.delete-icon').'</a>&nbsp;&nbsp;';
            $data[] = $nestedData;
        }
    } 
    $json_data = array(
        "draw" => intval($request->input('draw')),
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data" => $data,

    );
    return response()->json($json_data); 
    }

    public function saveQuote(Request $request,ValidationRepository $validationRepo)  {
        if ($validationRepo->quoteFormValidation($request)->fails()) {
            $jsonArray = [
              'status' => 'validationError',
              'messages' => $validationRepo->quoteFormValidation($request)->messages()
            ];
         }else {
            $formData = $request->all();
            $quote = Quote::updateOrCreate(['id' => $request->input('id')], $formData);
            if ( (!$quote->wasRecentlyCreated && $quote->wasChanged()) || (!$quote->wasRecentlyCreated && !$quote->wasChanged()) ) {
                $message = "Quote Updated Successfully!";
            }
            if ($quote->wasRecentlyCreated) {
                $message = "Quote Created Successfully!";
            }
            $jsonArray = [
              'status' => 'success',
              'message' => $message,
              'next' => route('picnic')
            ];
          }
        return response()->json($jsonArray);  
    }
    public function editQuote(Request $request, CommonRepository $commonRepo){
      $quote = $commonRepo->getQuotes()->find($request->input('id'));
      return response()->json($quote);
    }
    public function deleteQuote(Request $request)  {
        Quote::where('id', $request->input('id'))->delete();
        return response()->json(['status' => 'success', 'message' => 'Quote Deleted Successfully']);
    }

}
