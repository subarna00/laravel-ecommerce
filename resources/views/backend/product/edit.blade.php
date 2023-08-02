@extends('backend.layouts.master')
@section('content')
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Product</h4>
            </div>
            @if ($errors->any())
                {{ implode('', $errors->all('<div class="text-red">:message</div>')) }}
            @endif
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">

                            <div class="mb-3 col-md-4">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name') ?? $product->name }}" placeholder="name" required>
                                @error('name')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Model (Optional)</label>
                                <input type="text" name="model" class="form-control"
                                    value="{{ old('model') ?? $product->model }}" placeholder="model">
                                @error('model')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Stock </label>
                                <input type="number" name="stock" class="form-control"
                                    value="{{ old('stock') ?? $product->stock }}" placeholder="stock" min="0"
                                    required>
                                @error('stock')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Brand </label>
                                <select name="brand_id" id="" class="form-control">
                                    <option value="" selected disabled>Select Brand
                                    </option>
                                    @foreach (App\Models\Brand::latest()->get() as $brand)
                                        <option value="{{ $brand->id }}"
                                            @if ($brand->id == $product->brand_id) selected @endif
                                            @if (old('brand_id') == $brand->id) selected @endif>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Category </label>
                                <select name="category_id" id="" class="form-control">
                                    <option value="" selected disabled>Select Category
                                    </option>
                                    @foreach (App\Models\Category::latest()->get() as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($category->id == $product->category_id) selected @endif
                                            @if (old('category_id') == $category->id) selected @endif>{{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Sub Category </label>
                                <select name="sub_category_id" id="" class="form-control">
                                    <option value="" selected disabled>Select Sub Category
                                    </option>
                                    @foreach (App\Models\SubCategory::latest()->get() as $sub_category)
                                        <option value="{{ $sub_category->id }}"
                                            @if ($sub_category->id == $product->sub_category_id) selected @endif
                                            @if (old('sub_category_id') == $sub_category->id) selected @endif>{{ $sub_category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sub_category_id')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                @if ($product->images)
                                    <div class="d-flex">
                                        @foreach ($product->images as $images)
                                            <div class="mr-3 relative">
                                                <div class="cross "
                                                    style="position: absolute;top:-10px;right:-10px;font-size:8px;color:white;font-weight:bold;background:red;padding:4px 8px;border-radius:999px;cursor:pointer"
                                                    onclick="deleteImage(event,{{ $images->id }})">
                                                    X</div>
                                                <img src="{{ asset('images/' . $images->image) }}" alt=""
                                                    style="height: 60px;width:80px">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <label class="form-label">Image</label>
                                <input type="file" multiple name="images[]" class="form-control" placeholder="Images">
                                @error('image')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Sub Description</label>
                                <textarea type="text" class="form-control" i placeholder="Enter sub description" name="sub_description"
                                    value="{{ old('sub_description') ?? $product->sub_description }}">{!! old('sub_description') ?? $product->sub_description !!}</textarea>
                                @error('sub_description')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Description</label>
                                <textarea type="text" class="form-control" id="summernote1" placeholder="Enter description" name="description"
                                    value="{{ old('description') }}">{!! old('description') ?? $product->description !!}</textarea>
                                @error('description')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Price </label>
                                <input type="price" name="price" class="form-control"
                                    value="{{ old('price') ?? $product->price }}" placeholder="price" min="0"
                                    required>
                                @error('price')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Discount (%) </label>
                                <input type="price" name="discount" class="form-control"
                                    value="{{ old('discount') ?? $product->discount }}" placeholder="discount"
                                    min="0" required>
                                @error('discount')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Offer (%) </label>
                                <input type="price" name="offer" class="form-control"
                                    value="{{ old('offer') ?? $product->offer }}" placeholder="offer" min="0"
                                    required>
                                @error('offer')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Rating </label>
                                <input type="price" name="rating" class="form-control"
                                    value="{{ old('rating') ?? '4.5' }}" placeholder="rating" min="0" required>
                                @error('rating')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Product Type</label>
                                <div class="">
                                    <select name="types" id="inputState" class="default-select form-control wide">
                                        <option value="active" @if (old('types') == 'casual') selected @endif>Casual
                                        </option>
                                        <option value="inactive" @if (old('types') == 'featured') selected @endif>Featured
                                        </option>
                                        <option value="inactive" @if (old('types') == 'Trending') selected @endif>
                                            Trending
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Status</label>
                                <div class="">
                                    <select name="status" id="inputState" value="{{ old('status') }}"
                                        class="default-select form-control wide">
                                        <option value="active" @if (old('status') == 'active') selected @endif>Active
                                        </option>
                                        <option value="inactive" @if (old('status') == 'inactive') selected @endif>
                                            Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="button" class="btn btn-sm btn-secondary" onclick="addMoreSize()">Add
                                    Size</button>
                                <div id="size-wrapper">
                                    @if ($product->sizes)
                                        @foreach ($product->sizes as $key => $sizes)
                                            <div class="flex justify-between p-2 items-center mt-2"
                                                style="border:1px solid black;width:max-content">
                                                <span>{{ $sizes->size }}</span>
                                                <span class="mx-5">{{ $sizes->available }}</span>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="deleteSize(event,{{ $sizes->id }})">X</button>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="button" class="btn btn-sm btn-secondary" onclick="addMoreColor()">Add
                                    Color</button>
                                <div id="color-wrapper">
                                    @if ($product->colors)
                                        @foreach ($product->colors as $key => $colors)
                                            <div class="flex justify-between p-2 items-center mt-2"
                                                style="border:1px solid black;width:max-content">
                                                <span>{{ $colors->color }}</span>
                                                <span class="mx-5">{{ $colors->available }}</span>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="deleteColor(event,{{ $colors->id }})">X</button>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-12 mb-3">

                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Dimension</label>
                                    <textarea type="text" class="form-control" id="summernoteDimension" placeholder="Enter dimension"
                                        name="dimension" value="{{ old('dimension') ?? $product->dimensions->dimension }}">
                                        @if ($product->dimensions)
{!! old('dimension') ?? $product->dimensions->dimension !!}
@endif
</textarea>
                                    @error('dimension')
                                        <div class="text-red">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Terms And Conditions</label>
                                    <textarea type="text" class="form-control" id="summernoteTermsConditions"
                                        placeholder="Enter Terms and Conditions" name="policy" value="{{ old('policy') ?? $product->policy }}">{!! old('policy') ?? $product->policy !!}</textarea>
                                    @error('policy')
                                        <div class="text-red">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
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
            $('#summernote1').summernote();
            $('#summernoteDimension').summernote();
            $('#summernoteTermsConditions').summernote();
        });
    </script>
    <script>
        function addMoreSize() {
            let pdiv = document.getElementById("size-wrapper");
            let divs = `
                                <div class="d-flex my-3 items-center w-100">
                                                            <div class=" ">
                                                                <input type="price" name="sizes[]" class="form-control" value=""
                                                                    placeholder="rating" min="0" required>
                                                                @error('rating')
                                                                   <div class="text-red">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                 @enderror
                                                            </div>
                                                            <div class="">

                                                                <select name="savailable[]" id="inputState"
                                                                    class="default-select form-control wide mx-2" required>
                                                                    <option value="Available"
                                                                        @if (old('status') == 'Available') selected @endif>
                                                                        Available
                                                                    </option>
                                                                    <option value="Not Available"
                                                                        @if (old('status') == 'Not Available') selected @endif>
                                                                        Not Available
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="">
                                                                <button class="btn  btn-danger ml-3 remove-size" type="button" id="remove-size">-</button>
                                                            </div>
                                                        </div>
                                                `;
            pdiv.insertAdjacentHTML("beforeend", divs)
            let delBtn = document.querySelectorAll(".remove-size");
            delBtn.forEach(element => {
                element.addEventListener("click", function(e) {
                    e.target.parentNode.parentNode.remove()
                })
            });
        }

        function addMoreColor() {
            let pdiv = document.getElementById("color-wrapper");
            let divs = `
                                  <div class="d-flex my-3 items-center">
                                        <div class=" ">
                                            <input type="price" name="colors[]" class="form-control" value=""
                                                placeholder="rating" min="0" required>
                                            @error('rating')
                                                <div class="text-red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="">

                                            <select name="cavailable[]" id="inputState"
                                                class="default-select form-control wide mx-2" required>
                                                <option value="Available"
                                                    @if (old('status') == 'Available') selected @endif>
                                                    Available
                                                </option>
                                                <option value="Not Available"
                                                    @if (old('status') == 'Not Available') selected @endif>
                                                    Not Available
                                                </option>
                                            </select>
                                        </div>
                                        <div class="">
                                            <button class="btn  btn-danger ml-3 remove-color" type="button" id="remove-color">-</button>
                                        </div>
                                    </div>
                                                `;
            pdiv.insertAdjacentHTML("beforeend", divs)
            let delBtn = document.querySelectorAll(".remove-color");
            delBtn.forEach(element => {
                element.addEventListener("click", function(e) {
                    e.target.parentNode.parentNode.remove()
                })
            });
        }
    </script>
    <script>
        function deleteImage(e, id) {
            if (confirm("Are you sure to delete this image? Action cannot be undone.")) {
                $.ajax({
                    method: "DELETE",
                    url: "{{ route('deleteProductImage') }}" + "/" + id,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function() {
                        e.target.parentNode.remove()
                    }
                })
            }
        }

        function deleteSize(e, id) {
            if (confirm("Are you sure to delete this Size? Action cannot be undone.")) {
                $.ajax({
                    method: "DELETE",
                    url: "{{ route('deleteProductSize') }}" + "/" + id,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function() {
                        e.target.parentNode.remove()
                    }
                })
            }
        }

        function deleteColor(e, id) {
            if (confirm("Are you sure to delete this Color? Action cannot be undone.")) {
                $.ajax({
                    method: "DELETE",
                    url: "{{ route('deleteProductColor') }}" + "/" + id,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function() {
                        e.target.parentNode.remove()
                    }
                })
            }
        }
    </script>
@endsection
