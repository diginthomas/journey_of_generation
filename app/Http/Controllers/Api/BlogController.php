<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ValidationRepository;
use App\Http\Repositories\CommonRepository;
use App\Http\Traits\CommonFunctions;
use App\Models\BlogLike;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    use CommonFunctions;

    public function index(Request $request, CommonRepository $commonRepo)
    {
        $search = $request->input('search');
        $userId = $this->getUserIdFromToken($request);
        $blogs = $commonRepo->getBlogs(true)
            ->when($search != '', function ($query) use ($search) {
                $query->where(function ($subquery) use ($search) {
                    $subquery->orWhere('title', 'LIKE', "%{$search}%");
                });
            })
            ->paginate(4);
        foreach ($blogs as $blog) {
            $blog->image = Storage::url('blog_images/' . $blog->image);
            $blog->date = Carbon::parse($blog->created_at)->format('M d, Y');
            $blog->likes = $blog->blogLikes()->count();
            $blog->is_liked = $blog->blogLikes()->where('user_id', $userId)->exists();
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
}
