@extends('main')

@section('title', 'Create New Post')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
    {!! Html::style('css/select2.css') !!}
@stop

@section('content')

    <div class="row">
        <div class="col-md-5 col-md-offset-2">
            <h1>Create New Post</h1>
            <hr>

            {!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '']) !!}
                {{ Form::label('title', 'Title:') }}
                {{ Form::text('title', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

                {{ Form::label('slug', 'Slug:') }}
                {{ Form::text('slug', null, ['class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255']) }}

                {!! Form::label('category_id', 'Category:') !!}
                {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'required' => '']) !!}

                {!! Form::label('tags', 'Tags:') !!}
                {!! Form::select('tags', $tags, null, ['class' => 'form-control select2-multiple', 'name' => 'tags[]', 'multiple']) !!}

                {{ Form::label('body', 'Post Body:') }}
                {{ Form::textarea('body', null, ['class' => 'form-control', 'required' => '']) }}

                {{ Form::submit('Create Post', ['class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px']) }}
            {!! Form::close() !!}
        </div>
    </div>

@stop

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}
    {!! Html::script('js/select2.js') !!}

    <script type="text/javascript">
        $('.select2-multiple').select2();
    </script>
@stop