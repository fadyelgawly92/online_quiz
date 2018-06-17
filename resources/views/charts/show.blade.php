@extends('admin_template')

@section('content')
    <h3 class="page-title">Choose Chart</h3>
    
    {!! Form::model($quizzes, ['method' => 'POST', 'route' => ['graph.view'] ]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Choose Quiz
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id', 'Quiz', ['class' => 'control-label']) !!}
                    {!! Form::select('id', $quiz, old('id'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id'))
                        <p class="help-block">
                            {{ $errors->first('id') }}
                        </p>
                    @endif
                </div>
            </div>
        
     </div>
 </div> 
 
    {!! Form::submit('Show Chart', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection 