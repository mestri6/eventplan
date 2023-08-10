<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Event Planner - Detail Layanan
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/logo-eventplan-sm.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/logo-eventplan-sm.png') }}" />

    @stack('before-style')
    @include('includes.style')
    @stack('after-style')
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        @yield('content')

    </div>

    @stack('before-script')
    @include('includes.script')
    @stack('after-script')
</body>

</html>