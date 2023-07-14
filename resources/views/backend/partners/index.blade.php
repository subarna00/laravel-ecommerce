@extends('backend.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Partners Table</h3>

                    <div class="card-tools d-flex items-center">
                        <form action="{{ route('searchPartner') }}" method="POST">
                            @csrf
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="Search"
                                    required>

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                        </form>
                    </div>

                    <div class="">
                        <a href="{{ route('partners.create') }}" class="btn btn-sm btn-primary ml-2">Add + </a>
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
                            <th>Image</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($partners) > 0)
                            @foreach ($partners as $key => $partner)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $partner->name }}</td>
                                    <td><img src="{{ asset('images/' . $partner->image) }}" width="50" alt="">
                                    </td>
                                    <td>
                                        {{ substr($partner->link, 0, 50) }}
                                    </td>
                                    <td><span class="tag tag-success">{{ $partner->status }}</span></td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('partners.edit', $partner->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <button class="btn btn-sm btn-danger mx-1" data-toggle="modal"
                                                data-target="#exampleModal{{ $partner->id }}">Delete</button>
                                            <!-- Button trigger modal -->


                                            <!--delete Modal -->
                                            <div class="modal fade" id="exampleModal{{ $partner->id }}" tabindex="-1"
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
                                                                class="text-danger">{{ $partner->name }}</span> ? <br>
                                                            This action cannot be undone.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <form action="{{ route('partners.destroy', $partner->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                {{ method_field('delete') }}
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

                    {{ $partners->links('pagination::bootstrap-4') }}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    </div>
@endsection
