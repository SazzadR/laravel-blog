@extends('main')

@section('title', 'All Categories')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
@stop

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Categories</h1>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th>{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td><a href="{{ route('categories.show', $category->id) }}" class="btn btn-default btn-sm">View</a> <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-default btn-sm">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-3">
            <div class="well">
                {!! Form::open(['route' => 'categories.store', 'method' => 'post', 'data-parsley-validate' => '']) !!}
                <h2>New Category</h2>
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) !!}

                    {!! Form::submit('Add New Category', ['class' => 'btn btn-primary btn-block form-spacing-top']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}
@stop