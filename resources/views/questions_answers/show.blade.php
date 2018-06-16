@extends('admin_template')

@section('content')
    <h3 class="page-title">Answers Show</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            Answers
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr><th>Question</th>
                    <td>{{ $questions_option->question->body or '' }}</td></tr><tr><th>Answer</th>
                    <td>{{ $questions_option->option }}</td></tr><tr><th>Correct ?</th>
                    <td>{{ $questions_option->is_correct == 1 ? 'Yes' : 'No' }}</td></tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('questions_answer.index') }}" class="btn btn-default">back to list</a>
        </div>
    </div>
@endsection