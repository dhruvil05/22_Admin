@extends('admin.master')

@push('title')
    <title>Users List</title>
@endpush
@push('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="https://cdn.datatables.net/rowgroup/1.1.1/css/rowGroup.bootstrap4.min.css" />
@endpush
@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    {{-- <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script> --}}
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Users</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                {{-- <div class="row"> --}}

                <div class="session my-2">
                    @if (session('status'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {{-- <h6 class="alert alert-success">{{ session('status') }}</h6> --}}
                    @endif
                    @if (session('failed'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('failed') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {{-- <h6 class="alert alert-danger">{{ session('failed') }}</h6> --}}
                    @endif

                    {{-- <p>{{session('user')}}</p>
              <p>{{session('id')}}</p> --}}


                </div>
                <div class=" my-3 px-2">
                    {{-- <div class="searching ml-2">
                        <input type="search" name="searchIn" class="form-control search" placeholder="Search">
                    </div> --}}
                    <b class="pb-2"> Advance Search By</b>
                    <div class="row d-flex justify-content-equal w-100">
                        <div class="firstname ml-2 mt-2">
                            <input type="text" name="firstnameIn" class="form-control search" placeholder="Firstname">
                        </div>
                        <div class="lastname ml-2 mt-2">
                            <input type="text" name="lastnameIn" class="form-control search" placeholder="Lastname">
                        </div>
                        <div class="email ml-2 mt-2">
                            <input type="email" name="emailIn" class="form-control search" placeholder="Email">
                        </div>
                        <div class="gender ml-2 mt-2">
                            <input type="text" name="genderIn" class="form-control search" placeholder="gender">
                        </div>
                        <div class="country ml-2 mt-2">
                            <input type="text" name="countryIn" class="form-control search" placeholder="country">
                        </div>
                        {{-- <div class="create">
                            <a href="{{route('add')}}" class="btn btn-primary float-right">Add
                                User</a>
                        </div> --}}

                    </div>

                </div>
                <table class="table table-bordered data-table w-100">
                    <thead>
                        <tr>

                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Country</th>
                            <th>Image</th>
                            <th>Created_at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                {{-- </div> --}}
            </div>
        </section>
    </div>
    <script type="text/javascript">
        $(function() {

            var table = $('.data-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                // "bSort": false,
                searching: false,

                "order": [
                    [7, "desc"]
                ],

                ajax: {
                    url: "{{ url('/admin/users') }}",

                    data: function(d) {
                        // d.search = $('input[name="searchIn"]').val()
                        // d.string = $('.search').val(),
                        d.firstname = $('input[name="firstnameIn"]').val()
                        d.lastname = $('input[name="lastnameIn"]').val()
                        d.email = $('input[name="emailIn"]').val()
                        d.gender = $('input[name="genderIn"]').val()
                        d.country = $('input[name="countryIn"]').val()
                    }
                },
                columns: [

                    {
                        data: 'firstname',
                        name: 'firstname'
                    },
                    {
                        data: 'lastname',
                        name: 'lastname'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },

                    {
                        data: 'gender',
                        name: 'gender'

                    },
                    {
                        data: 'country',
                        name: 'country'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return "<img src=\"http://127.0.0.1:8000/uploads/cover/" + data +
                                "\" height=\"50px\"/>";
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
            $(".search").keyup(function() {
                // console.log($('.search').val());
                table.draw();

            });

        });
    </script>
@endsection
