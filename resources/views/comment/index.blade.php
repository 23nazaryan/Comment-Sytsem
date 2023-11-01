@extends('layouts.app')

@section('content')
    <div class="card mt-3" style="">
        <div class="card-body">
            <h5 class="card-title">{{ $comment->user->name }}</h5>
            <p class="card-text">{{ $comment->message }}</p>
            <div class="card-footer text-muted">
                {{ $comment->childs()->count() }} comment
            </div>
        </div>
    </div>

    <div class="card mt-3" style="">
        <div class="card-body">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            <form action="{{ route('comment.store') }}" method="POST">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <div class="mb-3 p-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" rows="3" name="message"></textarea>
                </div>

                <div class="mb-3 ml-3">
                    <button class="btn btn-success" type="submit" style="color: black;">Add comment</button>
                </div>
            </form>
        </div>
    </div>

    @foreach($comment->childs as $comment)
        <div class="card mt-3" style="">
            <div class="card-body">
                <h5 class="card-title">{{ $comment->user->name }}</h5>
                <p class="card-text">{{ $comment->message }}</p>
                <div class="card-footer text-muted">
                    {{ $comment->childs()->count() }} comment
                </div>
                <a href="{{ route('comment.show', $comment) }}" class="btn btn-primary mt-2">leave comment</a>

                <div class="mt-3 ml-4">
                    @foreach($comment->childs as $comment)
                        <h5 class="card-title">{{ $comment->user->name }}</h5>
                        <p class="card-text">{{ $comment->message }}</p>
                        <div class="card-footer text-muted" style="width: 123px;">
                            {{ $comment->childs()->count() }} comment
                        </div>
                        <a href="{{ route('comment.show', $comment) }}" class="btn btn-primary mt-2">leave comment</a>
                    @endforeach

                    <div class="mt-3 ml-4">
                        @foreach($comment->childs as $comment)
                            <h5 class="card-title">{{ $comment->user->name }}</h5>
                            <p class="card-text">{{ $comment->message }}</p>
                            <div class="card-footer text-muted" style="width: 123px;">
                                {{ $comment->childs()->count() }} comment
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
