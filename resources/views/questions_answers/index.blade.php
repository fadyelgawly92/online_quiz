@extends('admin_template')

@section('content')
    <h3 class="page-title">all Answers</h3>

    <p>
        <a href="{{route('questions_answer.form')}}" class="btn btn-success">create answer</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            answers  
        </div>
    
        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($questions_answers) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all"></th>
                        <th>Question</th>
                        <th>Option</th>
                        <th>Correct</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($questions_answers) >0)
                        @foreach($questions_answers as $questions_answer)
                            <tr data-entry-id="{{ $questions_answer->id }}">
                                <td></td>
                                <td>{{ $questions_answer->question->body or '' }}</td>
                                <td>{{ $questions_answer->option }}</td>
                                <td>{{ $questions_answer->is_correct == 1 ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a href="{{ route('questions_answer.show',[$questions_answer->id])}}" class="btn btn-xs btn-primary">View</a>
                                    <a href="{{ route('questions_answer.edit',[$questions_answer->id])}}" class="btn btn-xs btn-info">edit</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'delete',
                                        'onsubmit' => "return confirm('are you sure ?');",
                                        'route' => ['questions_answer.delete' , $questions_answer->id])) !!}
                                    {!! Form::submit('delete', array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}  
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">no entries in table</td>
                        </tr>
                    @endif    
                </tbody>
            </table>
        </div>
    </div>        
@endsection