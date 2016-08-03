@extends('main')

@section('title', 'Forgot my Password')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
@stop

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! Form::open(['url' => 'password/email', 'method' => "POST", 'data-parsley-validate' => '']) !!}

                        {{ Form::label('email', 'Email Address:') }}
                        {{ Form::email('email', null, ['class' => 'form-control', 'required' => '']) }}

                        {{ Form::submit('Reset Password', ['class' => 'btn btn-primary form-spacing-top']) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}
@stop