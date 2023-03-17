<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body onload="window.print();">
    <div class="p-4">
        <h3 style="padding-bottom:20px; text-align: center;">Laporan Travel periode ({{ str_replace('-', '/', $tgl_awal) }} - {{ str_replace('-', '/', $tgl_akhir) }} )</h3>

        <table style="margin-top: 15px" class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Kebrangkatan</th>
                    <th>Tujuan</th>
                    <th>Harga</th>
                    <th>Jumlah Kursi</th>
                    <th>Tgl Keberangkatan</th>
                    <th>Tgl Pesan</th>
                    <th>Nama</th>
                    <th>Kontak</th>
                    <th>Total Biaya</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanan as $index => $item)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $item->kode_pesanan }}</td>
                        <td>{{ $item->jadwal->lokasi_keberangkatan_r->nama }}</td>
                        <td>{{ $item->jadwal->lokasi_tujuan_r->nama }}</td>
                        <td>@rupiah($item->jadwal->harga)</td>
                        <td style="text-align: center">{{ $item->jumlah_kursi }}</td>
                        <td style="text-align: center">@tanggal_only($item->tgl_keberangkatan)</td>
                        <td style="text-align: center">@tanggal_only($item->tgl_pesan)</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->kontak }}</td>
                        <td>@rupiah($item->total_biaya)</td>
                   
                      
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>

</html>
