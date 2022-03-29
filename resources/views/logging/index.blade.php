@extends('layouts/main')

@section('content')

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Master Data Logging</h3>
                            <h6 class="font-weight-normal mb-0">Melihat Data Logging
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
                                    <p class="card-title">Tabel Logging</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">

                                                <table class="display expandable-table table-striped table-bordered"
                                                    style="width:100%" id="tb-penjemputan">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama User</th>
                                                            <th>IP</th>
                                                            <th>Event</th>
                                                            <th>Extra</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($logging as $l)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $l->user->name ?? '' }}</td>
                                                                <td>{{ $l->ip }}</td>
                                                                <td>{{ $l->event}}</td>
                                                                <td>{{ $l->extra }}</td>
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
                $('#tb-penjemputan').DataTable();
            });
        </script>
    @endpush
