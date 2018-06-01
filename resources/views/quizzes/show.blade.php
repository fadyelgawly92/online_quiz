@extends('admin_template')

@section('content')
    <h3 class="page-title">quiz</h3>
    {!! Form::open(['method' => 'POST', 'route' => array('quiz.send',$quiz) ]) !!}
    {{csrf_field()}}
    <div class="panel panel-default">
        <div class="panel-heading">
            Full Quiz
        </div>
        <?php //dd($questions) ?>  
    @if(count($quiz->question) > 0)
        <div class="panel-body">
        <?php $i = 1; ?>
        @foreach($quiz->question as $question)
            @if ($i > 1) <hr /> @endif
            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class="form-group">
                        <strong>Question {{ $i }}.<br />{!! nl2br($question->body) !!}</strong>

                        <input
                            type="hidden"
                            name="questions[{{ $i }}]"
                            value="{{ $question->id }}">
                    @foreach($question->questionAnswer as $option)
                        <br>
                        <label class="radio-inline">
                            <input
                                type="radio"
                                name="answers[{{ $question->id }}]"
                                value="{{ $option->id }}">
                            {{ $option->option }}
                        </label>
                    @endforeach
                    </div>
                </div>
            </div>
        <?php $i++; ?>
        @endforeach
        </div>
    @endif
    </div>

    {!! Form::submit('send to students', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection