<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title') | Admin Dashboard</title>
	@include('admin.includes.css')
    @yield('css')
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
	<script>
	// Show the progress bar
	NProgress.start();
	// Increase randomly
	var interval = setInterval(function() {
		NProgress.inc();
	}, 1000);
	// Trigger finish when page fully loaded
	$(window).load(function() {
		clearInterval(interval);
		NProgress.done();
	});
	// Trigger bar when exiting the page
	$(window).unload(function() {
		NProgress.start();
	});
	</script>
	<div class="wrapper">
		<!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
		<aside class="left-sidebar sidebar-dark" id="left-sidebar">
			<div id="sidebar" class="sidebar sidebar-with-footer">
				<!-- Aplication Brand -->
				<div class="app-brand">
					<a href="{{ route('admin.dashboard') }}"> <img src="{{ asset('assets/admin/images/logo.png') }}" style="width: 50px; background: #9e6de0; border-radius: 50%" alt="{{ config('app.name') }}"> <span class="brand-name"><h2 class="text-white">{{ config('app.name') }}</h2></span> </a>
				</div>
				<!-- begin sidebar scrollbar -->
				<div class="sidebar-left" data-simplebar style="height: 100%;">
					<!-- sidebar menu -->
					<ul class="nav sidebar-inner" id="sidebar-menu">


						@if (isAdmin())

                            <li class="{{ request()->is('admin/dashboard') ? 'active': '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.dashboard') }}"> <i class="mdi mdi-briefcase-account-outline"></i> <span class="nav-text">Dashboard</span> </a>
                            </li>

                            <li class="section-title"> Apps </li>

                            <li class="has-sub {{ request()->is('admin/fruits') || request()->is('admin/fruits/create') ? 'active': '' }}">
                                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#fruit" aria-expanded="false" aria-controls="fruit"> <i class="mdi mdi-image-filter-none"></i> <span class="nav-text">Fruits</span> <b class="caret"></b> </a>
                                <ul class="collapse" id="fruit" data-parent="#sidebar-menu">
                                    <div class="sub-menu">
                                        <li>
                                            <a class="sidenav-item-link" href="{{ route('admin.fruits.create') }}"> <span class="nav-text">New</span> </a>
                                        </li>
                                        <li>
                                            <a class="sidenav-item-link" href="{{ route('admin.fruits.index') }}"> <span class="nav-text">View All</span> </a>
                                        </li>
                                    </div>
                                </ul>
                            </li>

                            <li class="{{ request()->is('admin/users') ? 'active': '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.users.index') }}"> <i class="mdi mdi-account-group"></i> <span class="nav-text">Users</span> </a>
                            </li>

                        @endif

                        @if (isTranslator())
                            <li class="{{ request()->is('dashboard') ? 'active': '' }}">
                                <a class="sidenav-item-link" href="{{ route('dashboard') }}"> <i class="mdi mdi-briefcase-account-outline"></i> <span class="nav-text">Dashboard</span> </a>
                            </li>

                            <li class="section-title"> Apps </li>
                        @endif
                            {{-- @dd(request()->path('/languages')) --}}
                        <li class="{{ request()->is('sections') || request()->is('languages') == 'languages' || request()->is('fruits/*') == 'fruits/*'  ? 'active': '' }} ">
							<a class="sidenav-item-link" href="{{ route('sections.index') }}"> <i class="mdi mdi-wechat"></i> <span class="nav-text">Translations</span> </a>
						</li>

					</ul>
				</div>
				{{-- <div class="sidebar-footer">
					<div class="sidebar-footer-content">
						<ul class="d-flex">
							<li> <a href="user-account-settings.html" data-toggle="tooltip" title="Profile settings"><i class="mdi mdi-settings"></i></a></li>
							<li> <a href="#" data-toggle="tooltip" title="No chat messages"><i class="mdi mdi-chat-processing"></i></a> </li>
						</ul>
					</div>
				</div> --}}
			</div>
		</aside>
		<!-- ====================================
      ——— PAGE WRAPPER
      ===================================== -->
		<div class="page-wrapper">
			<!-- Header -->
			<header class="main-header" id="header">
				<nav class="navbar navbar-expand-lg navbar-light" id="navbar">
					<!-- Sidebar toggle button -->
					<button id="sidebar-toggler" class="sidebar-toggle"> <span class="sr-only">Toggle navigation</span> </button> <span class="page-title"></span>
					<div class="navbar-right ">

						<ul class="nav navbar-nav">
							<!-- Offcanvas -->
							<!-- User Account -->
							<li class="dropdown user-menu">
								<button class="dropdown-toggle nav-link" data-toggle="dropdown"> <img src="{{ asset('assets/admin/images/user/user-xs-01.jpg') }}" class="user-image rounded-circle" alt="User Image" /> <span class="d-none d-lg-inline-block">{{ auth()->user()->name }}</span> </button>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<a class="dropdown-link-item" href="{{ route('profile.edit') }}"> <i class="mdi mdi-account-outline"></i> <span class="nav-text">My Profile</span> </a>
									</li>
									<li class="dropdown-footer">
										<a href="{{ route('logout') }}" class="dropdown-link-item" href="sign-in.html"> <i class="mdi mdi-logout"></i> Log Out </a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
			@yield('content')

			<!-- Footer -->
			<footer class="footer mt-auto">
				<div class="copyright bg-white">
					<p> &copy; <span id="copy-year"></span> <a class="text-primary" href="http://www.cdlcell.com" target="_blank"><b>CDL</b></a>. All rights reserved. </p>
				</div>
				<script>
				var d = new Date();
				var year = d.getFullYear();
				document.getElementById("copy-year").innerHTML = year;
				</script>
			</footer>
		</div>
	</div>

    @include('admin.includes.scripts')
    @yield('scripts')
</body>

</html>
