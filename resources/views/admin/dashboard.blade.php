@extends('layouts.app')

@section('content')

<!-- Primary table start -->
<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="text-success display-6">Fruitbasket</h4>
            <p class="text-warning text-sm mb-0" style="font-size: 0.8rem !important; margin-top: -0.5rem;">Fresh products</p>
            <a href="{{ route('products.create') }}" class="btn btn-success btn-sm float-right mb-2 mr-3">Add Product</a>
            <div class="data-tables table-hover datatable-primary">
                <table id="dataTable2" class="text-center">
                    <thead class="text-capitalize">
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Price (INR)</th>
                            <th>Stock</th>
                            <th>Action</th>
                            <th>Images</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                            <td style="color: {{ $product->stock > 0 ? 'green' : 'red' }}">{{ $product->stock }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product) }}" class="text-primary">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form method="POST" action="{{ route('products.destroy', $product) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger" onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                            <div style="display: flex; justify-lest: center; align-items: center;">
                                @if (!is_null($product->images))
                                    @foreach (explode(',', $product->images) as $image)
                                        <img src="{{ asset($image) }}" alt="Product Image" style="width: 50px; height: auto; margin-right: 10px;">
                                    @endforeach
                                @endif
                            </div>
                        </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- table js links --}}
<script src="{{ asset('table/js/vendor/jquery-2.2.4.min.js') }}"></script>
<!-- bootstrap 5 js -->
<script src="{{ asset('table/js/popper.min.js') }}"></script>
<script src="{{ asset('table/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('table/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('table/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('table/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('table/js/jquery.slicknav.min.js') }}"></script>
<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<!-- others plugins -->
<script src="{{ asset('table/js/plugins.js') }}"></script>
<script src="{{ asset('table/js/scripts.js') }}"></script>
{{-- table js link end --}}

{{-- Sweet alerts --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function showMessage(message, messageType) {
        swal({
            title: messageType,
            text: message,
            icon: messageType,
        });
    }
</script>

@if (session()->has('success'))
    <script>
        showMessage('{{ session()->get('success') }}', 'success');
    </script>
@endif
@if (session()->has('update'))
    <script>
        showMessage('{{ session()->get('update') }}', 'success');
    </script>
@endif
@endsection
