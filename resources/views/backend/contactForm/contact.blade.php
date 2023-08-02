@extends('backend.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contacts Table</h3>

                    <div class="card-tools d-flex items-center">
                        {{-- <form action="{{ route('searchContact') }}" method="POST">
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


                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">S.N</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Number</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $key => $contact)
                            <tr>
                                <th scope="row">{{ $contact->id }}</th>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->number }}</td>

                                <td><button type="button" class="btn btn-sm btn-secondary" data-toggle="modal"
                                        data-target="#exampleModal{{ $contact->id }}">
                                        View Detail
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="exampleModal{{ $contact->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Contact Detail
                                            </h1>
                                            <button type="button" class="btn-close" data-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <p>Name: {{ $contact->bname }}</p>
                                            <p>Email: {{ $contact->email }}</p>
                                            <p>Number: {{ $contact->number }}</p>

                                            <p>Message: {{ $contact->message }}</p>
                                        </div>
                                        <div class="modal-footer d-flex w-100 justify-content-between">


                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </tbody>
                </table>
                <hr>
                <div class="my-3 mx-2 d-flex justify-content-end">

                    {{ $contacts->links('pagination::bootstrap-4') }}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    </div>
@endsection
