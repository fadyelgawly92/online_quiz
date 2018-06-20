@extends('admin_template')

@section('content')
    <h3 class="page-title">User</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['users.create']]) !!}
    {{csrf_field()}}
    <div class="panel panel-default">
        <div class="panel-heading">
            create new user
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                    {!! Form::text('name', null, array('placeholder' => 'name','class' => 'form-control')) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', 'E-mail', ['class' => 'control-label']) !!}
                    {{ Form::email('email', '', ['placeholder' => 'email','class' => 'field']) }}
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                    {{ Form::password('password', array('placeholder' => 'password','class' => 'field')) }}
                    <p class="help-block"></p>
                    @if($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('passwordConfirmation', 'Confirm Password', ['class' => 'control-label']) !!}
                    {{ Form::password('passwordConfirmation', array('placeholder' => 'password','class' => 'field')) }}
                    <p class="help-block"></p>
                    @if($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('phone', 'Phone', ['class' => 'control-label']) !!}
                    {!! Form::tel('phone', null, array('placeholder' => 'phone','class' => 'form-control')) !!}
                    <p class="help-block"></p>
                    @if($errors->has('phone'))
                        <p class="help-block">
                            {{ $errors->first('phone') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit('create', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection