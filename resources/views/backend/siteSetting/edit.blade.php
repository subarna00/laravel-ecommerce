@extends('backend.layouts.master')
@section('content')
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Banner</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-12">

                                <img class="w-100" id="output00" alt=""
                                    src="{{ asset('images/' . $banner->image) }}"
                                    style="height:200px;object-fit:cover;width:150px;">

                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" placeholder="Images"
                                    onchange="loadFile9(event)">
                                @error('image')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ $banner->title ?? old('title') }}" placeholder="title" required>
                                @error('title')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Link (Optional)</label>
                                <input type="text" name="link" class="form-control"
                                    value="{{ $banner->link ?? old('link') }}" placeholder="Link">
                                @error('link')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Description</label>
                                <textarea type="text" class="form-control" id="summernote" placeholder="Enter description" name="description"
                                    value="{{ $banner->description ?? old('description') }}">{!! $banner->description !!}</textarea>
                                @error('description')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Status</label>
                            <div class="">
                                <select name="status" id="inputState" value="{{ $banner->status ?? old('status') }}"
                                    class="default-select form-control wide">
                                    <option selected="">Choose...</option>
                                    <option value="active" @if ($banner->status === 'active') selected @endif>Active</option>
                                    <option value="inactive" @if ($banner->status === 'inactive') selected @endif>Inactive
                                    </option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
    <script>
        var loadFile9 = function(event) {
            let image77 = document.getElementById('output00');
            image77.src = URL.createObjectURL(event.target.files[0]);
            image77.style.display = "block"
        };
    </script>
@endsection
