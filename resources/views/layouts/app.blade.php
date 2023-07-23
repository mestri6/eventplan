<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>@yield('title')</title>
   @include('includes.backend.style')
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
            <div class="page-header">
              <h3 class="page-title">
                <span
                  class="page-title-icon bg-gradient-primary text-white me-2"
                >
                  <i class="mdi mdi-home"></i>
                </span>
                Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview
                    <i
                      class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"
                    ></i>
                  </li>
                </ul>
              </nav>
            </div>
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
    @stack('before-script')
    @include('includes.backend.script')
    @stack('after-script')
  </body>
</html>
