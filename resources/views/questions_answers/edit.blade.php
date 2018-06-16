@extends('admin_template')

@section('content')
    <h3 class="page-title">Answer Edit</h3>
    
    {!! Form::model($questions_option, ['method' => 'PUT', 'route' => ['questions_answer.update', $questions_option->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Answer
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('question_id', 'question', ['class' => 'control-label']) !!}
                    {!! Form::select('question_id', $questions, old('question_id'), ['class' => 'form-control','disabled', 'selected']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('question_id'))
                        <p class="help-block">
                            {{ $errors->first('question_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('option', 'Option', ['class' => 'control-label']) !!}
                    {!! Form::text('option', old('option'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('option'))
                        <p class="help-block">
                            {{ $errors->first('option') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('is_correct', 'Correct', ['class' => 'form-check-label']) !!}
                    {!! Form::hidden('is_correct', 0) !!}
                    {!! Form::checkbox('is_correct', 1, old('is_correct'), ['class' => 'form-check-input']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('is_correct'))
                        <p class="help-block">
                            {{ $errors->first('is_correct') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit('save', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection