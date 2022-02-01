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
                <h3 class="font-weight-bold">Master Data Member</h3>
                <h6 class="font-weight-normal mb-0">Membuat, Melihat, Perbaharui dan Hapus Data Member <span class="text-primary">Hati-hati dengan keputusan anda!</span></h6>
              </div>
            </div>
            <br>
            <br>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title">Tabel Member</p>
                <div class="row">
                  <div class="col-12">
                    <div class="table-responsive">
                    <!-- Button trigger modal -->
                   
                    <br>
                    <br>
                      <table class="display expandable-table" style="width:100%" id="tb-member">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>No Telepon</th>
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
