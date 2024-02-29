@include('layouts.header')
@include('layouts.navbar')
        <!-- Cart Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                        </thead>
                        <tbody>

                        {{-- card product start --}}
                        @foreach ($cartItems as $cartItem)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        @foreach (explode(',',$cartItem->product->images) as $image)
                                            <img src="{{ asset($image) }}" class="img-fluid me-5 rounded" style="width: 80px; height: 80px;" alt="Product Image">
                                        @endforeach
                                        <a href="{{ route('product.show', $cartItem->product->id) }}" class="btn btn-primary btn-sm">View</a>
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $cartItem->product->name }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">${{ $cartItem->product->price }}</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0 quantity-input" data-price="{{ $cartItem->product->price }}" value="{{ $cartItem->quantity }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 total">${{ $cartItem->product->price * $cartItem->quantity }}</p>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('remove.product', $cartItem->id) }}"> 
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-md rounded-circle bg-light border mt-4">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        {{-- card product end --}}

                        </tbody>
                    </table>
                </div>
                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Subtotal:</h5>
                                    <p id="subtotal" class="mb-0">$0.00</p> <!-- Dynamic Subtotal -->
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0 me-4">Shipping</h5>
                                    <div class="">
                                        <p class="mb-0">Flat rate: $3.00</p>
                                    </div>
                                </div>
                                <p class="mb-0 text-end">Shipping to Ukraine.</p>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Total</h5>
                                <p id="total" class="mb-0 pe-4">$0.00</p> <!-- Dynamic Total -->
                            </div>
                            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Cart Page End -->
    <script src="{{asset('js/quantity.js')}}"></script>

@include('layouts.footer')