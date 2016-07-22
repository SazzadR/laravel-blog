@extends('main')

@section('title', 'Edit Blog Post')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
@stop

@section('content')

    <div class="row">
        {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'put', 'data-parsley-validate' => '']) !!}

        <div class="col-md-8">
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title', null, ['class' => 'form-control input-lg', 'required' => '', 'maxlength' => '255']) }}

            {{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
            {{ Form::text('slug', null, ['class' => 'form-control', 'required' => '']) }}

            {{ Form::label('body', 'Body:', ['class' => 'form-spacing-top']) }}
            {{ Form::textarea('body', null, ['class' => 'form-control', 'required' => '']) }}
        </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Created At: </dt>
                    <dd>{{ date('M j, Y:h:i a', strtotime($post->created_at)) }}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Updated At: </dt>
                    <dd>{{ date('M j, Y:h:i a', strtotime($post->updated_at)) }}</dd>
                </dl>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('posts.show', 'Cancel', [$post->id], ['class' => 'btn btn-danger btn-block']) !!}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::submit('Save Change', ['class' => 'btn btn-success btn-block']) }}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@stop

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}
@stop