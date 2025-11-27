<!-- Title -->
<title>@yield('title', __('trans.school_mangement_system'))</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Font -->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Cairo:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@yield('css')
<!--- Style css -->

<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/wizard.css') }}" rel="stylesheet" id="bootstrap-css">

<!--- Style css -->

@if (app()->getLocale() == 'ar')
    <link href="{{ asset('assets/css/rtl.css') }}" rel="stylesheet">
@else
    <link href="{{ asset('assets/css/ltr.css') }}" rel="stylesheet">
@endif
