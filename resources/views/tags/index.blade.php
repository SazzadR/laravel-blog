@extends('main')

@section('title', 'All Tags')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
@stop

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Tags</h1>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <th>{{ $tag->id }}</th>
                        <td>{{ $tag->name }}</td>
                        <td><a href="{{ route('tags.show', $tag->id) }}" class="btn btn-default btn-sm">View</a> <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-default btn-sm">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-3">
            <div class="well">
                {!! Form::open(['route' => 'tags.store', 'method' => 'post', 'data-parsley-validate' => '']) !!}
                <h2>New Tag</h2>
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) !!}

                {!! Form::submit('Add New Tag', ['class' => 'btn btn-primary btn-block form-spacing-top']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}
@stop