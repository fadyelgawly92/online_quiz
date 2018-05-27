@extends('admin_template')

@section('content')
    <h3 class="page-title">quiz</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['quiz.create']]) !!}
    {{csrf_field()}}
    <div class="panel panel-default">
        <div class="panel-heading">
            create
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
            
        </div>
    </div>

    {!! Form::submit('save', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection