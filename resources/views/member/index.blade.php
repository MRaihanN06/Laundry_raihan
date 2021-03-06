@extends('layouts/main')

@section('content')

    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          @if (session()->has('success'))
            <div class="alert alert-success text-center" role="alert" id="success-alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
            </div>
                </button>
          @endif
          @if ($errors->any())
            <div class="alert alert-danger text-center" role="alert" id="error-alert">
                @foreach ($errors->all() as $error)
                  {{ $error }}
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
            </div>
                </button>
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalBuatMember">
                        Buat Data Member Baru
                    </button>

                    <a href="{{ route('export-member') }}" class="btn btn-success">
                      Export Member
                    </a>

                    <button type="button" class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#ModalImportMember">
                      Import Member
                    </button>

                    <a href="{{ route('importpdf-member') }}" target="_blank" class="btn btn-secondary">
                      Export PDF
                    </a>
  
                    <!-- Modal -->
                    <div class="modal fade" id="ModalImportMember" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalImportmemberLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header text-dark">
                            <h3 class="modal-title" id="ModalImportmemberLabel">Import Data</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body text-dark">
                            <form action="{{ route('import-member') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <input type="file" name="file" required>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-warning">Posting</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                
                    <!-- Modal -->
                    <div class="modal fade" id="ModalBuatMember" tabindex="-1" aria-labelledby="ModalBuatMemberLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header text-dark">
                            <h3 class="modal-title" id="ModalBuatMemberLabel">Masukan Data Baru</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-dark">
                            <form action="/{{ request()->segment(1) }}/member" method="POST" class="mb-5" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus>
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required autofocus>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                <label for="tlp" class="form-label">No Telepon</label>
                                <input type="text" class="form-control @error('tlp') is-invalid @enderror" id="tlp" name="tlp" required autofocus>
                                @error('tlp')
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
                      <table class="display expandable-table table-striped table-bordered" style="width:100%" id="tb-member">
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
                          @foreach ($member as $member)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $member->nama }}</td>
                              <td>{{ $member->alamat }}</td>
                              <td>{{ $member->jenis_kelamin }}</td>
                              <td>{{ $member->tlp }}</td>
                              <td>
                                <!-- Button trigger modal -->
                              <button type="button" class="btn btn-warning text-light mb-1" data-bs-toggle="modal" data-bs-target="#ModalPerbaharuiData{{ $member->id }}">
                                <i class="ti-pencil-alt"></i>
                              </button>

                              <!-- Modal -->
                              <div class="modal fade" id="ModalPerbaharuiData{{ $member->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalPerbaharuiDataLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header text-dark">
                                      <h3 class="modal-title" id="ModalPerbaharuiDataLabel">Perbaharui Data</h3>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-dark">
                                      <form action="/{{ request()->segment(1) }}/member/{{ $member->id }} " method="POST" class="mb-5" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus value="{{ old('nama', $member->nama) }}">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required autofocus value="{{ old('alamat', $member->alamat) }}">
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                                <option value="L" @if($member->jenis_kelamin == 'L') selected @endif>Laki-Laki</option>
                                                <option value="P" @if($member->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                        <label for="tlp" class="form-label">No Telepon</label>
                                        <input type="text" class="form-control @error('tlp') is-invalid @enderror" id="tlp" name="tlp" required autofocus value="{{ old('tlp', $member->tlp) }}">
                                        @error('tlp')
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
                                <form action="/{{ request()->segment(1) }}/member/{{ $member->id }}" method="post" class="d-inline">
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
          $('#tb-member').DataTable();
        });

        // menghapus alert
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });

        $("#error-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });
      </script>
      @endpush

@endsection
