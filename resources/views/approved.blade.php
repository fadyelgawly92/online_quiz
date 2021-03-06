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
                    <th>Confirm</th>
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
                                {
                                    orderable :false,
                                    searchable : false,
                                    render : function(data,type,row){
                                        //check in console what the row will look like
                                        console.log(row);
                                        //console.log(data);   
                                        //console.log(type);

                                        //here am just passing a hash to the route helper function and will be replaced with the real id from javascript part
                                        var mockedDeleteRoute = '{{route('approved.users.delete','#replaceMeWithUserId')}}'

                                        //here i replaced the hashed string with real id
                                        var realDeleteRoute= mockedDeleteRoute.replace('#replaceMeWithUserId',row.id);

                                        //then here i returned the real url with id
                                        return "<button  onclick='getMessage(\"" + realDeleteRoute + '\",\"' + row.id + "\")' id="+row.id+" class='btn btn-danger'>decline</button>"
                                    }
                                }
                            ]
                        });
                    });
                    function getMessage(realDeleteRoute, row){
                        var res=  confirm("Are you sure?");
                             if(res){
                        var ButtonId =$('#'+row).attr('id');
                        $.ajax({
                            type:'get',
                            url: realDeleteRoute,
                            success:function(response){
                                console.log(response.status);
                                $('#'+ButtonId).parent().parent().remove();    
                            },
                            error:function(){
                                console.log('not fine');
                            }
                        });
                    }
                }
                </script>
     
    <br/>
    <br/> 
    <a href="{{route('users.index')}}"><button class="btn btn-primary" >Return Back</button></a>

@endsection