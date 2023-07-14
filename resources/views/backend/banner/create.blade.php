@extends('backend.layouts.master')
@section('content')
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Banner</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <img class="imagePreview" id="output00" alt=""
                                    style="height:120px;object-fit:fill;width:130px;display:none">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" onchange="loadFile9(event)" class="form-control"
                                    placeholder="Images" required>
                                @error('image')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                                    placeholder="title" required>
                                @error('title')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Link (Optional)</label>
                                <input type="text" name="link" class="form-control" value="{{ old('link') }}"
                                    placeholder="Link">
                                @error('link')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Description</label>
                                <textarea type="text" class="form-control" id="summernote" placeholder="Enter description" name="description"
                                    value="{{ old('description') }}"></textarea>
                                @error('description')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Status</label>
                            <div class="">
                                <select name="status" id="inputState" value="{{ old('status') }}"
                                    class="default-select form-control wide">
                                    <option selected="">Choose...</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var loadFile9 = function(event) {
            let image77 = document.getElementById('output00');
            image77.src = URL.createObjectURL(event.target.files[0]);
            image77.style.display = "block"
        };
    </script>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection
