@extends('admin_template')

@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    

            <table class="table table-bordered" id="users-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                </thead>
            </table>

                <script>
                    $(function() {
                        $('#users-table').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '{{route('users.approvedIndex.dataTables')}}',
                            columns: [
                                { data: 'name', name: 'name' },
                                { data: 'email', name: 'email' },
                            ]
                        });
                    });
                </script>
     
    <br/>
    <br/> 
    <a href="{{route('users.index.dataTables')}}"><button class="btn btn-primary" >Return Back</button></a>

@endsection