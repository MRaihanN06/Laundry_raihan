<div class="collapse" id="formLaundry">
    <div class="card-body">
        
        <!-- Data awal pelanggan -->
        <div class="card">
          <div class="card-body">
            <form>
              <div class="row" class="col-12">
                <div class="form-group row col-6">
                <label for="statictEmail" class="col-sm-4 col-form-label">Tanggal Transaksi</label>
                  <div class="col-sm-6">
                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                  </div>
                </div>
                <div class="form-group row col-6">
                  <label for="InputPassword" class="col-4 col-form-label">Estimasi Selesai</label>
                    <div class="col-6 ml-auto">
                      <input type="date" class="form-control ml-auto" value="{{ date('Y-m-d', strtotime(date('Y-m-d') . '+3 day')) }}">
                    </div>
                </div>
              </div>
              <div class="row" class="col-12">
                <div class="form-group row col-6">
                <label for="" class="col-sm-4 col-form-label"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalMember"><i class="ti-plus"></i></button> Nama/JK</label>
                  <div class="col-sm-6" id="nama-pelanggan">
                    -
                  </div>
                </div>
                <div class="form-group row col-6">
                  <label for="" class="col-4 col-form-label">Biodata</label>
                    <div class="col-6 ml-auto" id="biodata-pelanggan">
                      -
                    </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- End of Data awal pelanggan -->


        <!-- Data paket -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <button type="button" class="btn btn-primary" id="tambahPaketBtn" data-toggle="modal" data-target="#modalPaket">Tambah Cucian</button>
                  </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="row">
                    <table id="tblTransaksi" class="display expandable-table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama Paket</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" style="text-align:center;font-style:italic">Belum ada data</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End of Data paket -->


        <!-- Pembayaran -->

        <!-- End of Pembayaran -->
    </div>
</div>

<!-- Modal Member -->
<div class="modal fade" id="modalMember" tabindex="-1" role="dialog" aria-labelledby="MyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header text-dark">
        <h3 class="modal-title" id="ModalBuatOutletLabel">Pilih Pelanggan</h3>
        </div>
        <div class="modal-body text-dark">
                <table id="tblMember" class="display expandable-table" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>JK</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($member as $b)
                        <tr>
                            <td>{{ $i = (!isset($i)?1:++$i) }}
                                <input type="hidden" class="idMember" name="idMember" value="{{ $b->id }}"></td>
                            <td>{{ $b->nama }}</td>
                            <td>{{ $b->jenis_kelamin }}</td>
                            <td>{{ $b->tlp }}</td>
                            <td>{{ $b->alamat }}</td>
                            <td> <button type="button" class="pilihMemberBtn btn btn-primary" data-dismiss="modal">Pilih</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>
<!--end of modal member-->

<!-- Modal Paket -->
<div class="modal fade" id="modalPaket" tabindex="-1" role="dialog" aria-labelledby="MyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-l" role="document">
    <div class="modal-content">
        <div class="modal-header text-dark">
        <h3 class="modal-title" id="ModalBuatOutletLabel">Pilih Paket</h3>
        </div>
        <div class="modal-body text-dark">
                <table id="tblPaket" class="display expandable-table" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Paket</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paket as $b)
                        <tr>
                            <td>{{ $j = (!isset($j)?1:++$j) }}
                                <input type="hidden" class="idPaket" name="idPaket" value="{{ $b->id }}"></td>
                            <td>{{ $b->nama_paket }}</td>
                            <td>{{ $b->harga }}</td>
                            <td> <button type="button" class="pilihPaketBtn btn btn-primary" data-dismiss="modal">Pilih</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>
<!--end of modal Paket-->