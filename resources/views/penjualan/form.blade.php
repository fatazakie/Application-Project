@extends('layouts.master')
@section('title','Data Penjualan')
@section('heading','Data Penjualan')

@section('bc')
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Penjualan</li>
    </ol>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="/penjualan/" class="btn-close" data-dismiss="modal" aria-label="Close"></a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('penjualan.store') }}">
            @csrf

            <div class="mb-3">
                <label for="tgl_penjualan" class="form-label">Tanggal Penjualan</label>
                <input type="date" name="tgl_penjualan" class="form-control" value="{{ old('tgl_penjualan', now()->format('Y-m-d')) }}">
            </div>


    <div id="barang-container">
        <div class="barang-row mb-3 border p-3 rounded">
            <div class="row g-2 align-items-end">
                <div class="col-md-2">
                    <label>Pilih Barang</label>
                    <select name="items[0][id_brg]" class="form-control barang-select" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id_brg }}" data-harga="{{ $barang->hrg_jual }}">
                                {{ $barang->nm_brg }}
                            </option>
                        @endforeach
                    </select>
                </div>
    
                <div class="col-md-2">
                    <label>Pilih Merk</label>
                    <select name="items[0][id_merk]" class="form-control" required>
                        <option value="">-- Pilih Merk --</option>
                        @foreach($merks as $merk)
                            <option value="{{ $merk->id_merk }}">{{ $merk->nm_merk }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="col-md-2">
                    <label>Pilih Jenis</label>
                    <select name="items[0][id_jenis]" class="form-control" required>
                        <option value="">-- Pilih Jenis --</option>
                        @foreach($jenis as $j)
                            <option value="{{ $j->id_jenis }}">{{ $j->jenis_brg }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="col-md-2">
                    <label>Harga Jual</label>
                    <input type="text" class="form-control hrg_jual_preview" readonly>
                </div>
    
                <div class="col-md-2">
                    <label>Qty</label>
                    <input type="number" name="items[0][qty]" class="form-control" min="1" value="1">
                </div>
            </div>
        </div>
    </div>
    
    <button type="button" id="add-row" class="btn btn-success btn-sm mb-3">+</button>
    

            
    <br><br>
    <button type="submit" class="btn btn-primary">Simpan Penjualan</button>
    <script>
       let rowIdx = 1;

document.getElementById('add-row').addEventListener('click', function () {
    let container = document.getElementById('barang-container');
    let newRow = container.firstElementChild.cloneNode(true);

    // reset value input/select
    newRow.querySelectorAll('select, input').forEach(el => {
        if(el.tagName === 'SELECT' || el.tagName === 'INPUT'){
            el.value = '';
            // update name sesuai index
            let name = el.getAttribute('name');
            if(name){
                el.setAttribute('name', name.replace(/\d+/, rowIdx));
            }
        }
    });

    container.appendChild(newRow);
    rowIdx++;
});

        
        // event untuk hapus row
        document.addEventListener('click', function (e) {
            if(e.target.classList.contains('remove-row')){
                if(document.querySelectorAll('.barang-row').length > 1){
                    e.target.closest('.barang-row').remove();
                }
            }
        });
        
            // event untuk auto isi harga jual
            document.addEventListener('change', function(e){
                if(e.target.classList.contains('barang-select')){
                    let harga = e.target.options[e.target.selectedIndex].getAttribute('data-harga');
                    e.target.closest('.barang-row').querySelector('.hrg_jual_preview').value = "Rp " + new Intl.NumberFormat('id-ID').format(harga);
                }
            });
            </script>
</form>

    
@endsection