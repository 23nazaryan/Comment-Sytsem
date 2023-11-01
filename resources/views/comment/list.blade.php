@extends('layouts.app')

@section('content')
    @foreach($comments as $comment)
        <div class="card mt-3" style="">
            <div class="card-body">
                <h5 class="card-title">{{ $comment->user->name }}</h5>
                <p class="card-text">{{ $comment->message }}</p>
                <div class="card-footer text-muted" style="width: 123px;">
                    {{ $comment->childs()->count() }} comment
                </div>
                <a href="{{ route('comment.show', $comment) }}" class="btn btn-primary mt-2">leave comment</a>

                <div class="mt-3 ml-4">
                    @foreach($comment->childs as $comment)
                        <div class="mt-3">
                            <h5 class="card-title">{{ $comment->user->name }}</h5>
                            <p class="card-text">{{ $comment->message }}</p>
                            <div class="card-footer text-muted" style="width: 123px;">
                                {{ $comment->childs()->count() }} comment
                            </div>
                            <a href="{{ route('comment.show', $comment) }}" class="btn btn-primary mt-2">leave comment</a>
                        </div>
                    @endforeach

                    <div class="mt-3 ml-4">
                        @foreach($comment->childs as $comment)
                            <div class="mt-3">
                                <h5 class="card-title">{{ $comment->user->name }}</h5>
                                <p class="card-text">{{ $comment->message }}</p>
                                <div class="card-footer text-muted" style="width: 123px;">
                                    {{ $comment->childs()->count() }} comment
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
