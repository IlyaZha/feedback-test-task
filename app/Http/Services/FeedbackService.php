<?php

namespace App\Http\Services;

use App\Models\Feedback;
use Illuminate\Http\UploadedFile;

class FeedbackService {

    public function __construct(private Feedback $feedback)
    {
    }

    public function store(
        string $email,
        string $userName,
        int $rating,
        string $comment,
        ?UploadedFile $photo
    ): void
    {
        $feedback = $this->feedback->newInstance();
        $feedback->email = $email;
        $feedback->user_name = $userName;
        $feedback->rating = $rating;
        $feedback->comment = $comment;

        if ($photo) {
            $name = $photo->getFilename();
            $path = $photo->storeAs('uploads', $name, 'public');
            $feedback->photo = $path;
        }

        $feedback->save();
    }

    public function list($sortByRating)
    {
        if ($sortByRating) {
            $feedbacks = $this->feedback->orderBy('rating', 'desc')->orderBy('created_at', 'desc')->get();
        } else {
            $feedbacks = $this->feedback->orderBy('created_at', 'desc')->get();
        }
        return $feedbacks;
    }
}
