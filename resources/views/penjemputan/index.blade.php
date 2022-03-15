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
                            <h3 class="font-weight-bold">Master Data Penjemputan</h3>
                            <h6 class="font-weight-normal mb-0">Membuat, Melihat, Perbaharui dan Hapus Data Penjemputan
                                <span class="text-primary">Hati-hati dengan keputusan anda!</span></h6>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title">Tabel Penjemputan</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">

                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#ModalBuatPenjemputan">
                                                    Buat Data Penjemputan Baru
                                                </button>

                                                <a href="{{ route('export-penjemputan') }}" class="btn btn-success">
                                                    Export Excel
                                                </a>

                                                <button type="button" class="btn btn-warning text-light"
                                                    data-bs-toggle="modal" data-bs-target="#ModalImportPenjemputan">
                                                    Import Excel
                                                </button>

                                                <a href="{{ route('exportpdf-penjemputan') }}" target="_blank"
                                                    class="btn btn-secondary">
                                                    Export PDF
                                                </a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalImportPenjemputan"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="ModalImportPenjemputanLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-dark">
                                                                <h3 class="modal-title" id="ModalImportPenjemputanLabel">
                                                                    Import
                                                                    Data</h3>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-dark">
                                                                <form action="{{ route('import-penjemputan') }}"
                                                                    method="POST" enctype="multipart/form-data">
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
                                                <div class="modal fade" id="ModalBuatPenjemputan" tabindex="-1"
                                                    aria-labelledby="ModalBuatPenjemputanLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-dark">
                                                                <h3 class="modal-title" id="ModalBuatPenjemputanLabel">
                                                                    Masukan
                                                                    Data Baru</h3>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-dark">
                                                                <form action="/{{ request()->segment(1) }}/penjemputan"
                                                                    method="POST" class="mb-5"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="nama" class="form-label">Nama
                                                                            pelanggan</label>
                                                                        <select name="id_member" id="member"
                                                                            class="form-control js-example-basic-single w-100">
                                                                            @foreach ($member as $m)
                                                                                <option value="{{ $m->id }}">
                                                                                    {{ $m->nama }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="nama" class="form-label">Nama
                                                                            Penjemput</label>
                                                                        <select name="id_user" id="user"
                                                                            class="form-control js-example-basic-single w-100">
                                                                            @foreach ($user as $u)
                                                                                <option value="{{ $u->id }}">
                                                                                    {{ $u->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="jenis"
                                                                            class="form-label">Status</label>
                                                                        <select class="form-control" name="status"
                                                                            id="status">
                                                                            <option value="tercatat">Tercatat</option>
                                                                            <option value="penjemputan">Penjemputan</option>
                                                                            <option value="selesai">Selesai</option>
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
                                                <table class="display expandable-table" style="width:100%"
                                                    id="tb-penjemputan">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Pelanggan</th>
                                                            <th>Alamat Pelanggan</th>
                                                            <th>No Telepon</th>
                                                            <th>Penjemput</th>
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($penjemputan as $p)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $p->member->nama ?? '' }}</td>
                                                                <td>{{ $p->member->alamat ?? '' }}</td>
                                                                <td>{{ $p->member->tlp ?? '' }}</td>
                                                                <td>{{ $p->user->name ?? '' }}</td>
                                                                    <span hidden
                                                                        class="id">{{ $p->id }}</span>
                                                                <td id="status">
                                                                    <select name="status" class="status" id="status">
                                                                        <option value="tercatat"
                                                                            {{ $p->status == 'tercatat' ? 'selected' : '' }}>
                                                                            Tercatat</option>
                                                                        <option value="penjemputan"
                                                                            {{ $p->status == 'penjemputan' ? 'selected' : '' }}>
                                                                            Penjemputan</option>
                                                                        <option value="selesai"
                                                                            {{ $p->status == 'selesai' ? 'selected' : '' }}>
                                                                            Selesai</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!-- Button trigger modal -->
                                                                    <button type="button" class="btn btn-warning text-light"
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
                                                                                        action="/{{ request()->segment(1) }}/penjemputan/{{ $p->id }}"
                                                                                        method="POST" class="mb-5"
                                                                                        enctype="multipart/form-data">
                                                                                        @method('PUT')
                                                                                        @csrf
                                                                                        <div class="mb-3">
                                                                                            <label for="nama"
                                                                                                class="form-label">Nama
                                                                                                Pelanggan</label>
                                                                                            <select name="id_member"
                                                                                                id="member"
                                                                                                class="form-control js-example-basic-single w-100">
                                                                                                @foreach ($member as $m)
                                                                                                    @if (old('id_member') && old('id_member') == $m->id)
                                                                                                        <option
                                                                                                            value="{{ $m->id }}"
                                                                                                            selected>
                                                                                                            {{ $m->nama }}
                                                                                                        </option>
                                                                                                    @else
                                                                                                    @endif
                                                                                                    <option
                                                                                                        value="{{ $m->id }}">
                                                                                                        {{ $m->nama }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label for="nama"
                                                                                                class="form-label">Nama
                                                                                                Penjemput</label>
                                                                                            <select name="id_user" id="user"
                                                                                                class="form-control js-example-basic-single w-100">
                                                                                                @foreach ($user as $u)
                                                                                                    @if (old('id_member') && old('id_member') == $u->id)
                                                                                                        <option
                                                                                                            value="{{ $u->id }}"
                                                                                                            selected>
                                                                                                            {{ $u->nama }}
                                                                                                        </option>
                                                                                                    @else
                                                                                                    @endif
                                                                                                    <option
                                                                                                        value="{{ $u->id }}">
                                                                                                        {{ $u->name }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label for="status"
                                                                                                class="form-label">Status</label>
                                                                                            <select class="form-control"
                                                                                                name="status" id="status">
                                                                                                <option value="tercatat"
                                                                                                    @if ($p->status == 'tercatat') selected @endif>
                                                                                                    Tercatat</option>
                                                                                                <option value="penjemputan"
                                                                                                    @if ($p->status == 'penjemputan') selected @endif>
                                                                                                    Penjemputan</option>
                                                                                                <option value="selesai"
                                                                                                    @if ($p->status == 'selesai') selected @endif>
                                                                                                    Selesai</option>
                                                                                            </select>
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
                                                                        action="/{{ request()->segment(1) }}/penjemputan/{{ $p->id }}"
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
                    $('#tb-penjemputan').DataTable();
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
