<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ $pageName }} | {{ env('APP_NAME') }}</title>

		<x-admin.styles />
		{{ $inPageCss }}
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
		<!-- jQuery -->
		<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
		
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
	
		<div class="wrapper">
		
			<!-- Preloader -->
			<x-admin.loader />
			
			<!-- Navbar -->
			<x-admin.navbar />

			<!-- Main Sidebar Container -->
			<x-admin.left-menu :pageName="$pageName" />

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
			
				<!-- Content Header (Page header) -->
				{{ $breadCrumbs }}

				<!-- Main content -->
				<section class="content">
				
					{{ $slot }}
					
				</section>
				
			</div>

			<!-- Footer -->
			<x-admin.footer />

			<!-- Control Sidebar -->
			<aside class="control-sidebar control-sidebar-dark">
				<!-- Control sidebar content goes here -->
			</aside>
			<!-- /.control-sidebar -->
			
		</div>
		
		<x-admin.scripts />
		{{ $inPageJs }}
		<!-- AdminLTE App -->
		<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
		
	</body>
</html>