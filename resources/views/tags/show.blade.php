@extends('main')

@section('title', 'View Tag')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1><i><u>{{ $tag->name }}</u></i> tag <small>{{ $tag->posts()->count() }} {{ $tag->posts()->count() > 1 ? 'posts' : 'post' }}</small></h1>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Tags</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($tag->posts as $post)
                                <tr>
                                    <th>{{ $post->id }}</th>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        @foreach($post->tags as $tag)
                                            <span class="label label-default">{{ $tag->name }}</span>
                                        @endforeach
                                    </td>
                                    <td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-xs">View</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
