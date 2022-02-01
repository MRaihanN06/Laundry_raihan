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
                          @foreach ($paket as $paket)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $paket->id_outlet }}</td>
                              <td>
                                @if ( $paket->jenis == 'bed_cover')
                                    Bed Cover      
                                    @else
                                      {{ $paket->jenis }} 
                                  
                                @endif
                               </td>
                              <td>{{ $paket->nama_paket }}</td>
                              <td>Rp. {{ number_format($paket->harga) }}</td>
                              <td>
                                <!-- Button trigger modal -->
                              <button type="button" class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#ModalPerbaharuiData{{ $paket->id }}">
                                <i class="ti-pencil-alt"></i>
                              </button>

                              <!-- Modal -->
                              <div class="modal fade" id="ModalPerbaharuiData{{ $paket->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalPerbaharuiDataLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header text-dark">
                                      <h5 class="modal-title" id="ModalPerbaharuiDataLabel">Perbaharui Data</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-dark">
                                      <form action="{{ url('paket/'.$paket->id) }}" method="POST" class="mb-5" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="mb-3">
                                          <label for="nama" class="form-label">Nama Outlet</label>
                                          <select name="id_outlet" id="outlet" class="form-control js-example-basic-single w-100">
                                            @foreach ($outlet as $otl)
                                            @if (old('id_outlet')&&old('id_outlet')==$otl->id)
                                              <option value="{{ $otl->id }}" selected>{{ $otl->nama }}</option>
                                            @else
                                            @endif
                                            <option value="{{ $otl->id }}">{{ $otl->nama }}</option>
                                            @endforeach
                                          </select>
                                         </div>
                                        <div class="mb-3">
                                            <label for="jenis" class="form-label">Jenis</label>
                                            <select class="form-control" name="jenis" id="jenis">
                                              <option value="kiloan" @if($paket->jenis == 'kiloan') selected @endif>Kiloan</option>
                                              <option value="selimut" @if($paket->jenis == 'selimut') selected @endif>Selimut</option>
                                              <option value="bed_cover" @if($paket->jenis == 'bed_cover') selected @endif>Bed Cover</option>
                                              <option value="kaos" @if($paket->jenis == 'kaos') selected @endif>Kaos</option>
                                              <option value="lain" @if($paket->jenis == 'lain') selected @endif>Lain</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                        <label for="nama_paket" class="form-label">Nama Paket</label>
                                        <input type="text" class="form-control @error('nama_paket') is-invalid @enderror" id="nama_paket" name="nama_paket" required autofocus value="{{ old('nama', $paket->nama_paket) }}">
                                        @error('nama_paket')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="mb-3">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" required autofocus value="{{ old('nama', $paket->harga) }}">
                                        @error('harga')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                      <button type="submit" class="btn btn-warning">Posting</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                                
                              </td>
                            </tr>
                          @endforeach
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