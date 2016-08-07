@extends('main')

@section('title', 'View Category')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>{{ $category->name }}</h1>
        </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <label>Created At: </label>
                    <p>{{ date('M j, Y:h:i a', strtotime($category->created_at)) }}</p>
                </dl>
                <dl class="dl-horizontal">
                    <label>Updated At: </label>
                    <p>{{ date('M j, Y:h:i a', strtotime($category->updated_at)) }}</p>
                </dl>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('categories.edit', 'Edit', [$category->id], ['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'delete']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
                        {!! Form::close() !!}
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {{ Html::linkRoute('categories.index', '<< See All Categories', [], ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop