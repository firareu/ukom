<!DOCTYPE html>
<html>

<head>
    <title>Struk Belanja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>

<body>
    <h1>Struk Belanja</h1>
    <p>Tanggal: {{ $transaction->created_at->format('d/m/Y H:i') }}</p>
    <p>Nomor Transaksi: {{ $transaction->id }}</p>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->pivot->qty }}</td>
                <td>Rp {{ number_format($item->pivot->price, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->pivot->qty * $item->pivot->price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" align="right"><strong>Total:</strong></td>
                <td><strong>Rp {{ number_format($transaction->total, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <p>Terima kasih telah berbelanja di toko kami!</p>
</body>

</html>