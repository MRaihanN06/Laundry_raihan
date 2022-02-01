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
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalBuatPaket">
                        Buat Data Paket Baru
                    </button>
                
                    <!-- Modal -->
                    <div class="modal fade" id="ModalBuatPaket" tabindex="-1" aria-labelledby="ModalBuatPaketLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header text-dark">
                            <h5 class="modal-title" id="ModalBuatPaketLabel">Masukan Data Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-dark">
                            <form action="/paket" method="POST" class="mb-5" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                <label for="nama" class="form-label">Nama Outlet</label>
                                <select name="id_outlet" id="outlet" class="form-control js-example-basic-single w-100">
                                  @foreach ($outlet as $o)
                                  <option value="{{ $o->id }}">{{ $o->nama }}</option>
                                  @endforeach
                                </select>
                               </div>
                                <div class="mb-3">
                                    <label for="jenis" class="form-label">Jenis</label>
                                    <select class="form-control" name="jenis" id="jenis">
                                      <option value="kiloan">Kiloan</option>
                                      <option value="selimut">Selimut</option>
                                      <option value="bed_cover">Bed Cover</option>
                                      <option value="kaos">Kaos</option>
                                      <option value="lain">Lain</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                <label for="nama_paket" class="form-label">Nama Paket</label>
                                <input type="text" class="form-control @error('nama_paket') is-invalid @enderror" id="nama_paket" name="nama_paket" required autofocus>
                                @error('nama_paket')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" required autofocus>
                                @error('harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-warning">Posting</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
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
