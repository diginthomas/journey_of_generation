<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CommonRepository;
use App\Http\Traits\CommonFunctions;
use App\Models\PicnicMember;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PicnicController extends Controller
{
    use CommonFunctions;
    public function index(Request $request, CommonRepository $commonRepo)
    {
        $search = $request->input('search');
        $userId = $this->getUserIdFromToken($request);
        $picnics = $commonRepo->getPicnics()
            ->where('date', '>', Carbon::today())
            ->when($search != '', function ($query) use ($search) {
                $query->where(function ($subquery) use ($search) {
                    $subquery->orWhere('title', 'LIKE', "%{$search}%")
                        ->orWhere('location', 'LIKE', "%{$search}%");
                });
            })->paginate(4);

        foreach ($picnics as $picnic) {
            $picnic->image = Storage::url('picnic_images/' . $picnic->image);
            $picnic->formatted_date = Carbon::parse($picnic->date)->format('M d, Y, h:i:a');
        }
        $response = ['status' => 'success', 'data' => $picnics];
        return response()->json($response, 200);
    }
    public function view(Request $request, CommonRepository $commonRepo)
    {
        $userId = $this->getUserIdFromToken($request);
        $picnicId = $request->input('picnic_id');
        $picnic = $commonRepo->getPicnics()->find($picnicId);
        if (!empty($picnic)) {
            $picnic->image = Storage::url('picnic_images/' . $picnic->image);
            $picnic->formatted_date = Carbon::parse($picnic->date)->format('M d, Y, h:i:a');
            if (!empty($userId)) {
                $isJoined = $picnic->picnicMembers()->where('user_id', $userId)->exists();
            } else {
                $isJoined = false;
            }
            $picnic->is_joined = $isJoined;
        }
        $response = ['status' => 'success', 'data' => $picnic];
        return response()->json($response, 200);
    }
    public function joinPicnic(Request $request, CommonRepository $commonRepo)
    {
        $user = auth('sanctum')->user();
        $picnic = $commonRepo->getPicnics()->find($request->input('picnic_id'));
        if (!empty($picnic)) {
            $formData = $request->all();
            $formData['user_id'] = $user->id;
            $formData['role'] = $user->role;
            $members = PicnicMember::firstOrCreate($formData, $formData);
            $response = ['status' => 'success', 'message' => 'Successfully joined the picnic'];
        } else {
            $response = ['status' => 'error', 'message' => 'Invalid picnic id'];
        }
        return response()->json($response, 200);
    }

}
