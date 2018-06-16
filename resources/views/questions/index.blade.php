@extends('admin_template')

@section('content')
    <h3 class="page-title">our question</h3>

    <p>
        <a href="{{ route('question.form') }}" class="btn btn-success">create question</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            all questions
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($questions) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th>quiz</th>
                        <th>body</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($questions) > 0)
                        @foreach ($questions as $question)
                            <tr data-entry-id="{{ $question->id }}">
                                <td>{{ $question->quiz->name or '' }}</td>
                                <td>{!! $question->body !!}</td>
                                <td>
                                    <a href="{{ route('question.show',[$question->id])}}" class="btn btn-xs btn-primary">View</a>
                                    <a href="{{ route('question.edit',[$question->id])}}" class="btn btn-xs btn-info">edit</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('are you sure?');",
                                        'route' => ['question.destroy', $question->id])) !!}
                                    {!! Form::submit('delete', array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">no entries</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection