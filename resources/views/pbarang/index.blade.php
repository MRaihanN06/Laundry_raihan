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
                                                    data-bs-target="#ModalBuatPBarang">
                                                    Buat Data Penggunaan Barang Baru
                                                </button>

                                                <a href="{{ route('export-pbarang') }}" class="btn btn-success">
                                                    Export Excel
                                                </a>

                                                <button type="button" class="btn btn-warning text-light"
                                                    data-bs-toggle="modal" data-bs-target="#ModalImportPBarang">
                                                    Import Excel
                                                </button>

                                                <a href="{{ route('exportpdf-pbarang') }}" target="_blank"
                                                    class="btn btn-secondary">
                                                    Export PDF
                                                </a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalImportPBarang"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="ModalImportPBarangLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-dark">
                                                                <h3 class="modal-title" id="ModalImportPBarangLabel">
                                                                    Import
                                                                    Data</h3>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-dark">
                                                                <form action="{{ route('import-pbarang') }}" method="POST"
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
                                                <div class="modal fade" id="ModalBuatPBarang" tabindex="-1"
                                                    aria-labelledby="ModalBuatPBarangLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-dark">
                                                                <h3 class="modal-title" id="ModalBuatPBarangLabel">
                                                                    Masukan
                                                                    Data Baru</h3>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-dark">
                                                                <form action="/{{ request()->segment(1) }}/pbarang"
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
                                                                        <label for="harga"
                                                                            class="form-label">Harga</label>
                                                                        <input type="text"
                                                                            class="form-control @error('harga') is-invalid @enderror"
                                                                            id="harga" name="harga" required autofocus>
                                                                        @error('harga')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="waktu_beli" class="form-label">Waktu
                                                                            Beli</label>
                                                                        <input type="datetime-local" class="form-control"
                                                                            value="{{ date('Y-m-d') }}" id="waktu_beli"
                                                                            name="waktu_beli" required autofocus>
                                                                        @error('waktu_beli')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="supplier"
                                                                            class="form-label">Supplier
                                                                        </label>
                                                                        <input type="text"
                                                                            class="form-control @error('supplier') is-invalid @enderror"
                                                                            id="supplier" name="supplier" required
                                                                            autofocus>
                                                                        @error('supplier')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="bstatus"
                                                                            class="form-label">Status</label>
                                                                        <select class="form-control" name="bstatus"
                                                                            id="bstatus">
                                                                            <option value="diajukan_beli">Diajukan Beli
                                                                            </option>
                                                                            <option value="habis">Habis</option>
                                                                            <option value="tersedia">Tersedia</option>
                                                                        </select>
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
                                                    style="width:100%" id="tb-pbarang">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Barang</th>
                                                            <th>QTY</th>
                                                            <th>Harga</th>
                                                            <th>Waktu Beli</th>
                                                            <th>Supplier</th>
                                                            <th>Status</th>
                                                            <th>Status Update</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($pbarang as $p)
                                                            <tr>
                                                                <td>{{ $loop->iteration }} <input type="text" hidden
                                                                        class="id" value="{{ $p->id }}">
                                                                </td>
                                                                <td>{{ $p->nama_barang }}</td>
                                                                <td>{{ $p->qty }}</td>
                                                                <td>{{ $p->harga }}</td>
                                                                <td>{{ date('Y-m-d h:i:s', strtotime($p->waktu_beli)) }}</td>
                                                                <td>{{ $p->supplier }}</td>
                                                                <td>
                                                                    <select name="bstatus" class="bstatus form-control mb-3"
                                                                        id="one">
                                                                        <option value="diajukan_beli"
                                                                            {{ $p->bstatus == 'diajukan' ? 'selected' : '' }}>
                                                                            Diajukan Beli</option>
                                                                        <option value="habis"
                                                                            {{ $p->bstatus == 'habis' ? 'selected' : '' }}>
                                                                            Habis</option>
                                                                        <option value="tersedia"
                                                                            {{ $p->bstatus == 'tersedia' ? 'selected' : '' }}>
                                                                            Tersedia</option>
                                                                    </select>
                                                                </td>
                                                                <td>{{ $p->tgl_status }}</td>
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
                                                                                        action="/{{ request()->segment(1) }}/pbarang/{{ $p->id }}"
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
                                                                                            <label for="qty"
                                                                                                class="form-label">Qty</label>
                                                                                            <input type="number" min="0"
                                                                                                class="qty"
                                                                                                name="qty" id="qty" size="2"
                                                                                                style="width:40px" required
                                                                                                autofocus
                                                                                                value="{{ old('qty', $p->qty) }}">
                                                                                            @error('qty')
                                                                                                <div class="invalid-feedback">
                                                                                                    {{ $message }}
                                                                                                </div>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label for="harga"
                                                                                                class="form-label">Harga</label>
                                                                                            <input type="text"
                                                                                                class="form-control @error('harga') is-invalid @enderror"
                                                                                                id="harga" name="harga"
                                                                                                required autofocus
                                                                                                value="{{ old('nama', $p->harga) }}">
                                                                                            @error('harga')
                                                                                                <div class="invalid-feedback">
                                                                                                    {{ $message }}
                                                                                                </div>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label for="waktu_beli"
                                                                                                class="form-label">Waktu Beli</label>
                                                                                            <input type="datetime-local"
                                                                                                class="form-control"
                                                                                                id="waktu_beli"
                                                                                                name="waktu_beli"
                                                                                                required autofocus
                                                                                                value="{{ old('waktu_beli', $p->waktu_beli) }}">
                                                                                            @error('waktu_beli')
                                                                                                <div class="invalid-feedback">
                                                                                                    {{ $message }}
                                                                                                </div>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label for="supplier"
                                                                                                class="form-label">Nama
                                                                                                Barang</label>
                                                                                            <input type="text"
                                                                                                class="form-control @error('supplier') is-invalid @enderror"
                                                                                                id="supplier"
                                                                                                name="supplier" required
                                                                                                autofocus
                                                                                                value="{{ old('supplier', $p->supplier) }}">
                                                                                            @error('supplier')
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
                                                                        action="/{{ request()->segment(1) }}/pbarang/{{ $p->id }}"
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
                $('#tb-pbarang').DataTable();
            });

            // menghapus alert
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                $("#success-alert").slideUp(500);
            });

            $("#error-alert").fadeTo(2000, 500).slideUp(500, function() {
                $("#success-alert").slideUp(500);
            });

            $('#tb-pbarang').on('change', '.bstatus', function() {
                let bstatus = $(this).closest('tr').find('.bstatus').val()
                let id = $(this).closest('tr').find('.id').val()
                let data = {
                    id: id,
                    bstatus: bstatus,
                    _token: "{{ csrf_token() }}"
                };
                let row = $(this).closest('tr')
                $.post('{{ route('bstatus') }}', data, function(res) {
                    swal("Sukses", "Data Berhasil Diubah", "success", {
                        buttons: false,
                        timer: 1000,
                    })
                    row.find('td:eq(7)').html(res.tgl_status)
                })
                console.log(id);
                console.log(bstatus);
            })
        </script>
    @endpush
