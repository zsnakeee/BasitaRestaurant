@extends('layouts.app')
@section('title', 'الاصناف')

@section('content')
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-md-12 d-flex mb-2">
                    <div class="point"></div>
                    <p class="me-2 mb-0">{{ $category->name }}</p>
                </div>

                @forelse($category->products as $product)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="{{ Storage::url($product->image) }}" width="100px" height="100px"
                                     style="object-fit: contain" alt="{{ $product->name }}">

                                <p class="text-dark mb-0 fw-bold">{{ $product->name }}</p>
                                <p class="text-secondary mt-0">{{ $product->price }} ج.م</p>

                                <button class="btn btn-danger btn-sm w-100"
                                        style="@if(!isset(session('cart')[$product->id])) display: none; @endif"
                                        id="remove_{{ $product->id }}" onclick="remove_from_cart({{ $product->id }})">

                                    <i class="fa fa-trash"></i>
                                    حذف من السلة
                                </button>

                                <button class="btn btn-primary btn-sm main-btn w-100"
                                        style="@if(isset(session('cart')[$product->id])) display: none; @endif"
                                        id="add_{{ $product->id }}" onclick="add_to_cart({{ $product->id }})">

                                    <i class="fa fa-shopping-cart"></i>
                                    أضف إلى السلة
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 text-center">
                        <img src="{{ asset('assets/images/box.png') }}" width="200px" alt="">
                        <p class="text-secondary">لا يوجد منتجات في هذه الفئه</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
@endsection

@push('js')
    <script>
        function add_to_cart(id) {
            @if(!Auth::check())
                window.location.href = '{{ route('login') }}';
            @else
            $.ajax({
                url: '{{ route('cart.add') }}',
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function (data) {
                    $('#add_' + id).hide();
                    $('#remove_' + id).show();

                    let cart_badge = $('#cart-badge');
                    cart_badge.show();
                    cart_badge.html(data.count);
                }
            });
            @endif
        }

        function remove_from_cart(id) {
            @if(!Auth::check())
                window.location.href = '{{ route('login') }}';
            @else
            $.ajax({
                url: '{{ route('cart.remove') }}',
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function (data) {
                    $('#add_' + id).show();
                    $('#remove_' + id).hide();

                    let cart_badge = $('#cart-badge');
                    data.count ? cart_badge.show() : cart_badge.hide();
                    cart_badge.html(data.count);
                }
            });
            @endif
        }
    </script>
@endpush

