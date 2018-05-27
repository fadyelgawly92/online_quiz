@extends('admin_template')

@section('content')
    <h3 class="page-title">All tests</h3>

    <p>
        <a href="{{ route('quiz.create') }}" class="btn btn-success">Create Quiz</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            all quizzes
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($quizzes) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>name</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($quizzes) > 0)
                        @foreach ($quizzes as $quiz)
                            <tr data-entry-id="{{ $quiz->id }}">
                                <td></td>
                                <td>{{ $quiz->name }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
