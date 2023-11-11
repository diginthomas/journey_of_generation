<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\CommonRepository;
use Carbon\Carbon;

class QuoteController extends Controller
{
    public function index(CommonRepository $commonRepo)
    {
        $quotes = $commonRepo->getQuotes()
            ->where('created_at','>=',Carbon::today())
            ->get();
        return response()->json($quotes);
    }
}
