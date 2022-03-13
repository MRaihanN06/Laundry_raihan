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
                            <h6 class="font-weight-normal mb-0">Simulasi Buku <span class="text-primary">Hati-hati dengan
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

                                        <form id="formBuku">
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
                                                <label for="judul" class="col-sm-2 col-form-label">
                                                    <h6>Judul</h6>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="judul" id="judul"
                                                        placeholder="Judul" required>
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-3">
                                                <label for="pengarang" class="col-sm-2 col-form-label">
                                                    <h6>Pengarang</h6>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="pengarang"
                                                        id="pengarang" placeholder="Pengarang" required>
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-3">
                                                <label for="tahun" class="col-sm-2 col-form-label">
                                                    <h6>Tahun</h6>
                                                </label>
                                                <div class="col-sm-10">
                                                    <select type="number" class="form-control" name="tahun" id="tahun"
                                                        placeholder="" required>
                                                        @for ($i = date('Y'); $i > 1900; $i--)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                        <select>
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-3">
                                                <label for="harga" class="col-sm-2 col-form-label">
                                                    <h6>Harga</h6>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" name="harga" id="harga"
                                                        min="0" placeholder="Harga" required>
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-3">
                                                <label for="qty" class="col-sm-2 col-form-label">
                                                    <h6>QTY</h6>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" name="qty" id="qty" min="0"
                                                        placeholder="0" required>
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
                                                    <option value="id">Id Buku</option>
                                                    <option value="judul">Judul</option>
                                                    <option value="pengarang">Pengarang</option>
                                                    <option value="tahun">Tahun</option>
                                                    <option value="harga">Harga</option>
                                                    <option value="qty">Qty</option>
                                                </select>
                                            <div>
                                                <br><input type="search" class="form-control col-sm-2" name="teksCari"
                                                    id="teksCari">
                                                <br><button class="btn btn-primary" type="button" id="btnSearch">Cari</button>
                                            </div>
                                        </div>
                                        <br>
                                        <table class="display expandable-table table-stripped" style="width:100%" id="tblBuku">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Judul</th>
                                                    <th>Pengarang</th>
                                                    <th>Tahun</th>
                                                    <th>Harga</th>
                                                    <th>Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="6" align="center"> belum ada data </td>
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
                let dataBuku = JSON.parse(localStorage.getItem('dataBuku')) || []
                
                const data = $('#formBuku').serializeArray()
                // console.log(data)
                let newData = {}
                data.forEach(function(item, index) {
                    let name = item['name']
                    let value = (   name === 'id' ||
                                    name === 'qty' ||
                                    name === 'harga'
                                    ? Number(item['value']) : item['value'])
                    newData[name] = value
                })
                localStorage.setItem('dataBuku', JSON.stringify([ ... dataBuku, newData]))
                return newData
            }

            // after load
            //     console.log(dataBuku)
            //     $('#tblBuku tbody').html(showData(dataBuku))
            
            $(function() {
                //intialize
                let dataBuku = JSON.parse(localStorage.getItem('dataBuku')) || []
                    $('#tblBuku tbody').html(showData(dataBuku))

                    //events
                    $('#formBuku').on('submit', function(e) {
                        e.preventDefault();
                        insert()
                        $('#tblBuku tbody').html(showData(dataBuku)) 
                    })
                    
                    $('#sorting').on('change', function() {

                        let nama = document.getElementById("sorting").value;
                            dataBuku = insertionSort(dataBuku, nama)
                        // console.log(dataBuku)
                            $('#tblBuku tbody').html(showData(dataBuku))
                    })


                    $('#btnSearch').on('click', function(e) {
                        let teksSearch = $('#teksCari').val()
                        console.log(teksSearch)
                        let id = searching(dataBuku, 'id', teksSearch)
                        let data = []
                        if (id >= 0)
                            data.push(dataBuku[id])
                        console.log(id)
                        console.log(data)
                        $('#tblBuku tbody').html(showData(data))
                    })
                    //end of events
                })

                    function showData(dataBuku) {
                        let row = ''
                        // let arr = JSON.parse(localStorage.getItem('dataBuku')) || []
                        if (dataBuku.length == null) {
                            return row = `<tr><td colspan="3">Belum ada data</td></tr>`
                        }
                        dataBuku.forEach(function(item, index) {
                            row += `<tr>`
                            row += `<td>${item['id']}</td>`
                            row += `<td>${item['judul']}</td>`
                            row += `<td>${item['pengarang']}</td>`
                            row += `<td>${item['tahun']}</td>`
                            row += `<td>${item['harga']}</td>`
                            row += `<td>${item['qty']}</td>`
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
