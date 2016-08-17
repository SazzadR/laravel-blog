@extends('main')

@section('title', 'Home Page')

@section('content')
    <div class="row">
        <div class="col-md-12">

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if($featured_post)
                <div class="jumbotron">
                    <h2><i>Featured Post</i></h2>
                    <h4 class="panel-heading">{{ $featured_post->title }}</h4>
                    <p class="lead">{{ substr(strip_tags($featured_post->body), 0, 110) }}{{ strlen(strip_tags($featured_post->body)) > 110 ? '...': '' }}</p>
                    <p><a class="btn btn-primary btn-lg" href="{{ route('blog.single', [$featured_post->slug]) }}" role="button">Read More</a></p>
                </div>
            @endif
        </div>
    </div>
    <!-- end of header .row -->

    <div class="row">
        <div class="col-md-8">
            @foreach($posts as $post)
                <div class="post">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ substr(strip_tags($post->body), 0, 300) }}{{ strlen(strip_tags($post->body)) > 300 ? '...': '' }}</p>
                    <a href="{{ route('blog.single', $post->slug) }}" class="btn btn-primary">Read More</a>
                </div>

                <hr>
            @endforeach
        </div>

        <div class="col-md-3 col-md-offset-1">
            <h2>Sidebar</h2>
        </div>
    </div>
@stop