<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SendReviewRequest;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = Review::orderBy('created_at', 'desc')->paginate(3);

        return view('pages.reviews')->with(['reviews' => $reviews]);
    }

    public function showSendForm(Request $request)
    {
        return view('pages.feedback');
    }

    public function sendReview(SendReviewRequest $request)
    {
        Review::create($request->all());

        return $request->wantsJson()
            ? new Response('', 201)
            : view('pages.feedback')->with(['isSended' => true]);
    }
}
