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
                    {!! Form::open(['url' => 'password/reset', 'method' => "POST", 'data-parsley-validate' => '']) !!}

                        {!! Form::hidden('token', $token) !!}

                        {{ Form::label('email', 'Email Address:') }}
                        {{ Form::email('email', $email, ['class' => 'form-control', 'required' => '']) }}

                        {{ Form::label('password', 'New Password:') }}
                        {{ Form::password('password', ['class' => 'form-control', 'required' => '']) }}

                        {{ Form::label('password_confirmation', 'Confirm New Password:') }}
                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'required' => '']) }}

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