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
    <p class="alert alert-danger" id="mydemo"></p>
    <div class="alert alert-danger" id="time" style="display: none;"></div>
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
    <script>
        var submitBtn = document.getElementById('submitBtn');
        var time = {!! json_encode(Session::get('mytime')) !!};
        var newtime =  time - 1 ;
        var x = setInterval(function(){
            newtime -= 1 ;
            var totalNumberOfSeconds = newtime ;
            var hours = parseInt( totalNumberOfSeconds / 3600 );
            var minutes = parseInt( (totalNumberOfSeconds - (hours * 3600)) / 60 );
            var seconds = Math.floor((totalNumberOfSeconds - ((hours * 3600) + (minutes * 60))));
            var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds)
    
            document.getElementById("mydemo").innerHTML = "Time Limit : " + result;
            document.getElementById("time").innerHTML = newtime;    

        if(newtime < 0){
            clearInterval(x);
            submitBtn.click();
            document.getElementById("mydemo").innerHTML = "Expired";
        }
        $.ajax({
                type:'get',
                url: '{{route('session.update')}}',
                data: { 
                    "newtime": document.getElementById("time").innerHTML,  
                },
                success:function(response){
                  console.log(response.status);   
                },
                error:function(){
                   console.log('not fine');
                }
         });

        }, 1000);
    </script>
    
</div>

</body>
</html>