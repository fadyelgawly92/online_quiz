<!DOCTYPE html>
<html lang="en">
<head>
  <title>submitted quiz</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Quiz System</a>
    </div>
    <ul class="nav navbar-nav">
    </ul>
  </div>
</nav>

<div class="container">
    <p class="alert alert-danger" id="demo"></p>
    <h3 class="page-title">quiz</h3>
    {!! Form::open(['method' => 'POST', 'route' => array('quiz.submit',$myquiz,$user) ]) !!}
    {{csrf_field()}}
    <div class="panel panel-default">
        <div class="panel-heading">
            Full Quiz
        </div>
        <?php //dd($questions) ?>  
    @if(count($myquiz->question) > 0)
        <div class="panel-body">
        <?php $i = 1; ?>
        @foreach($myquiz->question as $question)
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

    {!! Form::submit('submit', array('class' => 'btn btn-danger' , 'id' => 'submitBtn')  ) !!}
    {!! Form::close() !!}
    <script src="{{asset('js/countdown.js')}}"></script>
</div>

</body>
</html>