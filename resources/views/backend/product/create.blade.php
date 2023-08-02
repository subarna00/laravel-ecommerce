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
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="mb-3 col-md-4">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                    placeholder="name" required>
                                @error('name')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Model (Optional)</label>
                                <input type="text" name="model" class="form-control" value="{{ old('model') }}"
                                    placeholder="model">
                                @error('model')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Stock </label>
                                <input type="number" name="stock" class="form-control" value="{{ old('stock') }}"
                                    placeholder="stock" min="0" required>
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
                                <img class="imagePreview" id="output00" alt=""
                                    style="height:120px;object-fit:fill;width:130px;display:none">
                                <label class="form-label">Image</label>
                                <input type="file" multiple name="images[]" class="form-control" placeholder="Images"
                                    required>
                                @error('image')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Sub Description</label>
                                <textarea type="text" class="form-control" i placeholder="Enter sub description" name="description"
                                    value="{{ old('description') }}"></textarea>
                                @error('description')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Description</label>
                                <textarea type="text" class="form-control" id="summernote1" placeholder="Enter description" name="description"
                                    value="{{ old('description') }}"></textarea>
                                @error('description')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Price </label>
                                <input type="price" name="price" class="form-control" value="{{ old('price') ?? '0' }}"
                                    placeholder="price" min="0" required>
                                @error('price')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Discount (%) </label>
                                <input type="price" name="discount" class="form-control" value="{{ old('discount') }}"
                                    placeholder="discount" min="0" required>
                                @error('discount')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Offer (%) </label>
                                <input type="price" name="offer" class="form-control" value="{{ old('offer') }}"
                                    placeholder="offer" min="0" required>
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
                                        <option value="inactive" @if (old('types') == 'Trending') selected @endif>Trending
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
                                        <option value="inactive" @if (old('status') == 'inactive') selected @endif>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="button" class="btn btn-sm btn-secondary" onclick="addMoreSize()">Add
                                    Size</button>
                                <div id="size-wrapper">


                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="button" class="btn btn-sm btn-secondary" onclick="addMoreColor()">Add
                                    Color</button>
                                <div id="color-wrapper">


                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Dimension</label>
                                    <textarea type="text" class="form-control" id="summernoteDimension" placeholder="Enter dimension"
                                        name="dimension" value="{{ old('dimension') }}"></textarea>
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
                                        placeholder="Enter Terms and Conditions" name="policy" value="{{ old('policy') }}"></textarea>
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
@endsection
