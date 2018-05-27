@extends('admin_template')

@section('content')
<div class="container">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form method="POST" action="{{ route('users.create')}}" class="form-group"  enctype="multipart/form-data">
    {{csrf_field()}}
        <div class="form-group">
        name : <input class="form-control" type="text" name="name">
        </div>
        <br/>
        <br/>
        <div class="form-group">
        email : <input class="form-contol" type="email" name="email">
        </div>
        <br/>
        <br/>
        <div class="form-group">
        password : <input class="form-contol" type="password" name="password">
        </div>
        <br/>
        <br/>
        <div class="form-group">
        confirm-password : <input class="form-contol" type="password" name="passwordConfirmation">
        </div>
        <br/>
        <br/>
        <input type="submit" value="create" class="btn btn-danger">
    </form>
</div>

@endsection