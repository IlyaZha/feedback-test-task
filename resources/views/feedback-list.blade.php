@extends('layouts')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2>User Ratings</h2>
            </div>
            <div class="col-md-6 text-right">
                <form class="form-inline" action="{{ route('feedback.list') }}" method="GET">
                    <label class="my-1 mr-2" for="sort">Sort by:</label>
                    <select class="form-control my-1 mr-sm-2" id="sort" name="sort" onchange="this.form.submit()">
                        <option value="date"{{ $sort === 'date' ? ' selected' : '' }}>Date</option>
                        <option value="rating"{{ $sort === 'rating' ? ' selected' : '' }}>Rating</option>
                    </select>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">User Name</th>
                <th scope="col">Rating</th>
                <th scope="col">Comment</th>
                <th scope="col">Photo</th>
            </tr>
            </thead>
            <tbody>
            @foreach($feedbacks as $feedback)
                <tr>
                    <td>{{ $feedback->created_at->format('Y-m-d') }}</td>
                    <td>{{ $feedback->user_name }}</td>
                    <td>{{ $feedback->rating }}</td>
                    <td>{{ $feedback->comment }}</td>
                    <td>
                        @if($feedback->photo)
                            <img src="{{ Storage::url($feedback->photo) }}" alt="Feedback Photo" width="100">
                        @else
                            No photo
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
