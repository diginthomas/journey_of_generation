<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\CommonFunctions;
use App\Http\Repositories\CommonRepository;
use App\Http\Repositories\ValidationRepository;
use App\Models\Blog;
use Carbon\Carbon;

class BlogController extends Controller
{
    use CommonFunctions;

    public function index()
    {
      return view('blog.list');

    }

    public function blogsData(Request $request, CommonRepository $commonRepo)
    {
      $columns = array('sl_no', 'title', 'location', 'date', 'agenda', 'status','action');
      $limit = $request->input('length');
      $start = $request->input('start');
      $order = $columns[$request->input('order.0.column')];
      $dir = $request->input('order.0.dir');
      $search = $request->input('search.value');
      $totalData = $commonRepo->getBlogs(false)->count();
      $blogs = $commonRepo->getBlogs(false)
          ->when($order == 'sl_no', function ($query) use ($dir) {
              $query->orderBy('created_at', $dir);
          })
          ->when($search != '', function ($query) use ($search) {
              $query->where(function ($subquery) use ($search) {
                  $subquery->orWhere('title', 'LIKE', "%{$search}%");
              });
          });

          if (empty($search)) {
              $totalFiltered = $totalData;
              $blogs = $blogs->when($limit > 0, function ($query) use ($start, $limit) {
                  $query->offset($start)
                      ->limit($limit);
              })->get();
          } else {
              $totalFiltered = $blogs->count();
              $blogs = $blogs->when($limit > 0, function ($query) use ($start, $limit) {
                  $query->offset($start)
                      ->limit($limit);
              })
              ->get();
          }
        $data = [];
        if(!empty($blogs))
        {
            foreach($blogs as $blog)
            {
                /* 'DT_RowId' (default name for DataTables to assign row ids) to set the row id for the dataTable - important */
                $nestedData['DT_RowId'] = 'row_'.$blog->id;
                $nestedData['title'] = $blog->title;
                $nestedData['date'] = Carbon::parse($blog->created_at)->format('M d, Y');
                $nestedData['author'] = $blog->author->first_name. ' ' .$blog->author->last_name;
                if ($blog->status == 1) {
                  $nestedData['status'] = config('buttons.active');
                } else {
                  $nestedData['status'] = config('buttons.inactive');
                }
                $nestedData['action'] = '';

                $nestedData['action'] .= '<a href="'.route('viewBlog', base64_encode($blog->id)).'"
                class="'.config('buttons.view-class').'" title="View"> '.config('buttons.view-icon').'</a>&nbsp;&nbsp;';

                $nestedData['action'] .= '<a href="'.route('editBlog', base64_encode($blog->id)).'"
                class="'.config('buttons.edit-class').'" title="Edit"> '.config('buttons.edit-icon').'</a>&nbsp;&nbsp;';

                $nestedData['action'] .= '<a href="javascript:void(0)" data-id="'.$blog->id.'"
                class="'.config('buttons.delete-class').'" title="Delete"> '.config('buttons.delete-icon').'</a>&nbsp;&nbsp;';


                $data[] = $nestedData;
            }
        }

        $response = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,

        ];
        return response()->json($response);

    }

    public function addBlog()
    {
      return view('blog.add');
    }

    public function editBlog($id, CommonRepository $commonRepo)
    {
      $blog = $commonRepo->getBlogs(false)->find(base64_decode($id));
      return view('blog.edit', compact('blog'));
    }

    public function saveBlog(Request $request, ValidationRepository $validationRepo)
    {
      if ($validationRepo->blogFormValidation($request)->fails()) {
        $response = [
          'status' => 'validationError',
          'messages' => $validationRepo->blogFormValidation($request)->messages()
        ];
      } else {
        $formData = $request->all();
        if ($request->input('status') == "on") {
          $formData['status'] = 1;
        } else {
          $formData['status'] = 0;
        }
        if ($request->has('image')) {
            $formData['image'] = $this->uploadImage($request,'image','blog_images');
        }
        $blog = Blog::updateOrCreate(['id' => $request->input('id')], $formData);
        if ( (!$blog->wasRecentlyCreated && $blog->wasChanged()) || (!$blog->wasRecentlyCreated && !$blog->wasChanged()) ) {
            $message = "Blog Updated Successfully!";
        }
        if ($blog->wasRecentlyCreated) {
            $message = "Blog Created Successfully!";
        }
        $response = [
          'status' => 'success',
          'message' => $message,
          'next' => route('blogs')
        ];
      }
      return response()->json($response);
    }

    function viewBlog($id, CommonRepository $commonRepo)
    {
        $blog = $commonRepo->getBlogs(false)->find(base64_decode($id));
        return view('blog.view',compact('blog'));
    }

    public function deleteBlog(Request $request, CommonRepository $commonRepo)
    {
      $commonRepo->getBlogs(false)->find($request->input('id'))->delete();
      return response()->json(['status' => 'success', 'message' => 'Blog Deleted Successfully']);
    }

}
