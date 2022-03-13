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
                            <h3 class="font-weight-bold">Master Data Laporan</h3>
                            <h6 class="font-weight-normal mb-0">Melihat dan Export Data Laporan <span
                                    class="text-primary">Hati-hati dengan keputusan anda!</span></h6>
                        </div>
                    </div>
                    <br>
                    <br>

                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title">Tabel Laporan</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">

                                                <a href="{{ route('export-laporan') }}" class="btn btn-success me-3 mb-3">
                                                    Export Excel
                                                </a>

                                                <a href="{{ route('laporanPDF') }}" target="_blank"
                                                    class="btn btn-secondary mb-3">
                                                    Export PDF
                                                </a>

                                                <form action="laporan" method="GET">
                                                    <div class="input-group mb-3">
                                                        <input type="date" class="form-control" name="start_date">
                                                        <input type="date" class="form-control" name="end_date">
                                                        <button class="btn btn-primary" type="submit">GET</button>
                                                    </div>
                                                </form>

                                                <table class="expandable-table w-100 table-sm" id="tb-transaksi">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Outlet</th>
                                                            <th>Kode Invoice</th>
                                                            <th>Nama Pelanggan</th>
                                                            <th>Tanggal Masuk</th>
                                                            <th>Tanggal Bayar</th>
                                                            <th>Kasir</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $t)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $t->outlet->nama ?? '' }}</td>
                                                                <td>{{ $t->kode_invoice }}</td>
                                                                <td>{{ $t->member->nama ?? '' }}</td>
                                                                <td>{{ $t->tgl }}</td>
                                                                <td>{{ $t->tgl_bayar }}</td>
                                                                <td>{{ $t->user->name ?? '' }}</td>
                                                                <td>{{ $t->total }}</td>
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
                    $('#tb-laporan').DataTable();
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
