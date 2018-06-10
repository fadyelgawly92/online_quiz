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
    <h3 class="page-title">quiz</h3>
    {!! Form::open(['method' => 'POST', 'route' => array('quiz.answer', $quiz ,$user)  ]) !!}
    {{csrf_field()}}
    <div class="panel panel-default">
        <div class="panel-heading">
            Register
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
                    {!! Form::email('email', null, array('placeholder' => 'email','class' => 'form-control')) !!}
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit('save', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
 </div>

</body>
</html>