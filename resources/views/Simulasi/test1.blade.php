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
                            <h3 class="font-weight-bold">Simulasi</h3>
                            <h6 class="font-weight-normal mb-0">Simulasi Data Karyawan <span
                                    class="text-primary">Hati-hati dengan keputusan anda!</span></h6>
                        </div>
                    </div>
                    <br>
                    <br>

                    <!-- conten header(page header)-->
                    <section class="conten-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                            </div>
                        </div>
                        <!---/.container-fluid-->
                    </section>

                    <section class="content">
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Form</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <form id="formKaryawan">
                                                    <div class="form-grup row">
                                                        <label for="id" class="col-sm-2 col-form-label">
                                                            <h6>ID</h6>
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="id" id="id"
                                                                placeholder="" required>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="form-grup row">
                                                        <label for="nama" class="col-sm-2 col-form-label">
                                                            <h6>Nama</h6>
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="nama" id="nama"
                                                                placeholder="" required>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="form-grup row">
                                                        <label for="jk" class="col-sm-2 col-form-label">
                                                            <h6>Jenis Kelamin</h6>
                                                        </label>
                                                        <div class="form-check col-sm-2">
                                                            <input class="form-check-input" type="radio" value="L" name="jk"
                                                                id="jk">
                                                            <label class="form-check-label">laki-laki</label>
                                                        </div>
                                                        <div class="form-check col-sm-2">
                                                            <input class="form-check-input" type="radio" value="P" name="jk"
                                                                id="jk">
                                                            <label class="form-check-label">Perempuan</label>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="form-grup row">
                                                        <label for="nama" class="col-sm-2 col-form-label"></label>
                                                        <div class="col-sm-10">
                                                            <button class="btn btn-primary" id="btnSimpan"
                                                                type="submit">Simpan</button>
                                                            <button class="btn btn-dark" id="btnReset"
                                                                type="reset">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end form --}}


                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Data</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        <button class="btn btn-success" type="button"
                                                            id="sorting">Sorting</button>
                                                    </div>
                                                    <div>
                                                        <br><input type="search" class="form-control col-sm-2" name="teksCari"
                                                            id="teksCari">
                                                        <br><button class="btn btn-primary" type="button"
                                                            id="btnSearch">Cari</button>
                                                    </div>
                                                </div>
                                                <br>
                                                <table class="display expandable-table table-stripped" style="width:100%"
                                                    id="tblKaryawan">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Nama</th>
                                                            <th>Jenis Kelamin</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="3" align="center"> belum ada data</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>

                </div>
                <!-- content-wrapper ends -->

            @endsection

            @push('script')
                <script>
                    function insert() {
                        const data = $('#formKaryawan').serializeArray()
                        let newData = {}
                        data.forEach(function(item, index) {
                            let name = item['name']
                            let value = (name == 'id' ? Number(item['value']) : item['value'])
                            newData[name] = value
                        })
                        return newData
                    }
                    $(function() {
                        //property
                        let dataKaryawan = []

                        //events
                        $('#formKaryawan').on('submit', function(e) {
                            e.preventDefault()
                            dataKaryawan.push(insert())

                            $('#sorting').on('click', function() {
                                dataKaryawan = insertionSort(dataKaryawan, 'id')

                                $('#tblKaryawan tbody').html(showData(dataKaryawan))
                            })

                            $('#tblKaryawan tbody').html(showData(dataKaryawan))
                            console.log(dataKaryawan)

                        })

                        $('#btnSearch').on('click', function(e) {
                            let teksSearch = $('#teksCari').val()
                            console.log(teksSearch)
                            let id = searching(dataKaryawan, 'id', teksSearch)
                            let data = []
                            if (id >= 0)
                                data.push(dataKaryawan[id])
                            console.log(id)
                            console.log(data)
                            $('#tblKaryawan tbody').html(showData(data))
                        })
                        //end of events
                    })

                    function showData(arr) {
                        let row = ''
                        if (arr.length == null) {
                            return row = `<tr><td colspan="3">Belum ada data</td></tr>`
                        }
                        arr.forEach(function(item, index) {
                            row += `<tr>`
                            row += `<td>${item['id']}</td>`
                            row += `<td>${item['nama']}</td>`
                            row += `<td>${item['jk']}</td>`
                            row += `</tr>`
                        })
                        return row
                    }

                    function insertionSort(arr, key) {
                        let i, j, id, value;
                        for (i = 1; i < arr.length; i++) {
                            value = arr[i];
                            id = arr[i][key]
                            j = i - 1;
                            while (j >= 0 && arr[j][key] > id) {
                                arr[j + 1] = arr[j];
                                j = j - 1;
                            }
                            arr[j + 1] = value;
                        }
                        return arr
                    }

                    function searching(arr, key, teks) {
                      // console.log(arr)
                        for (let i = 0; i < arr.length; i++) {
                          // console.log(arr[i][key]+"="+teks)
                            if (arr[i][key] == teks)
                                return i
                        }
                        return 'gagal'

                    }
                </script>
            @endpush
