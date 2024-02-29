@extends('layouts.app')

@section('content')
    <!-- Form Start -->
    <div class="container-fluid py-2">
        <div class="container py-2">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add New Product</h4>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Product Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter product name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="category" class="form-label">Category</label>
                                            <select class="form-select text-success" id="category" name="category" required>
                                                <option selected disabled>Select a category</option>
                                                <option >Apples</option>
                                                <option >Oranges</option>
                                                <option >Strawberry</option>
                                                <option >Banana</option>
                                                <option >Pumpkin</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price (INR)</label>
                                            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="Enter product price" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="images" class="form-label">Product Images</label>
                                            <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple required>
                                            <small class="text-muted" >You can select multiple images by holding down the Ctrl + select</small>
                                            <div id="preview"class="d-flex flex-row"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter product description" required>{{ old('description') }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Form End -->
{{-- jquery Image preview --}}
    <script src="{{asset('js/preview.js')}}"></script>
@endsection
