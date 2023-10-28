<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Picnic;

class PicnicController extends Controller
{
   public function index()
   {
         return view('picnic.list');
   }

   public function picnicList(Request $request )
   {
    $columns = array('sl_no', 'title', 'location', 'date', 'time', 'description', 'agenda','action');
    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');
    $search = $request->input('search.value');
    $totalData = Picnic::count();

    $picnics = Picnic::select('title','location','date','time','description','agenda')
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
    // "dd($picnics);
    $json_data = array(
        "draw" => intval($request->input('draw')),
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data" => $picnics,

    );
    return response()->json($json_data);

    }

    function addPicnic()
    {

    }
    
    function savePicnic(Request $request)
    {

    }

    function editPicnic($pic)
    {

    }

    function viewPicnic($picnicId)
    {

    }


}
