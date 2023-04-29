<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Http\Services\FeedbackService;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{

    private const SORT_BY_RATING = 'rating';

    public function __construct(private FeedbackService $feedbackService)
    {
    }

    public function index()
    {
        return view('feedback');
    }

    public function store(FeedbackRequest $request)
    {
        $this->feedbackService->store(
            $request->input('email'),
            $request->input('user_name'),
            $request->input('rating'),
            $request->input('comment'),
            $request->hasFile('photo') ? $request->file('photo') : null
        );

        return redirect('/')->with('success', 'Thank you for your feedback!');
    }

    public function list(Request $request)
    {
        $sort = $request->input('sort', 'date');
        $sortByRating = $sort === self::SORT_BY_RATING;

        $feedbacks = $this->feedbackService->list($sortByRating);

        return view('feedback-list', compact('feedbacks', 'sort'));
    }

}
