@php
    use App\Models\Review;
@endphp
@extends('layouts.master')

@section('contant')
    <!-- Cart -->
    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>

        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">
                    Your Cart
                </span>

                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>

            <div class="header-cart-content flex-w js-pscroll">
                <ul class="header-cart-wrapitem w-full">
                    <li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img">
                            <img src="{{ asset('images/item-cart-01.jpg') }}" alt="IMG">
                        </div>

                        <div class="header-cart-item-txt p-t-8">
                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                White Shirt Pleat
                            </a>

                            <span class="header-cart-item-info">
                                1 x $19.00
                            </span>
                        </div>
                    </li>

                    <li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img">
                            <img src="{{ asset('images/item-cart-02.jpg') }}" alt="IMG">
                        </div>

                        <div class="header-cart-item-txt p-t-8">
                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                Converse All Star
                            </a>

                            <span class="header-cart-item-info">
                                1 x $39.00
                            </span>
                        </div>
                    </li>

                    <li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img">
                            <img src="{{ asset('images/item-cart-03.jpg') }}" alt="IMG">
                        </div>

                        <div class="header-cart-item-txt p-t-8">
                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                Nixon Porter Leather
                            </a>

                            <span class="header-cart-item-info">
                                1 x $17.00
                            </span>
                        </div>
                    </li>
                </ul>

                <div class="w-full">
                    <div class="header-cart-total w-full p-tb-40">
                        Total: $75.00
                    </div>

                    <div class="header-cart-buttons flex-w w-full">
                        <a href="shoping-cart.html"
                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            View Cart
                        </a>

                        <a href="shoping-cart.html"
                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            Check Out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ route('product.index') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Men
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                @foreach ($product as $item)
                    {{ $item->name }}
                @endforeach
            </span>
        </div>
    </div>


    <!-- Product Detail -->
    @foreach ($product as $product)
        <section class="sec-product-detail bg0 p-t-65 p-b-60">
            <div class="container">

                <div class="row">
                    <div class="col-md-6 col-lg-7 p-b-30">
                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                            <div class="wrap-slick3 flex-sb flex-w">
                                {{-- <div class="wrap-slick3-dots"></div> --}}
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
                                <div class="slick3 gallery-lb">

                                    <div class="item-slick3" data-thumb="#">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ asset($product->img) }}" alt="IMG-PRODUCT">

                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">


                            <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                {{ $product->name }}
                            </h4>

                            <span class="mtext-106 cl2">
                                ${{ $product->price }}
                            </span>

                            <p class="stext-102 cl3 p-t-23">
                                {{ $product->description }}
                            </p>
    @endforeach

                        <!-- الحجم واللون والكمية -->
                        <div class="container mt-5 d-flex justify-content-center">
                            <div class="card shadow-lg border-0 rounded-4 p-4 bg-light"
                                style="max-width: 480px; width: 100%;">
                                <h3 class="text-center text-dark fw-bold mb-4">🛍 Customize Your Product</h3>

                                <form id="addToCartForm" action="{{ route('shopping.cart') }}" method="GET">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <!-- 🟢 اختيار الحجم -->
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Choose Size</label>
                                        <select class="form-select border-0 rounded-pill p-3 shadow-sm" name="size">
                                            <option selected disabled>-- Select Size --</option>
                                            <option>Small</option>
                                            <option>Medium</option>
                                            <option>Large</option>
                                            <option>X-Large</option>
                                        </select>
                                    </div>

                                    <!-- 🔵 اختيار اللون -->
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Choose Color</label>
                                        <select class="form-select border-0 rounded-pill p-3 shadow-sm" name="color">
                                            <option selected disabled>-- Select Color --</option>
                                            <option>Red</option>
                                            <option>Blue</option>
                                            <option>White</option>
                                            <option>Black</option>
                                        </select>
                                    </div>

                                    <!-- 🟠 اختيار الكمية -->
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Quantity</label>
                                        <div
                                            class="d-flex justify-content-between align-items-center border rounded-pill p-2 shadow-sm bg-white">
                                            <button class="btn btn-sm btn-outline-danger fw-bold rounded-circle"
                                                type="button" id="decrease">−</button>
                                            <input class="form-control text-center border-0 fw-bold" type="number"
                                                name="quantity" value="1" min="1" id="quantity" style="max-width: 50px;">
                                            <button class="btn btn-sm btn-outline-success fw-bold rounded-circle"
                                                type="button" id="increase">+</button>
                                        </div>
                                    </div>

                                    <!-- ✅ زر الإضافة -->
                                    <button type="submit" class="btn btn-dark w-100 fw-bold py-3 rounded-pill shadow-lg">
                                        <i class="fas fa-shopping-cart me-2"></i>Add To Cart
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!--  -->
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                    data-tooltip="Add to Wishlist">
                                    <i class="zmdi zmdi-favorite"></i>
                                </a>
                            </div>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Facebook">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Twitter">
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Google Plus">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional information</a>
                        </li>

                        @php
                            $count = Review::where('product_id', $product->id)->count();
                        @endphp
                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews ({{$count}})</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        {{-- @foreach ($product as $item) --}}
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {{ $product->description }}
                                </p>

                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="information" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <ul class="p-lr-28 p-lr-15-sm">
                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                Weight
                                            </span>

                                            <span class="stext-102 cl6 size-206">
                                                0.79 kg
                                            </span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                Dimensions
                                            </span>

                                            <span class="stext-102 cl6 size-206">
                                                110 x 33 x 100 cm
                                            </span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                Materials
                                            </span>

                                            <span class="stext-102 cl6 size-206">
                                                60% cotton
                                            </span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                Color
                                            </span>

                                            <span class="stext-102 cl6 size-206">
                                                Black, Blue, Grey, Green, Red, White
                                            </span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                Size
                                            </span>

                                            <span class="stext-102 cl6 size-206">
                                                XL, L, M, S
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div class="p-b-30 m-lr-15-sm">
                                        <!-- Review -->
                                        @php
                                            $Reviews = Review::with('user')
                                                ->where('product_id', $product->id)
                                                ->latest()
                                                ->get();
                                        @endphp
                                        @if ($count == 0)
                                            <p style="font-size: larger; text-align: center; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">THER ARE NO REVIEWS YET!.</p>
                                        @else
                                            @foreach ($Reviews as $review)
                                                <div class="flex-w flex-t p-b-68">
                                                    <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                        <img src="{{ asset($review->user->profile_image ?? 'images/user.jpg') }}"
                                                            alt="AVATAR">
                                                    </div>

                                                    <div class="size-207">
                                                        <div class="flex-w flex-sb-m p-b-17">
                                                            <span class="mtext-107 cl2 p-r-20">
                                                                {{$review->user->name}}
                                                            </span>

                                                            <span class="fs-18 cl11">
                                                                @php
                                                                    $count = 5 - $review->rating;
                                                                @endphp
                                                                @for ($i = 1; $i <= $review->rating; $i++)
                                                                    <i class="zmdi zmdi-star"></i>
                                                                @endfor

                                                                @for ($i = 0; $i < $count; $i++)
                                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                                @endfor
                                                            </span>
                                                        </div>

                                                        <p class="stext-102 cl6">
                                                            {{$review->comment}}
                                                        </p>

                                                        @if (Auth::check() && Auth::id() === $review->user_id)
                                                            <form action="{{ route('reviews.destroy', $review->id) }}" method="post" class="d-inline-block js-review-delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 js-review-delete-btn">
                                                                    Delete my review
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif



                                        <!-- Add review -->
                                        <form action="{{ route('review') }}" method="post">
                                            @csrf
                                            <h5 class="mtext-108 cl2 p-b-7">
                                                Add a review
                                            </h5>

                                            <p class="stext-102 cl6">
                                                <span style="color: red"> Note: Your Rating and Your review are required!.
                                                </span>
                                            </p>

                                            <div class="flex-w flex-m p-t-50 p-b-23">
                                                <span class="stext-102 cl3 m-r-16">
                                                    Your Rating
                                                </span>

                                                <span class="wrap-rating fs-18 cl11 pointer">
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <input class="dis-none" type="number" name="rating" required>
                                                </span>
                                            </div>


                                            <div class="row p-b-25">
                                                <div class="col-12 p-b-5">
                                                    <label class="stext-102 cl3" for="comment">Your review</label>
                                                    <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10"
                                                        id="comment" name="comment" required></textarea>
                                                </div>

                                                {{-- <div class="col-sm-6 p-b-5">
                                                    <label class="stext-102 cl3" for="name">Name</label>
                                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text"
                                                        name="name">
                                                </div>

                                                <div class="col-sm-6 p-b-5">
                                                    <label class="stext-102 cl3" for="email">Email</label>
                                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email"
                                                        type="text" name="email">
                                                </div> --}}
                                            </div>

                                            <button
                                                class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10"
                                                type="submit">
                                                Submit
                                            </button>
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- @endforeach --}}

                    </div>
                </div>
            </div>
        </div>

        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
            <span class="stext-107 cl6 p-lr-25">
                SKU: JAK-01
            </span>

            <span class="stext-107 cl6 p-lr-25">
                Categories: Jacket, Men
            </span>
        </div>
    </section>


    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    Related Products
                </h3>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">

                    @foreach ($SectionProduct as $item)
                        <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                            <!-- Block2 -->
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="{{ asset($item->img) }}" alt="IMG-PRODUCT"
                                        style="max-height: 200px !important;min-height:250px !important">

                                    <a href="#"
                                        class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
                                        data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-price="{{ $item->price }}"
                                        data-description="{{ $item->description }}" data-img="{{ asset($item->img) }}">
                                        Quick View
                                    </a>
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="{{ route('product.detail', $item->id) }}"
                                            class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            {{ $item->name }}
                                        </a>

                                        <span class="stext-105 cl3">
                                            ${{ $item->price }}
                                        </span>
                                    </div>

                                    <div class="block2-txt-child2 flex-r p-t-3">
                                        @php
                                            $isFavorite = Auth::check() && Auth::user()->favorites->contains('product_id', $item->id);
                                        @endphp

                                        <a href="{{ route('favorite.toggle', $item->id) }}" data-id="{{ $item->id }}"
                                            class="btn-addwish-b2 dis-block pos-relative {{ $isFavorite ? 'js-addedwish-b2' : '' }}">
                                            <img class="icon-heart1 dis-block trans-04"
                                                src="{{ asset('images/icons/icon-heart-01.png') }}" alt="ICON">

                                            <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                                src="{{ asset('images/icons/icon-heart-02.png') }}" alt="ICON">
                                        </a>


                                    </div>


                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection