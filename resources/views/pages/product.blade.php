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
							<img src="images/item-cart-01.jpg" alt="IMG">
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
							<img src="images/item-cart-02.jpg" alt="IMG">
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
							<img src="images/item-cart-03.jpg" alt="IMG">
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


	<!-- Product & Section -->
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					@if ($count == 0)
						<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
							All Products
						</button>


						@foreach ($sections as $item)
							<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{ $item->id }}">
								{{ $item->name }}
							</button>
						@endforeach
					@else
						<h4></h4>
					@endif

				</div>

				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product"
							placeholder="Search">
					</div>
				</div>
			</div>

			<div class="row isotope-grid">

				@foreach ($products as $item)
					<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ $item->section_id }}">
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


			<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
				<div class="overlay-modal1 js-hide-modal1"></div>
				<div class="container">
					<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
						<button class="how-pos3 hov3 trans-04 js-hide-modal1">
							<img src="{{ asset('images/icons/icon-close.png') }}" alt="CLOSE">
						</button>

						<div class="row">
							<div class="col-md-6 col-lg-7 p-b-30">
								<div class="p-l-25 p-r-30 p-lr-0-lg">
									<div class="wrap-slick3 flex-sb flex-w">
										<div class="slick3">
											<div class="wrap-pic-w pos-relative">
												<div class="product-container">
													<!-- الصورة مع class المناسب -->
													<img class="product-image js-modal-img" src="" alt="IMG-PRODUCT">
													<!-- زر Quick View يظهر عند تمرير الماوس -->
													<a href="#" class="quick-view-btn" id="quick-view-link"
														data-url="{{ route('product.detail', ':id') }}">
														Product Details
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-6 col-lg-5 p-b-30">
								<div class="p-r-50 p-t-5 p-lr-0-lg">
									<h4 class="js-modal-name cl2 js-name-detail p-b-14">

									</h4>

									<span class="js-modal-price"></span>

									<p class="js-modal-desc cl3 p-t-23">

									</p>

									<!-- الحجم واللون والكمية -->
									<div class="container mt-5 d-flex justify-content-center">
										<div class="card shadow-lg border-0 rounded-4 p-4 bg-light"
											style="max-width: 480px; width: 100%;">
											<h3 class="text-center text-dark fw-bold mb-4">🛍 Customize Your Product</h3>

											<form id="addToCartForm" action="{{ route('shopping.cart', 1) }}" method="GET">
												<input type="hidden" name="product_id" id="modal-product-id">

												<!-- 🟢 اختيار الحجم -->
												<div class="mb-3">
													<label class="form-label fw-semibold">Choose Size</label>
													<select class="form-select border-0 rounded-pill p-3 shadow-sm"
														name="size">
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
													<select class="form-select border-0 rounded-pill p-3 shadow-sm"
														name="color">
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
														<input class="form-control text-center border-0 fw-bold"
															type="number" name="quantity" value="1" min="1" id="quantity"
															style="max-width: 50px;">
														<button
															class="btn btn-sm btn-outline-success fw-bold rounded-circle"
															type="button" id="increase">+</button>
													</div>
												</div>

												<!-- ✅ زر الإضافة -->
												<button type="submit"
													class="btn btn-dark w-100 fw-bold py-3 rounded-pill shadow-lg">
													<i class="fas fa-shopping-cart me-2"></i>Add To Cart
												</button>
											</form>
										</div>
									</div>


									<!-- إضافات مثل wishlist وغيرها -->
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
					</div>
				</div>
			</div>



			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Load More
				</a>
			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@endsection