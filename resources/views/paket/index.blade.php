@extends('layouts/main')

@section('content')

    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          @if (session()->has('success'))
              <div class="alert alert-success text-center" role="alert">
                  {{ session('success') }}
              </div>  
          @endif
          <div class="col-md-12 grid-margin">
            <div class="row">
              <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Master Data Paket</h3>
                <h6 class="font-weight-normal mb-0">Membuat, Melihat, Perbaharui dan Hapus Data Paket <span class="text-primary">Hati-hati dengan keputusan anda!</span></h6>
              </div>
            </div>
            <br>
            <br>
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title">Tabel Paket</p>
                <div class="row">
                  <div class="col-12">
                    <div class="table-responsive">
                    
                    <br>
                    <br>
                      <table class="display expandable-table" style="width:100%" id="tb-paket">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Id Outlet</th>
                            <th>Jenis</th>
                            <th>Nama Paket</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                            <tr>
                            
                            </tr>
                        
                        </tbody>
                    </table>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>

          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->

@endsection
