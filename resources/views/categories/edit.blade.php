@extends('main')

@section('title', 'Edit Category')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
@stop

@section('content')

    <div class="row">
        {!! Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'put', 'data-parsley-validate' => '']) !!}

        <div class="col-md-8">
            {!! Form::label('name', 'Category Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control input-lg', 'required' => '', 'maxlength' => '255']) !!}
        </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Created At: </dt>
                    <dd>{{ date('M j, Y:h:i a', strtotime($category->created_at)) }}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Updated At: </dt>
                    <dd>{{ date('M j, Y:h:i a', strtotime($category->updated_at)) }}</dd>
                </dl>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('categories.show', 'Cancel', [$category->id], ['class' => 'btn btn-danger btn-block']) !!}
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