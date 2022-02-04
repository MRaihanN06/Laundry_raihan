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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="{{ asset('assets') }}/images/logo.svg" alt="logo">
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form class="pt-3" action="{{ route('register') }}" method="post">
                @csrf
                @if(session('errors'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      Something it's wrong:
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                      <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                      </ul>
                  </div>
                @endif
                <div class="form-group">
                  <input type="text" name="name"class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Ketik Ulang Password">
                  </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      I agree to all Terms & Conditions
                    </label>
                  </div>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="../../index.html">SIGN UP</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
       

  {{-- js bootsrap --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


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