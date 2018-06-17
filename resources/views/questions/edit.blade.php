@extends('admin_template')

@section('content')
    <h3 class="page-title">Question Edit</h3>
    
    {!! Form::model($question, ['method' => 'PUT', 'route' => ['question.update', $question->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            question
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('quiz_id', 'Quiz', ['class' => 'control-label']) !!}
                    {!! Form::select('quiz_id', $quiz, old('quiz_id'), ['class' => 'form-control','disabled', 'selected']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('quiz_id'))
                        <p class="help-block">
                            {{ $errors->first('quiz_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('body', 'Question text', ['class' => 'control-label']) !!}
                    {!! Form::textarea('body', old('body'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('body'))
                        <p class="help-block">
                            {{ $errors->first('body') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit('save', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection