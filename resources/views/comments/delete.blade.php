@extends('main')

@section('title', 'DELETE COMMENT?')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>DELETE THIS COMMENT?</h1>
            <p>
                <strong>Name:</strong> {{ $comment->name }}<br>
                <strong>Email:</strong> {{ $comment->email }}<br>
                <strong>Comment:</strong> {{ $comment->comment }}
            </p>

            {!!  Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'delete']) !!}
                <div class="col-md-4">
                    {!! Form::submit('YES', ['class' => 'btn btn-primary btn-block btn-danger']) !!}
                </div>
                <div class="col-md-4">
                    {!! Html::linkRoute('posts.show', 'CANCEL', $comment->post->id, ['class' => 'btn btn-primary btn-block']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
