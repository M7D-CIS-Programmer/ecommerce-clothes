@php
	use App\Models\ShoppingCart;
	use App\Models\Favorite;
@endphp
<!-- Header -->
<header class="header-v3">
	<!-- Header desktop -->
	<div class="container-menu-desktop trans-03 fix-menu-desktop">
		<div class="wrap-menu-desktop" style="top: 0px;">
			<nav class="limiter-menu-desktop p-l-45">

				<!-- Logo desktop -->
				<a href="#" class="logo">
					<img src="{{ asset('images/icons/logo-02.png') }}" alt="IMG-LOGO">
				</a>

				<!-- Menu desktop -->
				<div class="menu-desktop">
					<ul class="main-menu">
						<li>
							<a href="{{ route('home') }}">Home</a>
						</li>

						<li>
							<a href="{{ route('product.index') }}">Shop</a>
						</li>

						<li>
							<a href="{{route('blog')}}">Blog</a>
						</li>

						<li>
							<a href="{{route('about')}}">About</a>
						</li>

						<li>
							<a href="{{route('contact')}}">Contact</a>
						</li>
					</ul>
				</div>

				<!-- Icon header -->
				{{-- <div class="wrap-icon-header flex-w flex-r-m h-full">
					<div class="flex-c-m h-full p-r-25 bor6">
						<div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart"
							data-notify="2">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>
					</div>

					<div class="flex-c-m h-full p-lr-19">
						<div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
							<i class="zmdi zmdi-menu"></i>
						</div>
					</div>
				</div> --}}


				<div class="wrap-icon-header flex-w flex-r-m h-full">
					<!-- أيقونة السلة -->
					<div class="flex-c-m h-full p-r-25 bor6">
						@php
							$id_user = Auth::id();
							if (ShoppingCart::where('user_id', $id_user)->count() > 0) {
								$cartCount = ShoppingCart::where('user_id', $id_user)->count();
							} else {
								$cartCount = 0;
							}
						@endphp
						<a href="shopping-cart">
							<div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 icon-header-noti"
								data-notify="{{ $cartCount }}">
								<i class="zmdi zmdi-shopping-cart"></i>
							</div>
						</a>
					</div>

					<!-- أيقونة الملف الشخصي -->
					{{-- <div class="flex-c-m h-full p-lr-19">
						<a href="profile.html" class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11">
							<i class="zmdi zmdi-account"></i>
						</a>
					</div> --}}


					<!-- صورة البروفايل -->
					<div class="flex-c-m h-full p-lr-19">
						<a href="javascript:void(0)" data-toggle="modal" data-target="#profileModal">
							<img src="{{ asset(optional(Auth::user())->profile_image ?? 'images/user.jpg') }}"
								alt="Profile Photo" class="rounded-full"
								style="width:40px; height:40px; object-fit:cover; border-radius:50%;">
						</a>
					</div>

					<!-- Modal البروفايل -->
					<div class="modal fade" id="profileModal" tabindex="-1" role="dialog"
						aria-labelledby="profileModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content p-4">
								<div class="modal-header">
									<h5 class="modal-title" id="profileModalLabel">Profile</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>

								<div class="modal-body text-center">
									<!-- صورة -->
									<img src="{{ asset(optional(Auth::user())->profile_image ?? 'images/default-user.png') }}"
										alt="Profile" class="rounded-full"
										style="width:40px; height:40px; object-fit:cover; border-radius:50%;">


									<!-- معلومات المستخدم -->
									<p><strong>Name:</strong> {{ Auth::user()->name }}</p>
									<p><strong>Email:</strong> {{ Auth::user()->email }}</p>

									<!-- فورم التعديل -->
									<form action="{{ route('profile.update') }}" method="POST"
										enctype="multipart/form-data">
										@csrf
										@method('PUT')

										<div class="form-group text-left">
											<label>Edit Name</label>
											<input type="text" name="name" class="form-control"
												value="{{ Auth::user()->name }}">
										</div>

										<div class="form-group text-left">
											<label>Edit Email</label>
											<input type="email" name="email" class="form-control"
												value="{{ Auth::user()->email }}">
										</div>

										<div class="form-group text-left">
											<label>Change Photo</label>
											<input type="file" name="profile_image" class="form-control">
										</div>

										<button type="submit" class="btn btn-primary btn-block">Save</button>
									</form>
								</div>
							</div>
						</div>
					</div>



					<!-- أيقونة المفضلة -->
					@php
						$id_user = Auth::id();

						if (Favorite::where('user_id', $id_user)->count() > 0) {
							$favoritesCount = Favorite::where('user_id', $id_user)->count();
						} else {
							$favoritesCount = 0;
						} 
					  @endphp

					<a href="{{ route('favorites.index') }}"
						class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
						data-notify="{{ $favoritesCount }}">
						<i class="zmdi zmdi-favorite-outline"></i>
					</a>

					<!-- أيقونة القائمة الجانبية -->
					<div class="flex-c-m h-full p-lr-19">
						<div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
							<i class="zmdi zmdi-menu"></i>
						</div>
					</div>


				</div>

			</nav>
		</div>
	</div>

	<!-- Header Mobile -->
	<div class="wrap-header-mobile">
		<!-- Logo moblie -->
		<div class="logo-mobile">
			<a href="{{ route('home') }}"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
		</div>

		<!-- Icon header -->
		<div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">
			<div class="flex-c-m h-full p-r-5">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart"
					data-notify="2">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>
			</div>
		</div>

		<!-- Button show menu -->
		<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</div>
	</div>


	<!-- Menu Mobile -->
	<div class="menu-mobile">
		<ul class="main-menu-m">
			<li>
				<a href="{{ route('home') }}">Home</a>
				<span class="arrow-main-menu-m">
					<i class="fa fa-angle-right" aria-hidden="true"></i>
				</span>
			</li>

			<li>
				<a href="{{ route('product.index') }}">Shop</a>
			</li>

			<li>
				<a href="{{route('blog')}}">Blog</a>
			</li>

			<li>
				<a href="{{route('about')}}">About</a>
			</li>

			<li>
				<a href="{{route('contact')}}">Contact</a>
			</li>
		</ul>
	</div>

	<!-- Modal Search -->
	<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
		<button class="flex-c-m btn-hide-modal-search trans-04">
			<i class="zmdi zmdi-close"></i>
		</button>

		<form class="container-search-header">
			<div class="wrap-search-header">
				<input class="plh0" type="text" name="search" placeholder="Search...">

				<button class="flex-c-m trans-04">
					<i class="zmdi zmdi-search"></i>
				</button>
			</div>
		</form>
	</div>
</header>