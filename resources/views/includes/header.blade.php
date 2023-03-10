<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="<?= CURRENT_LOCALE_DIRECTION ?>">
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>@yield('head-title') : <?= getStoreSettings('name') ?></title>
	<!-- Custom fonts for this template-->
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
	<link rel="shortcut icon" href="public/<?= getStoreSettings('favicon_image_url') ?>" type="image/x-icon">
	<link rel="icon" href="public/<?= getStoreSettings('favicon_image_url') ?>" type="image/x-icon">

	<!-- Primary Meta Tags -->
	<meta name="title" content="@yield('page-title')">
	<meta name="description" content="@yield('description')">
	<meta name="keywordDescription" property="og:keywordDescription" content="@yield('keywordDescription')">
	<meta name="keywordName" property="og:keywordName" content="@yield('keywordName')">
	<meta name="keyword" content="@yield('keyword')">
	<!-- Google Meta -->
	<meta itemprop="name" content="@yield('page-title')">
	<meta itemprop="description" content="@yield('description')">
	<meta itemprop="image" content="@yield('page-image')">
	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="@yield('page-url')">
	<meta property="og:title" content="@yield('page-title')">
	<meta property="og:description" content="@yield('description')">
	<meta property="og:image" content="@yield('page-image')">
	<!-- Twitter -->
	<meta property="twitter:card" content="@yield('twitter-card-image')">
	<meta property="twitter:url" content="@yield('page-url')">
	<meta property="twitter:title" content="@yield('page-title')">
	<meta property="twitter:description" content="@yield('description')">
	<meta property="twitter:image" content="@yield('page-image')">

	<!-- Custom styles for this template-->
	 <link href="{{ asset('/dist/css/public-assets-app.min.css') }}" rel="stylesheet">
	 <link href="{{ asset('/dist/fa/css/all.min.css') }}" rel="stylesheet">
	 <link href="{{ asset('/dist/css/vendorlibs-datatable.css') }}" rel="stylesheet">
	 <link href="{{ asset('/dist/css/vendorlibs-photoswipe.css') }}" rel="stylesheet">
	 <link href="{{ asset('/dist/css/vendorlibs-smartwizard.css') }}" rel="stylesheet">
	 <link href="{{ asset('/dist/css/custom.min.css') }}" rel="stylesheet">
	 <link href="{{ asset('/dist/css/messenger.min.css') }}" rel="stylesheet">
	 <link href="{{ asset('/dist/css/login-register.min.css') }}" rel="stylesheet">
	 <!-- <link href="{{ asset('/dist/css/custom.src.css') }}" rel="stylesheet"> -->
	 <link href="{{ asset('/dist/css/messenger.src.css') }}" rel="stylesheet">
	 <link href="{{ asset('/frontend/css/ppm-custom.css') }}" rel="stylesheet">
	 <link href="{{ asset('/dist/css/login-register.src.css') }}" rel="stylesheet">
	@stack('header')
	<link href="{{ asset('/dist/css/style.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('/backend/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script src="{{ asset('/dist/js/common-app.min.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('/frontend/glightbox/css/glightbox.css') }}" />
</head>