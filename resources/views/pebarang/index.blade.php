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
                            <h3 class="font-weight-bold">Master Data Penggunaan Barang</h3>
                            <h6 class="font-weight-normal mb-0">Membuat, Melihat, Perbaharui dan Hapus Data Penggunaan
                                Barang
                                <span class="text-primary">Hati-hati dengan keputusan anda!</span>
                            </h6>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title">Tabel Peenggunaan Barang</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">

                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#ModalBuatPeBarang">
                                                    Buat Data Penggunaan Barang Baru
                                                </button>

                                                <a href="{{ route('export-pebarang') }}" class="btn btn-success">
                                                    Export Excel
                                                </a>

                                                <button type="button" class="btn btn-warning text-light"
                                                    data-bs-toggle="modal" data-bs-target="#ModalImportPeBarang">
                                                    Import Excel
                                                </button>

                                                <a href="{{ route('exportpdf-pebarang') }}" target="_blank"
                                                    class="btn btn-secondary">
                                                    Export PDF
                                                </a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalImportPeBarang"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="ModalImportPeBarangLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-dark">
                                                                <h3 class="modal-title" id="ModalImportPeBarangLabel">
                                                                    Import
                                                                    Data</h3>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-dark">
                                                                <form action="{{ route('import-pebarang') }}" method="POST"
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
                                                <div class="modal fade" id="ModalBuatPeBarang" tabindex="-1"
                                                    aria-labelledby="ModalBuatPeBarangLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-dark">
                                                                <h3 class="modal-title" id="ModalBuatPeBarangLabel">
                                                                    Masukan
                                                                    Data Baru</h3>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-dark">
                                                                <form action="/{{ request()->segment(1) }}/pebarang"
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
                                                                        <label for="waktu_pakai" class="form-label">Waktu
                                                                            Pakai</label>
                                                                        <input type="datetime-local" class="form-control"
                                                                            value="{{ date('Y-m-d') }}" id="waktu_pakai"
                                                                            name="waktu_pakai" required autofocus>
                                                                        @error('waktu_pakai')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="nama_pemakai"
                                                                            class="form-label">Nama Pemakai
                                                                        </label>
                                                                        <input type="text"
                                                                            class="form-control @error('nama_pemakai') is-invalid @enderror"
                                                                            id="nama_pemakai" name="nama_pemakai" required
                                                                            autofocus>
                                                                        @error('nama_pemakai')
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
                                                <table class="display expandable-table table-striped table-bordered"
                                                    style="width:100%" id="tb-pebarang">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Barang</th>
                                                            <th>Waktu Pakai</th>
                                                            <th>Waktu Beres</th>
                                                            <th>Nama Pemakai</th>
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($pebarang as $p)
                                                            <tr>
                                                                <td>{{ $loop->iteration }} <input type="text" hidden
                                                                        class="id" value="{{ $p->id }}">
                                                                </td>
                                                                <td>{{ $p->nama_barang }}</td>
                                                                <td>{{ date('Y-m-d h:i:s', strtotime($p->waktu_pakai)) }}</td>
                                                                <td>{{ $p->waktu_beres }}</td>
                                                                <td>{{ $p->nama_pemakai }}</td>
                                                                <td>
                                                                    <select name="pestatus" class="pestatus form-control mb-3"
                                                                        id="one">
                                                                        <option value="belum_selesai"
                                                                            {{ $p->pestatus == 'belum_selesai' ? 'selected' : '' }}>
                                                                            Belum Selesai</option>
                                                                        <option value="selesai"
                                                                            {{ $p->pestatus == 'selesai' ? 'selected' : '' }}>
                                                                            Selesai</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!-- Button trigger modal -->
                                                                    <button type="button"
                                                                        class="btn btn-warning text-light mb-1"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#ModalPerbaharuiData{{ $p->id }}">
                                                                        <i class="ti-pencil-alt"></i>
                                                                    </button>
                                                                    <!-- Modal -->
                                                                    <div class="modal fade"
                                                                        id="ModalPerbaharuiData{{ $p->id }}"
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
                                                                                        action="/{{ request()->segment(1) }}/pebarang/{{ $p->id }}"
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
                                                                                                value="{{ old('nama_barang', $p->nama_barang) }}">
                                                                                            @error('nama_barang')
                                                                                                <div class="invalid-feedback">
                                                                                                    {{ $message }}
                                                                                                </div>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label for="waktu_pakai"
                                                                                                class="form-label">Waktu Pakai</label>
                                                                                            <input type="datetime-local"
                                                                                                class="form-control"
                                                                                                id="waktu_pakai"
                                                                                                name="waktu_pakai"
                                                                                                required autofocus
                                                                                                value="{{ old('waktu_pakai', $p->waktu_pakai) }}">
                                                                                            @error('waktu_pakai')
                                                                                                <div class="invalid-feedback">
                                                                                                    {{ $message }}
                                                                                                </div>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label for="nama_pemakai"
                                                                                                class="form-label">Nama
                                                                                                Barang</label>
                                                                                            <input type="text"
                                                                                                class="form-control @error('nama_pemakai') is-invalid @enderror"
                                                                                                id="nama_pemakai"
                                                                                                name="nama_pemakai" required
                                                                                                autofocus
                                                                                                value="{{ old('nama_pemakai', $p->nama_pemakai) }}">
                                                                                            @error('nama_pemakai')
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
                                                                        action="/{{ request()->segment(1) }}/pebarang/{{ $p->id }}"
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

    @endsection

    @push('script')
        <script>
            $(function() {
                $('#tb-pebarang').DataTable();
            });

            // menghapus alert
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                $("#success-alert").slideUp(500);
            });

            $("#error-alert").fadeTo(2000, 500).slideUp(500, function() {
                $("#success-alert").slideUp(500);
            });

            $('#tb-pebarang').on('change', '.pestatus', function() {
                let pestatus = $(this).closest('tr').find('.pestatus').val()
                let id = $(this).closest('tr').find('.id').val()
                let data = {
                    id: id,
                    pestatus: pestatus,
                    _token: "{{ csrf_token() }}"
                };
                let row = $(this).closest('tr')
                $.post('{{ route('pestatus') }}', data, function(res) {
                    swal("Sukses", "Data Berhasil Diubah", "success", {
                        buttons: false,
                        timer: 1000,
                    })
                    row.find('td:eq(3)').html(res.waktu_beres)
                })
                console.log(id);
                console.log(pestatus);
            })
        </script>
    @endpush
