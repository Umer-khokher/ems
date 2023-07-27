<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
			<h1 class="m-0">{{ $pageName }}</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					@foreach ($breadCrumbs as $breadCrumb)
					<li class="breadcrumb-item {{ $breadCrumb->class }}"><a href="{{ $breadCrumb->url }}">{{ $breadCrumb->name }}</a></li>
					@endforeach
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div><!-- /.content-header -->