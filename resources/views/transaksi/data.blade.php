<div class="collapse" id="dataLaundry">
    <div class="card-body">
        <h3>Data</h3>

        <table class="expandable-table w-100 table-sm" id="tb-transaksi">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Outlet</th>
                <th>Kode Invoice</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Masuk</th>
                <th>Batas Waktu</th>
                <th>Total</th>
                <th>Status</th>
                <th>Pembayaran</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transaksi as $t)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $t->outlet->nama ?? '' }}</td>
                  <td>{{ $t->kode_invoice }}</td>
                  <td>{{ $t->member->nama ?? '' }}</td>
                  <td>{{ $t->tgl }}</td>
                  <td>{{ $t->batas_waktu }}</td>
                  <td>{{ $t->total }}</td>
                  <td>{{ $t->status }}</td>
                  <td>{{ $t->pembayaran }}</td>
                  <td>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#ModalLihatData{{ $t->id }}">
                    <i class="ti-info-alt"></i>
                  </button>
                  <div class="modal fade" id="ModalLihatData{{ $t->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalLihatDataLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header text-dark">
                          <h5 class="modal-title" id="ModalLihatDataLabel">Lihat Data Disini</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-dark">
                          <ul class="nav nav-tabs">
                            <li class="nav-item">
                              <a class="nav-link active" id="nav-DetailData" aria-current="page" data-bs-toggle="collapse" href="#DetailData" role="button" aria-expanded="false" aria-controls="collapseExample">Detail Transaksi</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="nav-DetailPelanggan" data-bs-toggle="collapse" href="#DetailPelanggan" role="button" aria-expanded="false" aria-controls="collapseExample">&nbsp;&nbsp;&nbsp;Detail Pelanggan</a>
                            </li>
                          </ul>
                          <div class="collapse" id="DetailData">
                          <table class="expandable-table w-100 table-sm">
                            <tbody>
                              <tr>
                                <td>Nama Outlet</td>
                                <td>{{ $t->outlet->nama ?? '' }}</td>
                              </tr>
                              <tr>
                                <td>Kode Invoice</td>
                                <td>{{ $t->kode_invoice }}</td>
                              </tr>
                              <tr>
                                <td>Nama Pelanggan</td>
                                <td>{{ $t->member->nama ?? '' }}</td>
                              </tr>
                              <tr>
                                <td>Tanggal Masuk</td>
                                <td>{{ $t->tgl }}</td>
                              </tr>
                              <tr>
                                <td>Batas Waktu</td>
                                <td>{{ $t->batas_waktu }}</td>
                              </tr>
                              <tr>
                                <td>Tanggal Bayar</td>
                                <td>{{ $t->tgl_bayar }}</td>
                              </tr>
                              <tr>
                                <td>Status</td>
                                <td>{{ $t->status }}</td>
                              </tr>
                              <tr>
                                <td>Pembayaran</td>
                                <td>{{ $t->pembayaran }}</td>
                              </tr>
                              <tr>
                                <td>Kasir</td>
                                <td>{{ $t->user->name ?? '' }}</td>
                              </tr>
                            </tbody>
                          </table>
                          <table class="expandable-table w-100 table-sm">
                            <thead>
                              <tr>
                              <th>No</th>
                              <th>Nama Paket</th>
                              <th>Harga</th>
                              <th>Qty</th>
                              <th>Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($DetailTransaksi as $dt)
                              <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dt->paket->nama_paket ?? '' }}</td>
                                <td>{{ $dt->paket->harga ?? '' }}</td>
                                <td>{{ $dt->qty }}</td>
                                <td></td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                          </div>
                          <div class="collapse" id="DetailPelanggan">
                            <table class="expandable-table w-100 table-sm">
                              <tbody>
                                <tr>
                                  <td>Nama</td>
                                  <td>{{ $t->member->nama ?? '' }}</td>
                                </tr>
                                <tr>
                                  <td>Alamat</td>
                                  <td>{{ $t->member->alamat ?? '' }}</td>
                                </tr>
                                <tr>
                                  <td>Jenis Kelamin</td>
                                  <td>{{ $t->member->jenis_kelamin ?? '' }}</td>
                                </tr>
                                <tr>
                                  <td>Nomor Telepon</td>
                                  <td>{{ $t->member->tlp ?? '' }}</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                            </div>
                  </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
</div>