@extends('layout.layout')
@section('content')

<div class="content-body">

   <div class="row page-titles mx-0">
      <div class="col p-md-0">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">{{$title}}</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$title}}</a></li>
         </ol>
      </div>
   </div>

   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <!-- Sematkan data diskon sebagai atribut data pada elemen HTML -->
               <div id="diskonData" data-diskon="{{ $data_diskon->diskon }}" data-total-belanja="{{ $data_diskon->total_belanja }}"></div>
               <form action="/transaksi/store" method="POST">
                  @csrf
                  <div class="card-body">
                     <div class="d-flex justify-content-between align-items-center">
                        <div>
                           <h4 class="card-title">{{ $title }}
                        </div>
                        <div>
                           <button class="btn btn-primary" type="button" data-target="#modalBarang" data-toggle="modal">
                              <i class="fa fa-plus"></i>
                              Tambah barang
                           </button></h4>
                        </div>
                     </div>
                     <hr/>
                     <div class="row justify-content-between">
                        <div class="col-md-3">
                           <div class="form-group">
                              <div>
                                 @php
                                    $newTrans = "";
                                    if ($data_trans->count() > 0) {
                                       $lastRecVal = $data_trans->last()->no_transaksi;
                                       $newTrans = str_pad(intval($lastRecVal) + 1, strlen($lastRecVal), "0", STR_PAD_LEFT);
                                    } else {
                                       $newTrans = "0001";
                                    }
                                 @endphp
                                 <label for="no_transaksi">No Transaksi</label>
                                 <input type="text" class="form-control" name="no_transaksi" value="{{ $newTrans }}" readonly required>
                                 <input type="hidden" name="id_kasir" value="{{  }}">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="tanggal">Tanggal</label>
                              <input type="text" class="form-control" name="tanggal" value="{{ date('d-m-Y') }}" readonly required>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="uangPembeli">Uang pembeli</label>
                              <input type="number" class="form-control" id="uangPembeli" value="0" required>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="kembalian">Kembalian</label>
                              <input type="number" class="form-control" id="kembalian" placeholder="0" style="font-weight: bold; color: red" readonly>
                           </div>
                        </div>
                     </div>
                     <div class="table-responsive table-hover">
                        <table id="tabel-barang" class="table table-bordered">
                           <thead>
                              <tr class="table-active">
                                 <th>No</th>
                                 <th>Barang</th>
                                 <th style="text-align: center">Harga</th>
                                 <th style="text-align: center">Qty</th>
                                 <th style="text-align: center">Subtotal</th>
                                 <th>Opsi</th>
                              </tr>
                           </thead>
                           <tbody>
                              <!-- Isi tabel akan diisi melalui JavaScript -->
                           </tbody>
                           <tfoot>
                              <tr>
                                 <td colspan="4">Total</td>
                                 <td style="text-align: right" id="totalHarga">0</td>
                              </tr>
                              <tr>
                                 <td colspan="4">Diskon</td>
                                 <td style="text-align: right" id="diskon">0</td>
                                 <input type="hidden" name="diskon" >
                              </tr>
                              <tr>
                                 <td colspan="4">Total bayar</td>
                                 <td style="text-align: right" id="totalBayar">0</td>
                                 <input type="hidden" name="totalBayar">
                              </tr>
                           </tfoot>
                        </table>
                        <!-- Input tersembunyi untuk menyimpan barang yang dipilih -->
                        <div id="barangTerpilih"></div>
                     </div>
                  </div>
                  <div class="card-footer">
                     <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Proses transaksi</button>
                     <a href="/transaksi" class="btn btn-danger"><i class="fa fa-undo"></i> Batal</a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   <!-- Modal Tambah Barang -->
   <div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="modalBarangLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="modalBarangLabel">Tambah Barang</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">x</span>
               </button>
            </div>
            <div class="modal-body">
               <!-- Form Tambah Barang -->
               <form id="formTambahBarang">
                  @csrf
                  <div class="form-group">
                     <label for="namaBarang">Nama Barang</label>
                     <select class="form-control" id="namaBarang" name="id_barang" onchange="tampilkanDetailBarang()">
                        <option value="">Pilih Barang</option>
                        @foreach($data_barang as $item)
                           <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div id="grupDetail" style="display: none;">
                     <div class="form-group">
                        <label for="hargaBarang">Harga</label>
                        <input type="number" class="form-control" id="hargaBarang" name="harga" readonly>
                     </div>
                     <div class="form-group">
                        <label for="stokBarang">Stok</label>
                        <input type="number" class="form-control" id="stokBarang" name="stok" readonly>
                     </div>
                     <div class="form-group">
                        <label for="jumlahBarang">Jumlah</label>
                        <input type="number" class="form-control" id="jumlahBarang" name="quantity">
                     </div>
                  </div>
               </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
               <button type="button" class="btn btn-primary" onclick="tambahBarangKeNota()">Tambahkan ke Nota</button>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
   // Mengambil nilai diskon dari atribut data
   var no_urut = 1;
   var totalBayar = 0;
   var diskon = document.getElementById('diskonData').getAttribute('data-diskon');
   var diskonTotalBelanja = document.getElementById('diskonData').getAttribute('data-total-belanja');

   document.getElementById('uangPembeli').addEventListener('input', function () {
      var uangPembeli = parseInt(this.value);
      var kembalian = uangPembeli - totalBayar;

      document.getElementById('kembalian').value = kembalian;
   });

   // Fungsi untuk menampilkan detail barang ketika barang dipilih pada modal
   function tampilkanDetailBarang() {
   var idBarang = document.getElementById('namaBarang').value;
   var hargaBarangInput = document.getElementById('hargaBarang');
   var stokBarangInput = document.getElementById('stokBarang');
   var jumlahBarangInput = document.getElementById('jumlahBarang');

   if (idBarang) {
      // Menggunakan fetch API untuk mengirim permintaan ke server
      fetch('/api/barang/' + idBarang)
         .then(response => response.json())
         .then(data => {
            // Menampilkan harga barang di dalam modal
            hargaBarangInput.value = data.harga;
            stokBarangInput.value = data.stok;
            // Mengatur ulang jumlah barang setiap kali barang baru dipilih
            jumlahBarangInput.value = '';
            // Tampilkan input harga dan jumlah
            document.getElementById("grupDetail").style.display = 'block';
         })
         .catch(error => console.error('Error:', error));
   } else {
      // Reset harga dan jumlah jika tidak ada barang yang dipilih
      hargaBarangInput.value = '0';
      stokBarangInput.value = '0';
      jumlahBarangInput.value = '0';
      // Sembunyikan input harga dan jumlah
      document.getElementById("grupDetail").style.display = 'none';
   }
}

	// Fungsi untuk menambahkan barang ke nota
	function tambahBarangKeNota() {
		var idBarang = document.getElementById('namaBarang').value;
		var jumlahBarang = document.getElementById('jumlahBarang').value;
		var hargaBarang = document.getElementById('hargaBarang').value;
		var subtotal = jumlahBarang * hargaBarang;

		// Logika untuk menambahkan input tersembunyi dengan data barang
		// Tambahkan input tersembunyi untuk id_barang dan quantity
		var inputIdBarang = document.createElement('input');
		inputIdBarang.type = 'hidden';
		inputIdBarang.name = 'barang[id_barang][]';
		inputIdBarang.value = idBarang;
		document.getElementById('barangTerpilih').appendChild(inputIdBarang);

		var inputQuantity = document.createElement('input');
		inputQuantity.type = 'hidden';
		inputQuantity.name = 'barang[quantity][]';
		inputQuantity.value = jumlahBarang;
		document.getElementById('barangTerpilih').appendChild(inputQuantity);

		// Membuat elemen baris baru di tabel
		var tabelBarang = document.getElementById('tabel-barang').getElementsByTagName('tbody')[0];
		var barisBaru = tabelBarang.insertRow();
		barisBaru.innerHTML = `
         <td>${no_urut++}</td>
         <td>${document.querySelector("#namaBarang option:checked").text}</td>
         <td>${hargaBarang}</td>
         <td>${jumlahBarang}</td>
         <td>${subtotal}</td>
    `;

		// Menutup modal
      // Sembunyikan harga, stok dan jumlah barang
      document.getElementById("grupDetail").style.display = 'none';
      // Reset pilihan nama barang 
      document.getElementById('namaBarang').value = '';
		$('#modalBarang').modal('hide');

		// Mengupdate total harga
		updateTotalHarga();
	}

	// Fungsi untuk mengupdate total harga
	function updateTotalHarga() {
		var totalHarga = 0;

		document.querySelectorAll('#tabel-barang tbody tr').forEach(tr => {
			totalHarga += parseInt(tr.cells[4].innerText);
		});
		document.getElementById('totalHarga').innerText = totalHarga;

      total(totalHarga);
	}

   function total(totalHarga) {
      var hargaDiskon = 0;
		totalBayar = 0;

      // Tampilkan data Diskon jika total belanja memenuhi syarat
      if (totalHarga >= diskonTotalBelanja) {
         hargaDiskon = diskon * totalHarga / 100;
         document.getElementById('diskon').innerText = hargaDiskon;
         document.getElementsByName('diskon')[0].value = hargaDiskon;
         totalBayar = totalHarga - hargaDiskon;

      } else {
         totalBayar = totalHarga;
      }
      document.getElementById('totalBayar').innerText = totalBayar;
      document.getElementsByName('totalBayar')[0].value = totalBayar;
   }
</script>

@endsection