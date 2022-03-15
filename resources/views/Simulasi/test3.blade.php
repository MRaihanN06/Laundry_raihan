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
                            <h6 class="font-weight-normal mb-0">Simulasi Siswa <span class="text-primary">Hati-hati dengan
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

                                        <form id="formSiswa">
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
                                                <label for="kesukaan" class="col-sm-2 col-form-label">
                                                    <h6>Kesukaan</h6>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="kesukaan" id="kesukaan"
                                                        placeholder="Kesukaan" required>
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-3">
                                                <label for="usia" class="col-sm-2 col-form-label">
                                                    <h6>Usia</h6>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" name="usia" id="usia"
                                                        min="0" placeholder="Usia" required>
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-3">
                                                <label for="uang_jajan" class="col-sm-2 col-form-label">
                                                    <h6>Uang Jajan</h6>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" name="uang_jajan"
                                                        id="uang_jajan" min="0" placeholder="Uang Jajan" required>
                                                </div>
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
                                            <select name="sorting" id="sorting" class="form-control col-sm-2">
                                                <option value="id">Id</option>
                                                <option value="nama">Nama</option>
                                                <option value="kesukaan">Kesukaan</option>
                                                <option value="usia">usia</option>
                                                <option value="uang_jajan">Uang Jajan</option>
                                            </select>
                                            <div>
                                                <br><input type="search" class="form-control col-sm-2" name="teksCari"
                                                    id="teksCari">
                                                <br><button class="btn btn-primary" type="button"
                                                    id="btnSearch">Cari</button>
                                            </div>
                                        </div>
                                        <br>
                                        <table class="display expandable-table table-stripped" style="width:100%"
                                            id="tblSiswa">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Nama</th>
                                                    <th>Kesukaan</th>
                                                    <th>Usia</th>
                                                    <th>Uang Jajan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="5" align="center">Belum ada data</td>
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
            //method
            function insert() {
                let dataSiswa = JSON.parse(localStorage.getItem('dataSiswa')) || []

                const data = $('#formSiswa').serializeArray()
                // console.log(data)
                let newData = {}
                data.forEach(function(item, index) {
                    let name = item['name']
                    let value = (name == 'id' ||
                        name == 'usia' ||
                        name == 'uang_jajan' ?
                        Number(item['value']) : item['value'])
                    newData[name] = value
                })
                localStorage.setItem('dataSiswa', JSON.stringify([...dataSiswa, newData]))
                return newData
            }

            $(function() {
                //intialize
                let dataSiswa = JSON.parse(localStorage.getItem('dataSiswa')) || []
                $('#tblSiswa tbody').html(showData(dataSiswa))

                //events
                $('#formSiswa').on('submit', function(e) {
                    e.preventDefault();
                    insert()
                    $('#tblSiswa tbody').html(showData(dataSiswa))
                })

                $('#sorting').on('change', function() {

                    let nama = document.getElementById("sorting").value;
                    dataSiswa = insertionSort(dataSiswa, nama)
                    // console.log(dataSiswa)
                    $('#tblSiswa tbody').html(showData(dataSiswa))
                })

                $('#btnSearch').on('click', function(e) {
                    let teksSearch = $('#teksCari').val()
                    console.log(teksSearch)
                    let id = sequentialSearching(dataSiswa, 'id', teksSearch)
                    let data = []
                    if (id >= 0)
                        data.push(dataSiswa[id])
                    console.log(id)
                    console.log(data)
                    $('#tblSiswa tbody').html(showData(data))
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

            function showData(dataSiswa) {
                let row = ''
                // let arr = JSON.parse(localStorage.getItem('dataSiswa')) || []
                if (dataSiswa.length == null) {
                    return row = `<tr><td colspan="5">Belum ada data</td></tr>`
                }
                dataSiswa.forEach(function(item, index) {
                    row += `<tr>`
                    row += `<td>${item['id']}</td>`
                    row += `<td>${item['nama']}</td>`
                    row += `<td>${item['kesukaan']}</td>`
                    row += `<td>${item['usia']}</td>`
                    row += `<td>${item['uang_jajan']}</td>`
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
        </script>
    @endpush
