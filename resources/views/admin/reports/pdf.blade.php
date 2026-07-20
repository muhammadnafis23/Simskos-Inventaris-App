<!DOCTYPE html>
<html>
<head><style>body{font-family: sans-serif; font-size: 12px;} table{width:100%; border-collapse: collapse;} th,td{border:1px solid #ccc; padding:6px; text-align:left;}</style></head>
<body>
    <h2>Laporan Stok — SIMSKOS</h2>
    <p>Dicetak: {{ now()->format('d M Y H:i') }}</p>
    <table>
        <thead><tr><th>SKU</th><th>Nama Produk</th><th>Brand</th><th>Kategori</th><th>Stok</th><th>Harga Jual</th></tr></thead>
        <tbody>
            @foreach($products as $p)
                <tr>
                    <td>{{ $p->sku }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->brand }}</td>
                    <td>{{ $p->category->name }}</td>
                    <td>{{ $p->stock }}</td>
                    <td>Rp{{ number_format($p->sale_price,0,',','.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>