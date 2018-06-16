@extends('admin_template')

@section('content')
    <h3 class="page-title">All tests</h3>

    <p>
        <a href="{{ route('quiz.form') }}" class="btn btn-success">Create Quiz</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            all quizzes
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($quizzes) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($quizzes) > 0)
                        @foreach ($quizzes as $quiz)
                            <tr data-entry-id="{{ $quiz->id }}">
                                <td>{{ $quiz->name }}</td>
                                <td>
                                    <a href="{{ route('quiz.show',[$quiz->id])}}" class="btn btn-xs btn-primary">View</a>
                                    <a href="{{ route('quiz.edit',[$quiz->id])}}" class="btn btn-xs btn-info">edit</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'delete',
                                        'onsubmit' => "return confirm('are you sure ?');",
                                        'route' => ['quiz.delete' , $quiz->id])) !!}
                                    {!! Form::submit('delete', array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}  
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
