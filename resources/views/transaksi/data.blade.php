<div class="collapse" id="dataLaundry">
    <div class="card-body">
        <h3>Data</h3>

        <table class="expandable-table w-100 table-sm" id="tb-transaksi">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Outlet</th>
                <th>Kode Invoice</th>
                <th>Nama Member</th>
                <th>Tanggal</th>
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

                  </td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
</div>