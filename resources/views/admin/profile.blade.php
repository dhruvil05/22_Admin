@extends('admin.master')

@push('title')
    <title>User Profile</title>
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
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
                <div class="container my-3">
                    <div class="container rounded bg-white mt-5 mb-5">
                        <div class="row">
                            <div class="col-md-3 border-right">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img
                                        class="rounded-circle mt-5" width="150px"
                                        src="{{ asset('uploads/cover/' . $user->image) }}"><span
                                        class="font-weight-bold">{{ $user->firstname . ' ' . $user->lastname }}</span><span
                                        class="text-black-50">{{ $user->email }}</span><span> </span></div>
                            </div>
                            <div class="col-md-5 border-right">
                                <div class="p-3 py-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="text-right">Profile Settings</h4>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6"><label class="labels">Name</label><label
                                                type="text" class="form-control">{{ $user->firstname }}</label></div>
                                        <div class="col-md-6"><label class="labels">Surname</label><label
                                                type="text" class="form-control">{{ $user->lastname }}</label></div>
                                    </div>
                                    <div class="row mt-3">
                                        {{-- <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="enter phone number" value=""></div>
                                        <div class="col-md-12"><label class="labels">Address Line 1</label><input type="text" class="form-control" placeholder="enter address line 1" value=""></div>
                                        <div class="col-md-12"><label class="labels">Address Line 2</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                                        <div class="col-md-12"><label class="labels">Postcode</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div> --}}
                                        {{-- <div class="col-md-12"><label class="labels">Country</label><input type="text" class="form-control" placeholder="enter address line 2" value="{{$user->country}}"></div> --}}
                                        {{-- <div class="col-md-12"><label class="labels">Area</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div> --}}
                                        <div class="col-md-12"><label class="labels">Email ID</label><label
                                                type="text" class="form-control"
                                                placeholder="enter email id">{{ $user->email }}</label></div>
                                        {{-- <div class="col-md-12"><label class="labels">Education</label><input type="text" class="form-control" placeholder="education" value=""></div> --}}
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6"><label class="labels">Country</label><label
                                                type="text" class="form-control"
                                                placeholder="country">{{ $user->country }}</label></div>
                                        {{-- <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div> --}}
                                    </div>

                                    <div class="create">
                                        <a href="{{url('admin/users/edit-user/'.$user->id)}}"
                                            class="edit btn btn-primary btn-sm d-flex">Update Profile</a>
                                    </div>

                                    {{-- <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div> --}}
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="p-3 py-5">
                                    <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                                    <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                                    <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </section>
    </div>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
@endsection
