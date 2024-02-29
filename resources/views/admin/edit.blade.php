@extends('layouts.app')

@section('content')
    <!-- Form Start -->
    <div class="container-fluid py-2">
        <div class="container py-2">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Product</h4>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Product Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="Enter product name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="category" class="form-label">Category</label>
                                            <select class="form-select text-success" id="category" name="category" required>
                                                <option selected disabled>Select a category</option>
                                                <option value="Apples" {{ $product->category == 'Apples' ? 'selected' : '' }}>Apples</option>
                                                <option value="Oranges" {{ $product->category == 'Oranges' ? 'selected' : '' }}>Oranges</option>
                                                <option value="Strawberry" {{ $product->category == 'Strawberry' ? 'selected' : '' }}>Strawberry</option>
                                                <option value="Banana" {{ $product->category == 'Banana' ? 'selected' : '' }}>Banana</option>
                                                <option value="Pumpkin" {{ $product->category == 'Pumpkin' ? 'selected' : '' }}>Pumpkin</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="stock" class="form-label">Stock</label>
                                            <select class="form-select text-warning" id="stock" name="stock" required>
                                                <option value="In stock" {{ old('stock', $product->stock) === 'In stock' ? 'selected' : '' }} >In stock</option>
                                                <option value="Out of stock" {{ old('stock', $product->stock) === 'Out of stock' ? 'selected' : '' }} >Out of stock</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price (INR)</label>
                                            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" placeholder="Enter product price" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="images" class="form-label">Product Images</label>
                                            <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
                                            <small class="text-muted" >You can select multiple images by holding down the Ctrl + select</small>
                                            <div id="preview" class="d-flex flex-row">
                                                <!-- Display existing images for editing -->
                                                @foreach (explode(',', $product->images) as $image)
                                                    <img src="{{ asset($image) }}" width="100px" height="100px" class="img-thumbnail mr-2">
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter product description" required>{{ old('description', $product->description) }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Form End -->
    <script src="{{asset('js/preview.js')}}"></script>
@endsection
