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
                            <h6 class="font-weight-normal mb-0">Simulasi Transaksi Barang <span
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

                                        <form id="formTB">
                                            <div class="row col-sm-12">
                                                <div class="form-group row mb-3 col-sm-6">
                                                    <label for="id" class="col-sm-3 col-form-label">
                                                        <h6>ID</h6>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="id" id="id"
                                                            placeholder="ID" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3 col-sm-6">
                                                    <label for="tgl" class="col-sm-3 col-form-label">
                                                        <h6>Tanggal Beli</h6>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control"
                                                            value="{{ date('Y-m-d') }}" name="tgl" id="tgl">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row col-sm-12">
                                                <div class="form-group row mb-3 col-sm-6">
                                                    <label for="barang" class="col-sm-3 col-form-label">
                                                        <h6>Nama Barang</h6>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="barang" id="barang">
                                                            <option value="detergent">Detergent</option>
                                                            <option value="pewangi">Pewangi</option>
                                                            <option value="detergent_sepatu">Detergent Sepatu</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3 col-sm-6">
                                                    <label for="harga" class="col-sm-3 col-form-label">
                                                        <h6>Harga Barang</h6>
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" name="harga" id="harga"
                                                            required readonly placeholder="Harga Barang">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row col-sm-12">
                                                <div class="form-group row mb-3 col-sm-6">
                                                    <label for="jumlah" class="col-sm-3 col-form-label">
                                                        <h6>Jumlah</h6>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" name="jumlah"
                                                            id="jumlah" min="0" placeholder="Jumlah" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3 col-sm-6">
                                                    <label for="jenis_pembayaran" class="col-sm-4 col-form-label">
                                                        <h6>Jenis Pembayaran</h6>
                                                    </label>
                                                    <div class="form-check col-sm-3">
                                                        <input type="radio" class="form-check-input" name="jenis_pembayaran"
                                                            id="jenis_pembayaran" value="Cash" required>
                                                        <label class="form-check-label">Cash</label>
                                                    </div>
                                                    <div class="form-check col-sm-5">
                                                        <input type="radio" class="form-check-input" name="jenis_pembayaran"
                                                            id="jenis_pembayaran" value="E-money" required>
                                                        <label class="form-check-label">E-money/Transfer</label>
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

                                            <div class="form-group row mb-3 col-sm-6">
                                                <label for="sorting" class="col-sm-3 col-form-label">
                                                    <h6>Sorting</h6>
                                                </label>
                                                <div class="col-sm-9">
                                                    <select name="sorting" id="sorting" class="form-control col-sm-8">
                                                        <option value="id">Id</option>
                                                        <option value="tgl">Tanggal Beli</option>
                                                        <option value="barang">Nama Barang</option>
                                                        <option value="harga">Harga</option>
                                                        <option value="jumlah">QTY</option>
                                                        <option value="jenis_pembayaran">Total Harga</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row col-sm-6">
                                                <div class="col-sm-4">
                                                    <input type="search" class="form-control" name="teksCari"
                                                        id="teksCari" placeholder="Search">
                                                </div>
                                                <button class="btn btn-primary col-sm-2" type="button"
                                                    id="btnSearch">Cari</button> &nbsp;
                                                <button class="btn btn-warning col-sm-2" id="btnhapus"
                                                    type="delete">Hapus</button>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group row col-sm-12">
                                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                            <div class="form-check col-sm-3">
                                                <input type="checkbox" class="form-check-input" name="jp"
                                                    id="jenis_pembayaran" value="Cash" required>
                                                <label class="form-check-label">Cash</label>
                                            </div>
                                            <div class="form-check col-sm-3">
                                                <input type="checkbox" class="form-check-input" name="jp" id="jp"
                                                    value="E-money" required>
                                                <label class="form-check-label">E-money/Transfer</label>
                                            </div>
                                        </div> --}}
                                        <br>
                                        <table class="display expandable-table table-striped table-bordered"
                                            style="width:100%" id="tblTB">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Tanggal Beli</th>
                                                    <th>Nama Barang</th>
                                                    <th>Harga</th>
                                                    <th>Qty</th>
                                                    <th>Diskon</th>
                                                    <th>Total Harga</th>
                                                    <th>Jenis Bayar</th>
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
                let dataTB = JSON.parse(localStorage.getItem('dataTB')) || []

                const data = $('#formTB').serializeArray()
                console.log(data)
                let newData = {}
                data.forEach(function(item, index) {
                    let name = item['name']
                    let value = (name === 'id' ||
                        name === 'harga' ?
                        Number(item['value']) : item['value'])
                    newData[name] = value
                })
                localStorage.setItem('dataTB', JSON.stringify([...dataTB, newData]))
                return newData
            }

            $(function() {
                //intialize
                let dataTB = JSON.parse(localStorage.getItem('dataTB')) || []
                $('#tblTB tbody').html(showData(dataTB))
                //events
                $('#formTB').on('submit', function(e) {
                    e.preventDefault();
                    insert()
                    dataTB = JSON.parse(localStorage.getItem('dataTB'))
                    $('#tblTB tbody').html(showData(dataTB))

                    console.log(dataTB)
                })

                $('#sorting').on('change', function() {
                    let nama = document.getElementById("sorting").value;
                    dataTB = insertionSort(dataTB, nama)
                    // console.log(dataTB)
                    $('#tblTB tbody').html(showData(dataTB))
                })

                const HDe = 15000;
                const HPe = 10000;
                const HDs = 25000;

                $('#barang').on('change', function() {
                    let value = $('#barang').val()
                    // console.log(value)
                    if (value == 'detergent') {
                        $('#harga').val(HDe)
                        $('#harga').attr('readonly', true)
                    } else if (value == 'pewangi') {
                        $('#harga').val(HPe)
                        $('#harga').attr('readonly', true)
                    } else {
                        $('#harga').val(HDs)
                        $('#harga').attr('readonly', true)
                    }
                })

                $('#btnSearch').on('click', function(e) {
                    let teksSearch = $('#teksCari').val()
                    console.log(teksSearch)
                    let id = SequentialSearching(dataTB, 'id', teksSearch)
                    let data = []
                    // if (id >= 0)
                    for (x = 0; x < id.length; x++) {
                        data.push(dataTB[id[x]])
                    }
                    $('#tblTB tbody').html(showData(data))
                })

                $('#btnhapus').on('click', hapusData);
                //end of events
            })

            function showData(dataTB) {
                let row = ''

                const dis = 15 / 100
                var TAkhir = 0
                var TDiskon = 0
                var TQty = 0
                var THarga = 0
                var diskon = 0
                var jumlah = 0

                if (dataTB.length == 0) {
                    return row = `<tr><td colspan="8" align="center">Belum ada data</td></tr>`
                }

                dataTB.forEach(function(item, index) {

                    let jumlah = item['jumlah'] * item['harga']

                    if (jumlah >= 50000) {
                        diskon = jumlah * dis
                        jumlah = jumlah - diskon
                    } else {
                        diskon = 0
                    }

                    THarga += Number(item['harga'])
                    TQty += Number(item['jumlah'])
                    TDiskon += diskon
                    TAkhir += jumlah

                    row += `<tr>`
                    row += `<td>${item['id']}</td>`
                    row += `<td>${item['tgl']}</td>`
                    row += `<td>${item['barang']}</td>`
                    row += `<td>${item['harga']}</td>`
                    row += `<td>${item['jumlah']}</td>`
                    row += `<td>${diskon}</td>`
                    row += `<td>${jumlah}</td>`
                    row += `<td>${item['jenis_pembayaran']}</td>`
                    row += `</tr>`
                })

                row += `<tr>`
                row +=
                    `<td colspan="3" align="center" style="background:black;color:white;font-weight:bold;font-size:1em">Total</td>`
                row += `<td>${THarga}</td>`
                row += `<td>${TQty}</td>`
                row += `<td>${TDiskon}</td>`
                row += `<td colspan="3">${TAkhir}</td>`
                row += `</tr>`

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
                    dataTB = [];
                    localStorage.removeItem('dataTB');
                    $('#tblTB tbody').html(showData(dataTB));
                }
            }
        </script>
    @endpush
