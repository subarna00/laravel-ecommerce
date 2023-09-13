@extends('backend.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User Table</h3>

                    <div class="card-tools d-flex items-center">
                        {{-- <form action="{{ route('searchuser') }}" method="POST">
                            @csrf
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="Search"
                                    required>

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                        </form> --}}
                    </div>

                    <div class="">
                        <a href="{{ route('adminUserCreate') }}" class="btn btn-sm btn-primary ml-2">Add + </a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>email</th>
                            <th>Number</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users) > 0)
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td><img src="{{ asset('images/' . $user->image) }}" width="50" alt="">
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td><span class="tag tag-success">{{ $user->phone_number }}</span></td>
                                    <td><span class="tag tag-success">{{ $user->address }}</span></td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route("userEditAdmin",$user->id) }} "
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <button class="btn btn-sm btn-danger mx-1" data-toggle="modal"
                                                data-target="#exampleModal{{ $user->id }}">Delete</button>
                                            <!-- Button trigger modal -->


                                            <!--delete Modal -->
                                            <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure to delete <span
                                                                class="text-danger">{{ $user->title }}</span> ? <br>
                                                            This action cannot be undone.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <form action="{{ route("userDeleteAdmin",$user->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn  btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>No Data found</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
                <hr>
                <div class="my-3 mx-2 d-flex justify-content-end">

                    {{ $users->links('pagination::bootstrap-4') }}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    </div>
@endsection
