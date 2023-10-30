<?php

namespace App\Http\Controllers\Admin;
use App\Http\Repositories\CommonRepository;
use App\Http\Repositories\ValidationRepository;
use App\Http\Traits\CommonFunctions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Picnic;
use Carbon\Carbon;

class PicnicController extends Controller
{
   use CommonFunctions;

   public function index()
   {
         return view('picnic.list');
   }

   public function picnicList(Request $request , CommonRepository $commonRepo)
   {
      $columns = array('sl_no', 'title', 'location', 'date', 'agenda', 'status','action');
      $limit = $request->input('length');
      $start = $request->input('start');
      $order = $columns[$request->input('order.0.column')];
      $dir = $request->input('order.0.dir');
      $search = $request->input('search.value');
      $totalData = $commonRepo->getPicnics(false)->count();

      $picnics = $commonRepo->getPicnics(false)
          ->when($order == 'sl_no', function ($query) use ($dir) {
              $query->orderBy('created_at', $dir);
          })
          ->when($order == 'location', function ($query) use ($dir) {
              $query->orderBy('location', $dir);
          })
          ->when($order == 'date', function ($query) use ($dir) {
              $query->orderBy('date', $dir);
          })
          ->when($search != '', function ($query) use ($search) {
              $query->where(function ($subquery) use ($search) {
                  $subquery->orWhere('title', 'LIKE', "%{$search}%")
                      ->orWhere('location','LIKE',"%{$search}%");
              });
          });

      if (empty($search)) {
          $totalFiltered = $totalData;
          $picnics = $picnics->when($limit > 0, function ($query) use ($start, $limit) {
              $query->offset($start)
                  ->limit($limit);
          })->get();
      } else {
          $totalFiltered = $picnics->count();
          $picnics = $picnics->when($limit > 0, function ($query) use ($start, $limit) {
              $query->offset($start)
                  ->limit($limit);
          })
          ->get();
      }
    $data = [];
    if(!empty($picnics))
    {
        // $i = 1;
        foreach($picnics as $picnic)
        {
            /* 'DT_RowId' (default name for DataTables to assign row ids) to set the row id for the dataTable - important */
            $nestedData['DT_RowId'] = 'row_'.$picnic->id;
            $nestedData['title'] = $picnic->title;
            $nestedData['location'] = $picnic->location;
            $date = Carbon::parse($picnic->date)->format('M d, Y, h:i:a');
            // $time = Carbon::parse($picnic->date)->format('H:i:s');
            $nestedData['date'] = $date;
            // $nested_data['time'] = $time;
            $nestedData['agenda'] = $picnic->agenda;
            if ($picnic->status == 1) {
              $nestedData['status'] = config('buttons.active');
            } else {
              $nestedData['status'] = config('buttons.inactive');
            }
            $nestedData['action'] = '';

            $nestedData['action'] .= '<a href="'.route('viewPicnic', base64_encode($picnic->id)).'"
            class="'.config('buttons.view-class').'" title="View"> '.config('buttons.view-icon').'</a>&nbsp;&nbsp;';

            $nestedData['action'] .= '<a href="'.route('editPicnic', base64_encode($picnic->id)).'"
            class="'.config('buttons.edit-class').'" title="Edit"> '.config('buttons.edit-icon').'</a>&nbsp;&nbsp;';

            $nestedData['action'] .= '<a href="javascript:void(0)" data-id="'.$picnic->id.'"
            class="'.config('buttons.delete-class').'" title="Delete"> '.config('buttons.delete-icon').'</a>&nbsp;&nbsp;';


            $data[] = $nestedData;
        }
    }

    $jsonArray = array(
        "draw" => intval($request->input('draw')),
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data" => $data,

    );
    return response()->json($jsonArray);

    }

    function addPicnic()
    {
      return view('picnic.add');
    }

    function editPicnic($id, CommonRepository $commonRepo)
    {
      $picnic = $commonRepo->getPicnics(false)->find(base64_decode($id));
      return view('picnic.edit', compact('picnic'));
    }

    function savePicnic(Request $request, ValidationRepository $validationRepo)
    {
      if ($validationRepo->picnicFormValidation($request)->fails()) {
        $jsonArray = [
          'status' => 'validationError',
          'messages' => $validationRepo->picnicFormValidation($request)->messages()
        ];
      } else {
        $formData = $request->all();
        if($request->filled('date')) {
            $date = Carbon::parse($request->input('date'))->format('Y-m-d H:i:s');
            $formData['date'] = $date;
        }
        if ($request->input('status') == "on") {
          $formData['status'] = 1;
        } else {
          $formData['status'] = 0;
        }
        if ($request->has('image')) {
            $formData['image'] = $this->uploadImage($request,'image','picnic_images');
        }
        $picnic = Picnic::updateOrCreate(['id' => $request->input('id')], $formData);
        if ( (!$picnic->wasRecentlyCreated && $picnic->wasChanged()) || (!$picnic->wasRecentlyCreated && !$picnic->wasChanged()) ) {
            $message = "Picnic Updated Successfully!";
        }
        if ($picnic->wasRecentlyCreated) {
            $message = "Picnic Created Successfully!";
        }
        $jsonArray = [
          'status' => 'success',
          'message' => $message,
          'next' => route('picnic')
        ];
      }
      return response()->json($jsonArray);
    }

    function viewPicnic($id, CommonRepository $commonRepo)
    {
        $picnic = $commonRepo->getPicnics(false)->find(base64_decode($id));
        return view('picnic.view',compact('picnic'));
    }

    public function deletePicnic(Request $request, CommonRepository $commonRepo)
    {
      $commonRepo->getPicnics(false)->find($request->input('id'))->delete();
      return response()->json(['status' => 'success', 'message' => 'Picnic Deleted Successfully']);
    }

}
