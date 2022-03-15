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
                                            <div class="form-grup row mb-3">
                                                <label for="id" class="col-sm-2 col-form-label">
                                                    <h6>ID</h6>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="id" id="id"
                                                        placeholder="ID" required>
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-3">
                                                <label for="nama" class="col-sm-2 col-form-label">
                                                    <h6>Nama</h6>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="nama" id="nama"
                                                        placeholder="Nama" required>
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-3">
                                                <label for="jenis_kelamin" class="col-sm-2 col-form-label">
                                                    <h6>Jenis Kelamin</h6>
                                                </label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                                        <option value="L">Laki-Laki</option>
                                                        <option value="P">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-3">
                                                <label for="status" class="col-sm-2 col-form-label">
                                                    <h6>Status Menikah</h6>
                                                </label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="status" id="status">
                                                        <option value="single">Single</option>
                                                        <option value="couple">Couple</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-3">
                                                <label for="jumlah_anak" class="col-sm-2 col-form-label">
                                                    <h6>Jumlah Anak</h6>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" name="jumlah_anak"
                                                        id="jumlah_anak" min="0" placeholder="Jumlah Anak" required>
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-3">
                                                <label for="mulai" class="col-sm-2 col-form-label">
                                                    <h6>Mulai Bekerja</h6>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}"
                                                        name="mulai" id="mulai">
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-3" hidden>
                                                <input type="number" class="form-control" name="gaji" id="gaji"
                                                    value="2000000">
                                            </div>
                                            <div class="form-grup row">
                                                <label for="nama" class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                    <button class="btn btn-primary" id="btnSimpan"
                                                        type="submit">Simpan</button>
                                                    <button class="btn btn-dark" id="btnReset" type="reset">Reset</button>
                                                </div>
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

                                        <div class="form-group row-3">

                                            <label for="sorting">
                                                <h6>Sorting</h6>
                                            </label>
                                            <select name="sorting" id="sorting" class="form-control col-sm-2">
                                                <option value="id">Id</option>
                                                <option value="nama">Nama</option>
                                                <option value="jenis_kelamin">Jenis Kelamin</option>
                                                <option value="jumlah_anak">Jumlah Anak</option>
                                                <option value="status">Status Menikah</option>
                                                <option value="mulai">Mulai Bekerja</option>
                                            </select>

                                            <br><label for="sorting">
                                                <h6>Cari</h6>
                                            </label>
                                            <div>
                                                <input type="search" class="form-control col-sm-2" name="teksCari"
                                                    id="teksCari" placeholder="Search">
                                                <br><button class="btn btn-primary" type="button"
                                                    id="btnSearch">Cari</button>
                                            </div>
                                        </div>
                                        <br>
                                        <table class="display expandable-table table-stripped" style="width:100%"
                                            id="tblGaji">
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
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
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
                //events
                $('#formGaji').on('submit', function(e) {
                    e.preventDefault();
                    insert()
                    dataGaji = JSON.parse(localStorage.getItem('dataGaji'))
                    $('#tblGaji tbody').html(showData(dataGaji))

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
                dataGaji.forEach(function(item, index, birthday) {

                    // birthday        = new Date(item['gaji'])
                    // var ageDiFMs    = Date.now() - birthday.getTime();
                    // var ageDate     = new Date(ageDiFMs);
                    // let ageNew      = Math.abs(ageDate.GetUTCFullYear() - 1970);

                    // let TunjanganTahun   = ageNew*150000

                    // let child       = 0

                    // if (item['jumlah_anak'] > 1) {
                    //     child == 2
                    // } else (item['jumlah_anak'] = 1){
                    //     child == 1
                    // }

                    // let TunjanganAnak =  child*150000

                    // let status = (item['status'] == 'menikah' ?250000:0)
                    // let Tunjangan = TunjanganTahun + TunjanganAnak + status
                    // let Total = Tunjangan + item['gaji']

                    row += `<tr>`
                    row += `<td>${item['id']}</td>`
                    row += `<td>${item['nama']}</td>`
                    row += `<td>${item['status']}</td>`
                    row += `<td>${item['jenis_kelamin']}</td>`
                    row += `<td>${item['jumlah_anak']}</td>`
                    row += `<td>${item['mulai']}</td>`
                    row += `<td>${item['gaji']}</td>`
                    row += `<td>${item['']}</td>`
                    row += `<td>${item['']}</td>`
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

            // function _calculateAge(birthday, item) {
            //     birthday = new Date(birthday)
            //     var ageDiFMs = Date.now() - birthday.getTime();
            //     var ageDate = new Date(ageDiFMs);
            //     return Math.abs(ageDate.GetUTCFullYear() - `${item['mulai']}`);
            //     console.log(ageDate);
            // }
        </script>
    @endpush
