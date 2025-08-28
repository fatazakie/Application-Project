<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Print Report</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; font-size: 12px; }
        @media print {
            button { display: none; }
        }
    </style>
</head>
<body>
    <h2>Laporan Report</h2>
    <button onclick="window.print()">Cetak Sekarang</button>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Barang</th>
                <th>Qty</th>
                <th>Harga Jual</th>
                <th>Laba</th>
                <th>Zakat</th>
                <th>Laba Bersih</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $r)
            <tr>
                <td>{{ $r->id_report }}</td>
                <td>{{ $r->nm_brg }}</td>
                <td>{{ $r->qty }}</td>
                <td>Rp {{ number_format($r->hrg_jual) }}</td>
                <td>Rp {{ number_format($r->laba) }}</td>
                <td>Rp {{ number_format($r->zakat) }}</td>
                <td>Rp {{ number_format($r->laba_bersih) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
