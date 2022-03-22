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
                            <h6 class="font-weight-normal mb-0">Simulasi Gaji Karyawan <span class="text-primary">Hati-hati
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

                                        <form id="formGaji">
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
                                                    <label for="nama" class="col-sm-3 col-form-label">
                                                        <h6>Nama</h6>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="nama" id="nama"
                                                            placeholder="Nama" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row col-sm-12">
                                                <div class="form-group row mb-3 col-sm-6">
                                                    <label for="jenis_kelamin" class="col-sm-3 col-form-label">
                                                        <h6>Jenis Kelamin</h6>
                                                    </label>
                                                    <div class="form-check col-sm-4">
                                                        <input type="radio" class="form-check-input" name="jenis_kelamin"
                                                            id="jenis_kelamin" value="L" required>
                                                        <label class="form-check-label">Laki-laki</label>
                                                    </div>
                                                    <div class="form-check col-sm-4">
                                                        <input type="radio" class="form-check-input" name="jenis_kelamin"
                                                            id="jenis_kelamin" value="P" required>
                                                        <label class="form-check-label">Perempuan</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3 col-sm-6">
                                                    <label for="status" class="col-sm-3 col-form-label">
                                                        <h6>Status Menikah</h6>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="status" id="status">
                                                            <option value="single">Single</option>
                                                            <option value="couple">Couple</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row col-sm-12">
                                                <div class="form-group row mb-3 col-sm-6">
                                                    <label for="jumlah_anak" class="col-sm-3 col-form-label">
                                                        <h6>Jumlah Anak</h6>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" name="jumlah_anak"
                                                            id="jumlah_anak" min="0" placeholder="Jumlah Anak" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3 col-sm-6">
                                                    <label for="mulai" class="col-sm-3 col-form-label">
                                                        <h6>Mulai Bekerja</h6>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control"
                                                            value="{{ date('Y-m-d') }}" name="mulai" id="mulai">
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
                                                        <option value="nama">Nama</option>
                                                        <option value="jenis_kelamin">Jenis Kelamin</option>
                                                        <option value="jumlah_anak">Jumlah Anak</option>
                                                        <option value="status">Status Menikah</option>
                                                        <option value="mulai">Mulai Bekerja</option>
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
                                                <button class="btn btn-warning col-sm-2" id="btnhapus" type="delete">Hapus</button>
                                            </div>
                                        </div>
                                        <br>
                                        <table class="display expandable-table table-striped table-bordered"
                                            style="width:100%" id="tblGaji">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Nama</th>
                                                    <th>Status</th>
                                                    <th>JK</th>
                                                    <th>Jumlah Anak</th>
                                                    <th>Mulai Bekerja</th>
                                                    <th>Gaji Awal</th>
                                                    <th>Tunjangan</th>
                                                    <th>Total Gaji</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="9" align="center">Belum ada data</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6" align="center"
                                                        style="background:black;color:white;font-weight:bold;font-size:1em">
                                                        Total</td>
                                                    <td id="totalGajiAwal"></td>
                                                    <td id="totalTunjangan"></td>
                                                    <td id="totalGajiAkhir"></td>
                                                </tr>
                                            </tfoot>
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
                let dataGaji = JSON.parse(localStorage.getItem('dataGaji')) || []

                const data = $('#formGaji').serializeArray()
                console.log(data)
                let newData = {}
                data.forEach(function(item, index) {
                    let name = item['name']
                    let value = (name === 'id' ||
                        name === 'gaji' ?
                        Number(item['value']) : item['value'])
                    newData[name] = value
                })
                localStorage.setItem('dataGaji', JSON.stringify([...dataGaji, newData]))
                return newData
            }

            $(function() {
                //intialize
                let dataGaji = JSON.parse(localStorage.getItem('dataGaji')) || []
                $('#tblGaji tbody').html(showData(dataGaji))
                JumlahTotal()
                //events
                $('#formGaji').on('submit', function(e) {
                    e.preventDefault();
                    insert()
                    dataGaji = JSON.parse(localStorage.getItem('dataGaji'))
                    $('#tblGaji tbody').html(showData(dataGaji))
                    JumlahTotal()

                    console.log(dataGaji)
                })

                $('#sorting').on('change', function() {

                    let nama = document.getElementById("sorting").value;
                    dataGaji = insertionSort(dataGaji, nama)
                    // console.log(dataGaji)
                    $('#tblGaji tbody').html(showData(dataGaji))
                })

                $('#btnSearch').on('click', function(e) {
                    let teksSearch = $('#teksCari').val()
                    console.log(teksSearch)
                    let id = sequentialSearching(dataGaji, 'id', teksSearch)
                    let data = []
                    if (id >= 0)
                        data.push(dataGaji[id])
                    $('#tblGaji tbody').html(showData(data))
                })

                $('#status').on('change', function() {
                    let value = $('#status').val()
                    console.log(value)
                    if (value == 'single') {
                        $('#jumlah_anak').val(0)
                        $('#jumlah_anak').attr('readonly', true)
                    } else {
                        $('#jumlah_anak').attr('readonly', false)

                    }
                })

                $('#jumlah_anak').on('change', function() {
                    let value = $('#jumlah_anak').val()
                    console.log(value)
                    if (value >= 1) {
                        $('#status').val('couple')
                        $('#status').attr('readonly', true)
                    } else {
                        $('#status').attr('readonly', false)

                    }
                })

                $('#btnhapus').on('click', hapusKaryawan);
                //end of events
            })

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

            function showData(dataGaji) {
                let row = ''
                // let arr = JSON.parse(localStorage.getItem('dataGaji')) || []
                if (dataGaji.length == null) {
                    return row = `<tr><td colspan="5">Belum ada data</td></tr>`
                }
                
                dataGaji.forEach(function(item, index) {

                    const awal = 2000000
                    const bonusTahun = 150000
                    const bonusAnak = 150000
                    const bonusCouple = 250000

                    han = new Date(item['mulai'])
                    var ageDifMs = Date.now() - han.getTime();
                    var ageDate = new Date(ageDifMs)
                    var newAge = Math.abs(ageDate.getUTCFullYear() - 1970)
                    var tahun = newAge * bonusTahun

                    if (item['jumlah_anak'] >= 2) {
                        var child = 2
                    } else if (item['jumlah_anak'] != 1) {
                        var child = 0
                    } else {
                        var child = 1
                    }

                    let anak = bonusAnak * child

                    let status = (item['status'] === 'couple' ? bonusCouple : 0)
                    
                    let tunjangan = anak + status + tahun

                    let total = tunjangan + awal

                    row += `<tr>`
                    row += `<td>${item['id']}</td>`
                    row += `<td>${item['nama']}</td>`
                    row += `<td>${item['status']}</td>`
                    row += `<td>${item['jenis_kelamin']}</td>`
                    row += `<td>${item['jumlah_anak']}</td>`
                    row += `<td>${item['mulai']}</td>`
                    row += `<td>${awal}</td>`
                    row += `<td>${tunjangan}</td>`
                    row += `<td>${total}</td>`
                    row += `</tr>`
                })
                return row
            }

            function sequentialSearching(arr, key, teks) {
                // console.log(arr)
                for (let i = 0; i < arr.length; i++) {
                    // console.log(arr[i][key]+"="+teks)
                    if (arr[i][key] == teks)
                        return i
                }
                return 'gagal'
            }

            function JumlahTotal() {
                let table = document.getElementById('tblGaji').getElementsByTagName('tbody')[0]
                let totalGajiAwal = 0
                let totalTunjangan = 0
                let totalGajiAkhir = 0

                for (let i = 0; i < table.children.length; i++) {
                    totalGajiAwal += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[6].innerText)
                    totalTunjangan += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[7].innerText)
                    totalGajiAkhir += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[8].innerText)
                }

                document.getElementById('totalGajiAwal').innerText = totalGajiAwal
                document.getElementById('totalTunjangan').innerText = totalTunjangan
                document.getElementById('totalGajiAkhir').innerText = totalGajiAkhir
            }

            const hapusKaryawan = () => {
                if (confirm('Hapus Semua Data?')) {
                    dataGaji = [];
                    localStorage.removeItem('dataGaji');
                    $('#tblGaji tbody').html(showData(dataGaji));
                    JumlahTotal()
                }
            }

            // function _calculateAge(birthday, item) {
            //     birthday = new Date(birthday)
            //     var ageDiFMs = Date.now() - birthday.getTime();
            //     var ageDate = new Date(ageDiFMs);
            //     return Math.abs(ageDate.GetUTCFullYear() - `${item['mulai']}`);
            //     console.log(ageDate);
            // }
        </script>
    @endpush
