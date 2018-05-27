@extends('admin_template')

@section('content')
    <h3 class="page-title">our question</h3>

    <p>
        <a href="{{ route('question.create') }}" class="btn btn-success">create question</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            all questions
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($questions) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>quiz</th>
                        <th>body</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($questions) > 0)
                        @foreach ($questions as $question)
                            <tr data-entry-id="{{ $question->id }}">
                                <td></td>
                                <td>{{ $question->quiz->name or '' }}</td>
                                <td>{!! $question->body !!}</td>
                                <td>
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