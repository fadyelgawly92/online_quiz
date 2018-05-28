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
            <table class="table table-bordered table-striped {{ count() }}"
    </div>    
