@extends('main')

@section('title', "$post->title")

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
@stop

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{ $post->title }}</h1>
            <p>{!! $post->body !!}</p>
            <hr>
            <p>Posted In: <i>{{ $post->category->name }}</i></p>
            <hr>
            <div class="tags">
                @foreach($post->tags as $tag)
                    <span class="label label-default">{{ $tag->name }}</span>
                @endforeach
            </div>
        </div>

        <div class="col-md-8 col-md-offset-2"><hr></div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3 class="comment-title">
                    <span class="glyphicon glyphicon-comment"></span> {{ $post->comments()->count() }} {{ $post->comments()->count() > '1' ? 'Comments' : 'Comment' }}
                </h3>
                @foreach($post->comments as $comment)
                    <div class="comment">
                        <div class="author-info">
                            <img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?s=50&d=monsterid" }}" class="author-image">
                            <div class="author-name">
                                <h4>{{ $comment->name }}</h4>
                                <p class="author-time">{{ date('F nS, Y - g:iA', strtotime($comment->created_at)) }}</p>
                            </div>
                        </div>
                        <div class="comment-content">
                            {{ $comment->comment }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-8 col-md-offset-2"><hr></div>

        <div class="row">
            <div id="comment-form" class="col-md-8 col-md-offset-2">
                {!! Form::open(['route' => ['comments.store', $post->id], 'data-parsley-validate' => '']) !!}
                    <div class="col-md-6">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) !!}
                    </div>

                    <div class="col-md-6">
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::email('email', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) !!}
                    </div>

                    <div class="col-md-12">
                        {!! Form::label('comment', 'Comment:') !!}
                        {!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5', 'required' => '', 'maxlength' => '4000']) !!}
                    </div>

                    <div class="col-md-12">
                        {{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block submit-btn']) }}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}
@stop