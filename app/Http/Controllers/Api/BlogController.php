<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ValidationRepository;
use App\Http\Traits\CommonFunctions;
use App\Models\Blog;
use App\Models\BlogLike;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Repositories\CommonRepository;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    use CommonFunctions;

    public function index(Request $request,CommonRepository $commonRepo)
    {
        $search = $request->input('search');
        $userId = $this->getUserIdFromToken($request);
        $blogs = $commonRepo->getBlogs()
            ->when($search != '', function ($query) use ($search) {
                $query->where(function ($subquery) use ($search) {
                    $subquery->orWhere('title', 'LIKE', "%{$search}%");
                });
            })->paginate(4);

        foreach ($blogs as $blog) {
            $blog->image = Storage::url('blog_images/' . $blog->image);
            $blog->formatted_date = Carbon::parse($blog->created_at)->format('M d, Y, h:i:a');
            $blog->likes = $blog->blogLikes()->count();  
            if(!empty($userId)){
                $isLiked = $blog->blogLikes()->where('user_id', $userId)->exists();
            }else{
                $isLiked =false;
            }
            $blog->is_liked = $isLiked;
        }
        $response = ['status' => 'success', 'data' => $blogs];
        return response()->json($response, 200);
    }

    public function likeBlog(Request $request, ValidationRepository $validationRepo)
    {
        if ($validationRepo->validateBlogLike($request)->fails()) {
            $response = [
                'status' => 'validationError',
                'messages' => $validationRepo->blogFormValidation($request)->messages(),
            ];
            $statusCode = 403;
        } else {
            $userId = Auth::id();
            $blogID = $request->input('blog_id');
            $statusCode = 200;
            if ($request->input('like') == 1) {
                $data = ['user_id' => $userId, 'blog_id' => $blogID];
                $like = BlogLike::firstOrCreate($data, $data);
                $message = 'blog liked successfully';
            } else {
                BlogLike::where('user_id', $userId)
                    ->where('blog_id', $blogID)
                    ->delete();
                $message = 'blog like removed successfully ';
            }
            $response = ['status' => 'success', 'message' => $message];
        }
        return response()->json($response, $statusCode);
    }
    public function view(Request $request,CommonRepository $commonRepo) 
    {
        $userId = $this->getUserIdFromToken($request);
        $blogID = $request->input('blog_id');
        $blog = $commonRepo->getBlogs()->find($blogID);
        if(!empty($blog)){
            $blog->image = Storage::url('blog_images/' . $blog->image);
            $blog->formatted_date = Carbon::parse($blog->created_at)->format('M d, Y, h:i:a');
            $blog->likes = $blog->blogLikes()->count();
            if(!empty($userId)){
                $isLiked = $blog->blogLikes()->where('user_id', $userId)->exists();
            }else{
                $isLiked =false;
            }
            $blog->is_liked = $isLiked;
        }
        $response = ['status'=>'success','data'=>$blog];
        return response()->json($response, 200);
    }
}
