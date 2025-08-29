@extends('layouts.master')

@section('contant')

	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-02.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			My Favorites
		</h2>
	</section>

	<!-- Favorites -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="mtext-105 cl2 txt-center p-t-50 p-b-30">
					Favorites
				</h2>
			</div>
		</div>
	</div>


	<div class="row isotope-grid">

		@foreach ($favorites as $favorite)
			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ $favorite->section_id }}">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="{{ asset($favorite->product->img) }}" alt="IMG-PRODUCT"
							style="max-height: 200px !important;min-height:250px !important; margin-left: 20px;">

					</div>
					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="{{ route('product.detail', $favorite->product->id) }}"
								class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6" style="margin-left: 20px; margin-right: 20px;">
								{{ $favorite->product->name }}
							</a>

							<span class="stext-105 cl3" style="margin-left: 20px; margin-right: 20px;">
								${{ $favorite->product->price }}
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							@php
								$isFavorite = Auth::check() && Auth::user()->favorites->contains('product_id', $favorite->id);
							@endphp

							<a href="{{ route('favorite.destroy', $favorite->id) }}" data-id="{{ $favorite->id }}"
								class="dis-block pos-relative {{ $isFavorite ? 'js-addedwish-b2' : '' }}"
								style="margin-left:20px; margin-right: 20px;">
								
									{{-- <img class="icon-heart1 dis-block trans-04"
										src="{{ asset('images/icons/icon-heart-01.png') }}" alt="ICON"> --}}

									<img class="icon-heart1 dis-block trans-04 ab-t-l"
										src="{{ asset('images/icons/icon-heart-02.png') }}" alt="ICON">
							
							</a>


						</div>
					</div>
				</div>
			</div>
		@endforeach



	</div>


@endsection