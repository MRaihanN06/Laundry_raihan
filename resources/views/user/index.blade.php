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
                <h3 class="font-weight-bold">Master Data User</h3>
                <h6 class="font-weight-normal mb-0">Membuat, Melihat, Perbaharui dan Hapus Data User <span class="text-primary">Hati-hati dengan keputusan anda!</span></h6>
              </div>
            </div>
            <br>
            <br>
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title">Tabel User</p>
                <div class="row">
                  <div class="col-12">
                    <div class="table-responsive">
                    
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">
                      Buat Data User Baru
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="ModalTambahUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalTambahUserLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header text-dark">
                            <h5 class="modal-title" id="ModalTambahUser">Tambah Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body text-dark">
                            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                              <div class="brand-logo">
                                <img src="{{ asset('assets') }}/images/logo.svg" alt="logo">
                              </div>
                              <h4>New here?</h4>
                              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                              <form class="pt-3" action="/{{ request()->segment(1) }}/user" method="post">
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
                                <div class="form-group">
                                  <select name="id_outlet" id="outlet" class="form-control js-example-basic-single w-100">
                                    @foreach ($outlet as $o)
                                    <option value="{{ $o->id }}">{{ $o->nama }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                  <select class="form-control" name="role" id="role">
                                    <option value="admin">Admin</option>
                                    <option value="kasir">Kasir</option>
                                    <option value="owner">Owner</option>
                                  </select>
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
                                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                
                    <br>
                    <br>
                      <table class="display expandable-table" style="width:100%" id="tb-user">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Id Outlet</th>
                            <th>Role</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($user as $user)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>{{ $user->id_outlet }}</td>
                              <td>{{ $user->role }}</td>
                              <td>
                                <!-- Button trigger modal -->
                              <button type="button" class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#ModalPerbaharuiData{{ $user->id }}">
                                <i class="ti-pencil-alt"></i>
                              </button>

                              <!-- Modal -->
                              <div class="modal fade" id="ModalPerbaharuiData{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalPerbaharuiDataLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header text-dark">
                                      <h5 class="modal-title" id="ModalPerbaharuiDataLabel">Perbaharui Data</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-dark">
                                      <form action="/{{ request()->segment(1) }}/user/{{ $user->id }}" method="POST" class="mb-5" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name', $user->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div><div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required autofocus value="{{ old('email', $user->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
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
                                          <label for="role" class="form-label">Role</label>
                                          <select class="form-control" name="role" id="role">
                                            <option value="admin" @if($user->jenis == 'admin') selected @endif>Admin</option>
                                            <option value="kasir" @if($user->jenis == 'kasr') selected @endif>Kasir</option>
                                            <option value="owner" @if($user->jenis == 'owner') selected @endif>Owner</option>
                                          </select>
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
                                <form action="/{{ request()->segment(1) }}/user/{{ $user->id }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger text-light border-0" onclick="return confirm('Anda Yakin Ingin Menghapus?')"><i class="ti-close"></i></button>
                                </form> 
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

      @push('script')
      <script>
        $(function(){
          $('#tb-user').DataTable();
        });
      </script>
      @endpush

@endsection
