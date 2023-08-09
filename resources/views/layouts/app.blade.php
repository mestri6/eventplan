<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/logo-eventplan-sm.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/logo-eventplan-sm.png') }}" />
    <title>@yield('title')</title>

    @stack('before-style')
    @include('includes.backend.style')
    @stack('after-style')
  </head>
  <body>
    <div class="container-scroller">
     
   @include('includes.backend.navbar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        @include('includes.backend.sidebar')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            @include('includes.backend.breadcrumb')
            @yield('content')
          </div>
          <!-- content-wrapper ends -->
            @include('includes.backend.footer')
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('sweetalert::alert')
    @stack('before-script')
    @include('includes.backend.script')
    @stack('after-script')
  </body>
</html>
