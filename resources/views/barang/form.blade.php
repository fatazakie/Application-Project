@extends('layouts.master')
@section('title','Data Barang')
@section('heading','Data Barang')

@section('bc')
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Barang</li>
    </ol>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Tambah Barang</h3>
        <div class="card-tools">
            <a href="/barang/" class="btn-close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross-sm"></em>
            </a>
        </div>
    </div>
    <div class="card-body">
      <form id="formBarang" method="POST" action="{{ route('barang.store') }}">
  

            @csrf
            {{-- ID Jenis dan ID Merk bisa berupa dropdown jika sudah ada datanya --}}
            
            <div class="mb-3">
              <label for="id_brg" class="form-label">ID Barang</label>
              <input type="text" name="id_brg" class="form-control" id="id_brg" required>
              <small class="text-danger" id="id_brg_error"></small>
          </div>
          <div class="mb-3">
              <label for="id_jenis" class="form-label">ID Jenis Barang</label>
              <input type="text" name="id_jenis" class="form-control" id="id_jenis" required>
              <small class="text-danger" id="id_jenis_error"></small>
          </div>
          <div class="mb-3">
              <label for="jenis_brg" class="form-label">Jenis Barang</label>
              <input type="text" name="jenis_brg" class="form-control" id="jenis_brg">
              <small class="text-danger" id="jenis_brg_error"></small>
          </div>
          <div class="mb-3">
              <label for="id_merk" class="form-label">ID Merk Barang</label>
              <input type="text" name="id_merk" class="form-control" id="id_merk" required>
              <small class="text-danger" id="id_merk_error"></small>
          </div>
          <div class="mb-3">
              <label for="nm_merk" class="form-label">Merk Barang</label>
              <input type="text" name="nm_merk" class="form-control" id="nm_merk">
              <small class="text-danger" id="nm_merk_error"></small>
          </div>
          <div class="mb-3">
              <label for="nm_brg" class="form-label">Nama Barang</label>
              <input type="text" name="nm_brg" class="form-control" id="nm_brg">
              <small class="text-danger" id="nm_brg_error"></small>
          </div>
          <div class="mb-3">
              <label for="hrg_beli" class="form-label">Harga Beli</label>
              <input type="number" name="hrg_beli" class="form-control" id="hrg_beli">
              <small class="text-danger" id="hrg_beli_error"></small>
          </div>
          <div class="mb-3">
            <label for="hrg_jual" class="form-label">Harga Jual</label>
            <input type="number" name="hrg_jual" class="form-control" id="hrg_jual">
            <small class="text-danger" id="hrg_jual_error"></small>
        </div>
          <div class="mb-3">
              <label for="qty" class="form-label">QTY</label>
              <input type="number" name="qty" class="form-control" id="qty">
              <small class="text-danger" id="qty_error"></small>
          </div>
          <button type="submit" class="btn btn-primary">Tambah Data</button>
          <small class="text-danger" id="id_brg_error"></small>

      </form>
   

    </div>
</div>


@endsection
@section('scripts')
<script>
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $('#formBarang').submit(function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('barang.store') }}",
            method: 'POST',
            data: formData,
            success: function(res) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: res.success || 'Data berhasil ditambahkan!',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "/barang";
                });
            },
            error: function(err) {
    console.log(err);

    if (err.status === 422) {
        let errors = err.responseJSON.errors;

        // Reset semua error sebelumnya
        $('.text-danger').text('');
        $('.form-control').removeClass('is-invalid');

        // Tandai hanya field yang error
        $.each(errors, function(field, messages) {
            let input = $('#' + field);
            input.addClass('is-invalid');
            $('#' + field + '_error').text(messages[0]);

            // Jika mau kosongkan input error, tambahkan ini:
            // input.val('');
        });

        // SweetAlert ringkas
        let errorMessages = Object.values(errors).map(val => val[0]).join('\n');
        Swal.fire({
            icon: 'error',
            title: 'Gagal Menyimpan!',
            text: errorMessages,
        });
    }
}



        });
    });
});
</script>
@endsection


