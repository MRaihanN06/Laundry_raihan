<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Laundry MRaihanN</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets') }}/vendors/feather/feather.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('assets') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets') }}/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.png" />
  <!-- boostrap -->
  <link rel="stylesheet" href="{{ asset('assets') }}/bootstrap.min.css"> 
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
</head>
<body>
  <div class="container-scroller">
    
    @include('partials/navbar')

      @if(auth()->user()->role == 'admin')
        @include('partials/sidebar-admin')
      @elseif(auth()->user()->role == 'kasir')
        @include('partials/sidebar-kasir')
      @elseif(auth()->user()->role == 'owner')
        @include('partials/sidebar-owner')
      @endif

      @yield('content')
        
        @include('partials/footer')

        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  {{-- js bootsrap --}}
  <script src="{{ asset('assets') }}/bootstrap.bundle.min.js"></script>
  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> --}}

  <script src="{{ asset('assets') }}/sweetalert/sweetalert.min.js"></script>

  <!-- plugins:js -->
  <script src="{{  asset('assets')  }}/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->

<!-- Jquery -->
<script src="{{  asset('assets')  }}/js/jquery.min.js"></script>
<script src="{{  asset('assets')  }}/js/jquery.dataTables.min.js"></script>
<!--end Jquery -->

  <!-- Plugin js for this page -->
  <script src="{{  asset('assets')  }}/vendors/chart.js/Chart.min.js"></script>
  <script src="{{  asset('assets')  }}/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="{{  asset('assets')  }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="{{  asset('assets')  }}/js/dataTables.select.min.js"></script>
  <script src="{{  asset('assets')  }}/js/data-table.js"></script>
  <!-- End plugin js for this page -->

  <!-- inject:js -->
  <script src="{{  asset('assets')  }}/js/off-canvas.js"></script>
  <script src="{{  asset('assets')  }}/js/hoverable-collapse.js"></script>
  <script src="{{  asset('assets')  }}/js/template.js"></script>
  <script src="{{  asset('assets')  }}/js/settings.js"></script>
  <script src="{{  asset('assets')  }}/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{  asset('assets')  }}/js/dashboard.js"></script>
  <script src="{{  asset('assets')  }}/js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->

  @stack('script')
</body>

</html>

