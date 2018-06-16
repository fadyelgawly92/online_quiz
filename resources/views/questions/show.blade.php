@extends('admin_template')

@section('content')
    <h3 class="page-title">show page</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            question
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr><th>quiz</th>
                    <td>{{ $question->quiz->name or '' }}</td></tr><tr><th>question text</th>
                    <td>{!!  $question->body !!}</td></tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('question.index') }}" class="btn btn-default">back to list</a>
        </div>
    </div>
@endsection