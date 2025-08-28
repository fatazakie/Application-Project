@extends('layouts.master')
@section('title','Data Pembelian')
@section('heading','Data Pembelian')

@section('bc')
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Pembelian</li>
    </ol>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="/pembelian/" class="btn-close" data-dismiss="modal" aria-label="Close"></a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('pembelian.store') }}">
            @csrf

            <div class="mb-3">
                <label for="tgl_pembelian" class="form-label">Tanggal Pembelian</label>
                <input type="date" name="tgl_pembelian" class="form-control" value="{{ old('tgl_pembelian', now()->format('Y-m-d')) }}">
            </div>

            <div id="barang-container">
                <div class="barang-row mb-3 border p-3 rounded">
                    <div class="row g-2">
                        <div class="col-md-3">
                            <label>Pilih Barang</label>
                            <select name="items[0][id_brg]" class="form-control select-barang" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barangs as $barang)
                                    <option value="{{ $barang->id_brg }}" data-hrg_beli="{{ $barang->hrg_beli }}">
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
                            <label>Harga Beli</label>
                            <input type="number" name="items[0][hrg_beli]" class="form-control harga-beli" readonly>
                        </div>

                        <div class="col-md-2">
                            <label>QTY</label>
                            <input type="number" name="items[0][qty]" class="form-control" min="1" required>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" id="add-row" class="btn btn-success btn-sm mb-3">+</button>
        
<br><br>
            <button type="submit" class="btn btn-primary mt-2">Simpan Pembelian</button>

            
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

                
                // Event delegation untuk auto-fill harga beli
                document.getElementById('barang-container').addEventListener('change', function(e){
                    if(e.target && e.target.classList.contains('select-barang')){
                        let hargaInput = e.target.closest('.barang-row').querySelector('.harga-beli');
                        let harga = e.target.selectedOptions[0].dataset.hrg_beli || 0;
                        hargaInput.value = harga;
                    }
                });
                </script>
                
            
        </form>
    </div>
</div>

@endsection

