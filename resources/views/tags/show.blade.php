@extends('main')

@section('title', 'View Tag')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>{{ $tag->name }}</h1>
        </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <label>Created At: </label>
                    <p>{{ date('M j, Y:h:i a', strtotime($tag->created_at)) }}</p>
                </dl>
                <dl class="dl-horizontal">
                    <label>Updated At: </label>
                    <p>{{ date('M j, Y:h:i a', strtotime($tag->updated_at)) }}</p>
                </dl>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('tags.edit', 'Edit', [$tag->id], ['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'delete']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
                        {!! Form::close() !!}
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {{ Html::linkRoute('tags.index', '<< See All Tags', [], ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
