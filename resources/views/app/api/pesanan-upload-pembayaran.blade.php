@extends('admin.layouts.master-custom')
@push('css')
@endpush
@section('content')
    <style>
        body {
            padding: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }


        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }


        .card {
            margin-top: 5px;
            display: flex;
            align-items: center;
            padding: 5px;
            /* border: 1px solid #ccc; */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            border-radius: 5px;
        }

        .card img {
            height: 80px;
            width: auto;
            object-fit: contain;
            flex: 1;
            margin-right: 30px;
        }

        .card-content {
            flex: 2;
        }
    </style>
    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">

                        <h4 style="color:rgb(81, 81, 227)">#Data Pesanan</h4>
                        <div class="grid-container grid_kursi">
                            <table style="width:100%">
                              <tr>
                                 <th>Kode Pesanan : </th>
                                 <td>{{ $pesanan->first()->kode_pesanan }}</td>
                             </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $user->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <th>kontak </th>
                                    <td>{{ $user->kontak }}</td>
                                </tr>
                                <tr>
                                    <th>Tgl Keberangkatan</th>
                                    <td> @tanggal_only($jadwal->tanggal) @jam($jadwal->jam) </td>
                                </tr>

                                @if ($jadwal->jenis_pesanan == 'TRAVEL')
                                <tr>
                                 <th>Lokasi</th>
                                 <td>{{ $jadwal->lokasi_keberangkatan_r->nama }} -> {{ $jadwal->lokasi_tujuan_r->nama }}
                                 </td>
                             </tr>
                                @else
                                <tr>
                                 <th>Tour : </th>
                                 <td> {{ $jadwal->tour_judul }}</td>
                             </tr>
                                @endif
                               
                            </table>
                        </div>

                       

                        <div style="margin-top:20px" class="rincian_biaya">
                            <h4 style="color:rgb(81, 81, 227)">#Rincian Biaya</h4>
                            <table style="width:100%">
                                <tr>

                                    <td>Kursi : {{ $kursi }}</td>
                                </tr>
                                <tr>

                                    <td>Harga : @rupiah($jadwal->harga) x {{ $jumlah_kursi }}</td>
                                </tr>
                                <tr>

                                    <td>Total : @rupiah($jadwal->harga * $jumlah_kursi)</td>
                                </tr>
                            </table>

                        </div>


                        @if ($pesanan->first()->status_pembayaran != "LUNAS")
                           <div style="margin-top:20px" class="rekening">
                              <h4 style="color:rgb(81, 81, 227)">#Nomor Rekening</h4>
                              @foreach ($rekening as $item)
                                  {{-- <div style="margin-top: 10px; background-color:rgba(255, 228, 196, 0.486)" class="card">
                                      <img  style="float: left;"  src="{{ asset('img/avatar.png') }}" height="70px" width="70px">
                                      <div class="container">
                                          <b>{{ $item->nama_bank }} ( {{ $item->no_rek }} )</b> 
                                          <b>{{ $item->nama_bank }} ( {{ $item->no_rek }} )</b> 
                                        {{ $item->nama_pemilik }} , Kontak ({{ $item->kontak }} )
                                      </div>
                                  </div> --}}
                                  <div class="card">
                                      <img height="auto" width="30px" src="{{ asset('img/ic_bank.png') }}">
                                      <div class="card-content">
                                          <h4>{{ $item->nama_bank }} ( {{ $item->no_rek }} )</h4>
                                          <p> Atas Nama : {{ $item->nama_pemilik }} <br> Kontak : {{ $item->kontak }}</p>
                                      </div>
                                  </div>
                              @endforeach
                          </div>
                        
                            
                        @endif
                       

                    </div>



                </div>

            </div>
    </div>
    </section>
    </div>
@endsection
@push('js')
    <script src="{{ asset('plugins/sweetalert2/sweetalert2-min.js') }}"></script>
    <script>
        getData()

        function getData(val) {


        }
    </script>
@endpush
