@extends('layouts/main')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Simulasi</h3>
                            <h6 class="font-weight-normal mb-0">Simulasi Transaksi Cucian <span
                                    class="text-primary">Hati-hati
                                    dengan
                                    keputusan anda!</span></h6>
                        </div>
                    </div>
                    <br>
                    <br>

                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title">Form</p>
                                    <div class="row">

                                        <form id="formTransaksi">
                                            <div class="row col-sm-12">
                                                <div class="form-group row mb-3 col-sm-6">
                                                    <label for="id" class="col-sm-3 col-form-label">
                                                        <h6>No Transaksi</h6>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="id" id="id"
                                                            placeholder="ID" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3 col-sm-6">
                                                    <label for="nama" class="col-sm-3 col-form-label">
                                                        <h6>Nama Pelanggan</h6>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="nama" id="nama"
                                                            placeholder="Nama" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row col-sm-12">
                                                <div class="form-group row mb-3 col-sm-6">
                                                    <label for="tlp" class="col-sm-3 col-form-label">
                                                        <h6>No. HP/WA</h6>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="tlp" name="tlp"
                                                            required placeholder="No. HP/WA">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3 col-sm-6">
                                                    <label for="tgl" class="col-sm-3 col-form-label">
                                                        <h6>Tanggal Cuci</h6>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control"
                                                            value="{{ date('Y-m-d') }}" name="tgl" id="tgl">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row col-sm-12">
                                                <div class="form-group row mb-3 col-sm-6">
                                                <label for="jenis" class="col-sm-3 col-form-label">
                                                    <h6>Jenis Cucian</h6>
                                                </label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="jenis" id="jenis">
                                                        <option value="standar">Standar</option>
                                                        <option value="express">Express</option>
                                                    </select>
                                                </div>
                                                </div>
                                                <div class="form-group row mb-3 col-sm-6">
                                                    <label for="jumlah" class="col-sm-3 col-form-label">
                                                        <h6>Berat</h6>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="real" class="form-control" name="berat"
                                                            id="berat" min="0" placeholder="Berat" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-10">
                                                <button class="btn btn-primary" id="btnSimpan" type="submit">Simpan</button>
                                                <button class="btn btn-dark" id="btnReset" type="reset">Reset</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title">Data</p>
                                    <div class="row">

                                        <div class="form-group row col-sm-12">

                                            <div class="form-group row mb-3 col-sm-7">
                                                <label for="sorting" class="col-sm-3 col-form-label">
                                                    <h6>Sorting</h6>
                                                </label>
                                                <div class="col-sm-5">
                                                    <select class="form-control" name="sort" id="sort">
                                                        <option value="">Metode</option>
                                                        <option value="asc">Ascending (Terkecil)</option>
                                                        <option value="des">Descending (Terbesar)</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <select name="sorting" id="sorting" class="form-control col-sm-8">
                                                        <option value="id">Id</option>
                                                        <option value="nama">Nama Pelanggan</option>
                                                        <option value="tlp">Kontak</option>
                                                        <option value="tgl">Tanggal Cucian</option>
                                                        <option value="jenis">Jenis Cucian</option>
                                                        <option value="berat">Berat</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row col-sm-5">
                                                <div class="col-sm-6">
                                                    <input type="search" class="form-control" name="teksCari"
                                                        id="teksCari" placeholder="Search">
                                                </div>
                                                <button class="btn btn-primary col-sm-2" type="button"
                                                    id="btnSearch">Cari</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <button class="btn btn-warning col-sm-3" id="btnhapus"
                                                    type="delete">Hapus</button>
                                            </div>
                                        </div>
                                        <br>
                                        <table class="display expandable-table table-striped table-bordered"
                                            style="width:100%" id="tblTransaksi">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Kontak</th>
                                                    <th>Tanggal Cucian</th>
                                                    <th>Jenis Cucian</th>
                                                    <th>Berat</th>
                                                    <th>Diskon</th>
                                                    <th>Total Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="8" align="center">Belum ada data</td>
                                                </tr>
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
    @endsection

    @push('script')
        <script>
            function insert() {
                let dataTransaksi = JSON.parse(localStorage.getItem('dataTransaksi')) || []

                const data = $('#formTransaksi').serializeArray()
                console.log(data)
                let newData = {}
                data.forEach(function(item, index) {
                    let name = item['name']
                    let value = (name === 'id' ||
                        name === 'berat' ?
                        Number(item['value']) : item['value'])
                    newData[name] = value
                })
                localStorage.setItem('dataTransaksi', JSON.stringify([...dataTransaksi, newData]))
                return newData
            }

            $(function() {
                //intialize
                let dataTransaksi = JSON.parse(localStorage.getItem('dataTransaksi')) || []
                $('#tblTransaksi tbody').html(showData(dataTransaksi))
                //events
                $('#formTransaksi').on('submit', function(e) {
                    e.preventDefault();
                    insert()
                    dataTransaksi = JSON.parse(localStorage.getItem('dataTransaksi'))
                    $('#tblTransaksi tbody').html(showData(dataTransaksi))

                    console.log(dataTransaksi)
                })

                $('#sort').on('change', function() {
                    let value = $('#sort').val()
                    // console.log(value)
                    if (value == 'asc') {
                        $('#sorting').on('change', function() {
                            let nama = document.getElementById("sorting").value;
                            dataTransaksi = insertionSortAsc(dataTransaksi, nama)
                            // console.log(dataTB)
                            $('#tblTransaksi tbody').html(showData(dataTransaksi))
                        })
                    } else {
                        $('#sorting').on('change', function() {
                            let nama = document.getElementById("sorting").value;
                            dataTransaksi = insertionSortDes(dataTransaksi, nama)
                            // console.log(dataTB)
                            $('#tblTransaksi tbody').html(showData(dataTransaksi))
                        })
                    }
                })

                $('#btnSearch').on('click', function(e) {
                    let teksSearch = $('#teksCari').val()
                    console.log(teksSearch)
                    let id = SequentialSearching(dataTransaksi, 'id', teksSearch)
                    let data = []
                    // if (id >= 0)
                    for (x = 0; x < id.length; x++) {
                        data.push(dataTransaksi[id[x]])
                    }
                    $('#tblTransaksi tbody').html(showData(data))
                })
                
                $('#btnhapus').on('click', hapusData);
                //end of events

            })

            function showData(dataTransaksi) {
                let row = ''

                const standar = 7500
                const express = 15000
                const dis = 10 / 100
                var TAkhir = 0
                var TDiskon = 0
                var TBerat = 0
                var diskon = 0
                var jumlah = 0

                if (dataTransaksi.length == 0) {
                    return row = `<tr><td colspan="8" align="center">Belum ada data</td></tr>`
                }
                dataTransaksi.forEach(function(item, index) {

                    let jenis = item['jenis']
                    let berat = item['berat']

                    if ( jenis == 'standar') {
                        jumlah = berat * standar
                    } else {
                        jumlah = berat * express
                    }
                    
                    if (jumlah >= 50000) {
                        diskon = jumlah * dis
                        jumlah = jumlah - diskon
                    } else {
                        diskon = 0
                    }

                    TBerat += Number(item['berat'])
                    TDiskon += diskon
                    TAkhir += jumlah

                    row += `<tr>`
                    row += `<td>${item['id']}</td>`
                    row += `<td>${item['nama']}</td>`
                    row += `<td>${item['tlp']}</td>`
                    row += `<td>${item['tgl']}</td>`
                    row += `<td>${item['jenis']}</td>`
                    row += `<td>${item['berat']}</td>`
                    row += `<td>${diskon}</td>`
                    row += `<td>${jumlah}</td>`
                    row += `</tr>`
                })

                row += `<tr>`
                row +=
                    `<td colspan="5" align="center" style="background:black;color:white;font-weight:bold;font-size:1em">Total</td>`
                row += `<td>${TBerat}</td>`
                row += `<td>${TDiskon}</td>`
                row += `<td>${TAkhir}</td>`
                row += `</tr>`

                return row
            }

            function insertionSortAsc(arr, key) {
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

            function insertionSortDes(arr, key) {
                let i, j, id, value;
                for (i = 1; i < arr.length; i++) {
                    value = arr[i];
                    id = arr[i][key]
                    j = i - 1;
                    while (j >= 0 && arr[j][key] < id) {
                        arr[j + 1] = arr[j];
                        j = j - 1;
                    }
                    arr[j + 1] = value;
                }
                return arr
            }

            function SequentialSearching(arr, key, teks) {
                let buffer = []
                for (let i = 0; i < arr.length; i++) {
                    if (arr[i][key] == teks)
                        buffer.push(i)
                }
                return buffer
            }
            
            const hapusData = () => {
                if (confirm('Hapus Semua Data?')) {
                    dataTransaksi = [];
                    localStorage.removeItem('dataTransaksi');
                    $('#tblTransaksi tbody').html(showData(dataTransaksi));
                }
            }

        </script>
    @endpush
