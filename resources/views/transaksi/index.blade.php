@extends('layouts/main')

@section('content')

    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          @if (session()->has('success'))
            <div class="alert alert-success text-center" role="alert">
                {{ session('success') }}
            </div>  
          @endif
          <div class="col-md-12 grid-margin">
            <div class="row">
              <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Master Data Transaksi</h3>
                <h6 class="font-weight-normal mb-0">Membuat, Melihat, Perbaharui dan Hapus Data Transaksi <span class="text-primary">Hati-hati dengan keputusan anda!</span></h6>
              </div>
            </div>
            <br>
            <br>

            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                  <div class="col-12">
                    <div class="table-responsive">
                      <ul class="nav nav-tabs">
                        <li class="nav-item">
                          <a class="nav-link active" id="nav-data" aria-current="page" data-bs-toggle="collapse" href="#dataLaundry" role="button" aria-expanded="false" aria-controls="collapseExample">Data Laundry</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="nav-form" data-bs-toggle="collapse" href="#formLaundry" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="ti-plus"></i>&nbsp;&nbsp;&nbsp;Cucian Baru</a>
                        </li>
                      </ul>
                      <div class="card" style+border-top:0px>
                        @include('transaksi.form')
                        @include('transaksi.data')

                        <input type="hidden" class="id_member" id="id_member">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->

@endsection

@push('script')
<script>
// Script Untuk #menu data dan form transaksi
  // $('#dataLaundry').collapse('show')

  $('#dataLaundry').on('show.bs.collapse', function(){
    $('#formLaundry').collapse('hide');
    $('#nav-form').removeClass('active');
    $('#nav-data').addClass('active');
  })

  $('#formLaundry').on('show.bs.collapse', function(){
    $('#dataLaundry').collapse('hide');
    $('#nav-data').removeClass('active');
    $('#nav-form').addClass('active');
  })
// end menu

// Initialize
  $(function(){
    $('#tblMember').DataTable();
  });
// End of Initialize

// action
  // pilih member
  $('#tblMember').on('click', '.pilihMemberBtn', function(){
    pilihMember(this)
    $('#modalMember').modal('hide')
  })

  // pilih paket
  $('#tblPaket').on('click', '.pilihPaketBtn', function(){
    pilihPaket(this)
    $('#modalPaket').modal('hide')
  })

//function pilih member
  function pilihMember(x){
    const tr = $(x).closest('tr')
    const namaJk = tr.find('td:eq(1)').text()+"/"+tr.find('td:eq(2)').text()
    const biodata = tr.find('td:eq(4)').text()+"/"+tr.find('td:eq(3)').text()
    const idMember = tr.find('.idMember').val()
    $('#nama-pelanggan').text(namaJk)
    $('#biodata-pelanggan').text(biodata)
    $('#id_member').val(idMember)
  }

//function pilih paket
function pilihPaket(x){
    const tr = $(x).closest('tr')
    const namaPaket = tr.find('td:eq(1)').text()
    const harga = tr.find('td:eq(2)').text()
    const idPaket = tr.find('.idPaket').val()
    
    let data = ''
    let tbody = $('#tblTransaksi tbody tr td').text()
    data += '<tr>'
    data += `<td> ${namaPaket} </td>`
    data += `<td> ${harga} </td>`;
    data += `<input type="hidden" name="id_paket" value="${idPaket}">`
    data += `<td><input type="number" value="1" min="1" class="qty" name="qty[]" size="2" style="width:40px"></td>`;
    data += `<td><label name="sub_total[]" class="subTotal">${harga}</label></td>`;
    data += `<td><button type="button" class="btnRemovePaket btn btn-danger">Hapus</button></td>`;
    data += '<tr>';

    if(tbody == 'Belum ada data') $('#tblTransaksi tbody tr').remove();

    $('#tblTransaksi tbody').append(data);

    subtotal += Number(harga)
    total = subtotal - Number($('#diskon').val()) + Number($('#pajak-harga').val())
    $('subtotal').text(subtotal)
    $('#total').text(total)
  }


</script>
@endpush