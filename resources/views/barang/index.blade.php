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
                            <h3 class="font-weight-bold">Master Data Barang</h3>
                            <h6 class="font-weight-normal mb-0">Membuat, Melihat, Perbaharui dan Hapus Data Barang <span
                                    class="text-primary">Hati-hati dengan keputusan anda!</span></h6>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title">Tabel Barang</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#ModalBuatBarang">
                                                    Buat Data Barang Baru
                                                </button>

                                                <a href="{{ route('export-barang') }}" class="btn btn-success">
                                                    Export Barang
                                                </a>

                                                <button type="button" class="btn btn-warning text-light"
                                                    data-bs-toggle="modal" data-bs-target="#ModalImportBarang">
                                                    Import Barang
                                                </button>

                                                <a href="{{ route('importpdf-barang') }}" target="_blank"
                                                    class="btn btn-secondary">
                                                    Export PDF
                                                </a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalImportBarang" data-bs-backdrop="static"
                                                    data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="ModalImportBarangLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-dark">
                                                                <h3 class="modal-title" id="ModalImportbarangLabel">
                                                                    Import Data</h3>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-dark">
                                                                <form action="{{ route('import-barang') }}" method="POST"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="file" name="file" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit"
                                                                    class="btn btn-warning">Posting</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalBuatBarang" tabindex="-1"
                                                    aria-labelledby="ModalBuatBarangLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-dark">
                                                                <h3 class="modal-title" id="ModalBuatBarangLabel">Masukan
                                                                    Data Baru</h3>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-dark">
                                                                <form action="/{{ request()->segment(1) }}/barang"
                                                                    method="POST" class="mb-5"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="nama_barang" class="form-label">Nama
                                                                            Barang</label>
                                                                        <input type="text"
                                                                            class="form-control @error('nama_barang') is-invalid @enderror"
                                                                            id="nama_barang" name="nama_barang" required
                                                                            autofocus>
                                                                        @error('nama_barang')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="merk_barang" class="form-label">Merk
                                                                            Barang</label>
                                                                        <input type="text"
                                                                            class="form-control @error('merk_barang') is-invalid @enderror"
                                                                            id="merk_barang" name="merk_barang" required
                                                                            autofocus>
                                                                        @error('merk_barang')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="qty" class="form-label">Qty</label>
                                                                        <input type="number" min="0" class="qty"
                                                                            name="qty" id="qty" size="2" style="width:40px"
                                                                            required autofocus>
                                                                        @error('qty')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="kondisi"
                                                                            class="form-label">Kondisi</label>
                                                                        <select class="form-control" name="kondisi"
                                                                            id="kondisi">
                                                                            <option value="layak_pakai">Layak Pakai</option>
                                                                            <option value="rusak_ringan">Rusak Ringan
                                                                            </option>
                                                                            <option value="rusak_berat">Rusak Berat</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="tanggal_pengadaaan"
                                                                            class="form-label">Tanggal Pengadaan</label>
                                                                        <input type="date" class="form-control"
                                                                            value="{{ date('Y-m-d') }}"
                                                                            id="tanggal_pengadaan" name="tanggal_pengadaan"
                                                                            required autofocus>
                                                                        @error('tanggal_pengadaan')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger"
                                                                            data-bs-dismiss="modal">Keluar</button>
                                                                        <button type="submit"
                                                                            class="btn btn-warning">Posting</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <br>
                                                <table class="display expandable-table table-striped table-bordered" style="width:100%" id="tb-barang">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Barang</th>
                                                            <th>Merk Barang</th>
                                                            <th>Qty</th>
                                                            <th>Kondisi</th>
                                                            <th>Tanggal Pengadaan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($barang as $b)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $b->nama_barang }}</td>
                                                                <td>{{ $b->merk_barang }}</td>
                                                                <td>{{ $b->qty }}</td>
                                                                <td>
                                                                    @switch($b->kondisi)
                                                                        @case('layak_pakai')
                                                                            Layar Pakai
                                                                        @break

                                                                        @case('rusak_ringan')
                                                                            Rusak Ringan
                                                                        @break

                                                                        @case('rusak_berat')
                                                                            Rusak Berat
                                                                        @break

                                                                        @default
                                                                    @endswitch
                                                                </td>
                                                                <td>{{ $b->tanggal_pengadaan }}</td>
                                                                <td>
                                                                    <!-- Button trigger modal -->
                                                                    <button type="button" class="btn btn-warning text-light"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#ModalPerbaharuiData{{ $b->id }}">
                                                                        <i class="ti-pencil-alt"></i>
                                                                    </button>

                                                                    <!-- Modal -->
                                                                    <div class="modal fade"
                                                                        id="ModalPerbaharuiData{{ $b->id }}"
                                                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                                                        tabindex="-1"
                                                                        aria-labelledby="ModalPerbaharuiDataLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header text-dark">
                                                                                    <h3 class="modal-title"
                                                                                        id="ModalPerbaharuiDataLabel">
                                                                                        Perbaharui Data</h3>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body text-dark">
                                                                                    <form
                                                                                        action="/{{ request()->segment(1) }}/barang/{{ $b->id }}"
                                                                                        method="POST" class="mb-5"
                                                                                        enctype="multipart/form-data">
                                                                                        @method('PUT')
                                                                                        @csrf
                                                                                        <div class="mb-3">
                                                                                            <label for="nama_barang"
                                                                                                class="form-label">Nama
                                                                                                Barang</label>
                                                                                            <input type="text"
                                                                                                class="form-control @error('nama_barang') is-invalid @enderror"
                                                                                                id="nama_barang"
                                                                                                name="nama_barang" required
                                                                                                autofocus
                                                                                                value="{{ old('nama_barang', $b->nama_barang) }}">
                                                                                            @error('nama_barang')
                                                                                                <div class="invalid-feedback">
                                                                                                    {{ $message }}
                                                                                                </div>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label for="merk_barang"
                                                                                                class="form-label">Merk
                                                                                                Barang</label>
                                                                                            <input type="text"
                                                                                                class="form-control @error('merk_barang') is-invalid @enderror"
                                                                                                id="merk_barang"
                                                                                                name="merk_barang" required
                                                                                                autofocus
                                                                                                value="{{ old('merk_barang', $b->merk_barang) }}">
                                                                                            @error('merk_barang')
                                                                                                <div class="invalid-feedback">
                                                                                                    {{ $message }}
                                                                                                </div>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label for="qty"
                                                                                                class="form-label">Qty</label>
                                                                                            <input type="number" min="0"
                                                                                                class="qty"
                                                                                                name="qty" id="qty" size="2"
                                                                                                style="width:40px" required
                                                                                                autofocus
                                                                                                value="{{ old('qty', $b->qty) }}">
                                                                                            @error('qty')
                                                                                                <div class="invalid-feedback">
                                                                                                    {{ $message }}
                                                                                                </div>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label for="kondisi"
                                                                                                class="form-label">Kondisi</label>
                                                                                            <select class="form-control"
                                                                                                name="kondisi" id="kondisi">
                                                                                                <option value="layak_pakai"
                                                                                                    @if ($b->kondisi == 'layak_pakai') selected @endif>
                                                                                                    Layak Pakai</option>
                                                                                                <option value="rusak_ringan"
                                                                                                    @if ($b->kondisi == 'rusak_ringan') selected @endif>
                                                                                                    Rusak Ringan</option>
                                                                                                <option value="rusak_berat"
                                                                                                    @if ($b->kondisi == 'rusak_berat') selected @endif>
                                                                                                    Rusak Berat</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label for="tanggal_pengadaaan"
                                                                                                class="form-label">Tanggal
                                                                                                Pengadaan</label>
                                                                                            <input type="date"
                                                                                                class="form-control"
                                                                                                id="tanggal_pengadaan"
                                                                                                name="tanggal_pengadaan"
                                                                                                required autofocus
                                                                                                value="{{ old('tanggal_pengadaan', $b->tanggal_pengadaan) }}">
                                                                                            @error('tanggal_pengadaan')
                                                                                                <div class="invalid-feedback">
                                                                                                    {{ $message }}
                                                                                                </div>
                                                                                            @enderror
                                                                                        </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-danger"
                                                                                        data-bs-dismiss="modal">Tutup</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-warning">Posting</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <form
                                                                        action="/{{ request()->segment(1) }}/barang/{{ $b->id }}"
                                                                        method="post" class="d-inline">
                                                                        @csrf
                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                        <button class="btn btn-danger text-light border-0"
                                                                            onclick="return confirm('Anda Yakin Ingin Menghapus?')"><i
                                                                                class="ti-close"></i></button>
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
                $(function() {
                    $('#tb-barang').DataTable();
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
