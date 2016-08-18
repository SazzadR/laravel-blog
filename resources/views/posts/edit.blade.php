@extends('main')

@section('title', 'Edit Blog Post')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
    {!! Html::style('css/select2.css') !!}
@stop

@section('content')

    <div class="row">
        {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'put', 'data-parsley-validate' => '', 'files' => true]) !!}

        <div class="col-md-8">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class' => 'form-control input-lg', 'required' => '', 'maxlength' => '255']) !!}

            {!! Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) !!}
            {!! Form::text('slug', null, ['class' => 'form-control', 'required' => '']) !!}

            {!! Form::label('category_id', 'Category:', ['class' => 'form-spacing-top']) !!}
            {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'required' => '']) !!}

            {!! Form::label('featured_image', 'Featured Image:', ['class' => 'form-spacing-top']) !!}
            {!! Form::file('featured_image') !!}
            <div>
                @if(!empty($post->image))
                    <img src="{{ asset('images/' . $post->image) }}" class="img-thumbnail reduce-width">
                    <div>
                        {!! Form::label('remove_image', 'Remove Featured Image') !!}
                        {!! Form::checkbox('remove_image') !!}
                    </div>
                @else
                    <img src="{{ asset('images/placeholder.png') }}" class="img-thumbnail reduce-width">
                @endif
            </div>

            {!! Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) !!}
            {!! Form::select('tags', $tags, null, ['class' => 'form-control select2-multiple', 'name' => 'tags[]', 'multiple']) !!}

            {!! Form::label('body', 'Body:', ['class' => 'form-spacing-top']) !!}
            {!! Form::textarea('body', null, ['class' => 'form-control', 'required' => '']) !!}
        </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dl class="dl-horizontal">
                        <dt>{!! Form::label('featured_post', 'Set as Featured Post:') !!}</dt>
                        <dd>{!! Form::radio('featured_post', '0') !!}&nbsp;&nbsp;No &nbsp;&nbsp;{!! Form::radio('featured_post', '1') !!}&nbsp;&nbsp;Yes</dd>
                    </dl>
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
    {!! Html::script('js/select2.js') !!}
    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
    {!! Html::script('js/tinymce_init.js') !!}

    <script type="text/javascript">
        $('.select2-multiple').select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
    </script>
@stop