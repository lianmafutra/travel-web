@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('content')
    <style>
        table,
        th,
        td {
            border: 1px solid rgba(185, 185, 185, 0.477);
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        .grid-container {
            display: grid;
            /* grid-template-columns: auto auto auto; */
            background-color: #2195f365;
            padding: 10px;
        }

        .grid-item {
            background-color: rgba(255, 255, 255, 0.8);
            /* border: 1px solid rgba(0, 0, 0, 0.8); */
            border-radius: 10px;
            padding: 10px;
            margin: 5px;
            font-size: 20px;
            text-align: center;
        }

        .kosong {
            background-color: rgba(214, 214, 214, 0.8);
        }

        .supir {
            color: red;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Data Jadwal Travel
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <table style="width:100%">
                                            <tr>
                                                <th>Mobil</th>
                                                <td>{{ $kursi_mobil->nama }} ( {{ $kursi_mobil->plat }} )</td>
                                            </tr>
                                            <tr>
                                                <th>Foto Mobil</th>
                                                <td><img style="object-fit: cover" src="{{ $kursi_mobil->getFotoUrl() }}"
                                                        width="80px" height="80px"></td>
                                            </tr>
                                            <tr>
                                                <th>Supir</th>
                                                <td>{{ $kursi_mobil->supir->nama }} ( {{ $kursi_mobil->supir->kontak }})
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Biaya Perjalanan</th>
                                                <td>@rupiah($jadwal->harga)</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Keberangkatan</th>
                                                <td>@tanggal($jadwal->tgl_keberangkatan) </td>
                                            </tr>
                                            <tr>
                                                <th>Rute</th>
                                                <td>{{ $jadwal->lokasi_keberangkatan_r->nama }} -
                                                    {{ $jadwal->lokasi_tujuan_r->nama }}</td>
                                            </tr>
                                            <tr>
                                                <th>Kursi Tersedia</th>
                                                <td>{{ $kursi_pesanan->count() }} / {{ $total_kursi->count() }}</td>
                                            </tr>

                                            {{-- jika jenis pesanan tour  --}}
                                            @if ($jadwal->jenis_pesanan == 'TOUR')
                                                <tr>
                                                    <th>Brosur Tour</th>
                                                    <td><img style="object-fit: cover" src="{{ $jadwal->getFotoBrosur() }}"
                                                      width="300px" height="300px"></td>
                                                </tr>
                                                <tr>
                                                    <th>Deskripsi Tour</th>
                                                    <td>{{ $jadwal->tour_deskripsi }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jumlah Minimal Keberangkatan</th>
                                                    <td>{{ $jadwal->tour_min_orang }} Orang</td>
                                                </tr>
                                                <tr>
                                                    <th>Harga DP </th>
                                                    <td> @rupiah($jadwal->tour_dp)</td>
                                                </tr>
                                            @endif
                                           {{-- jika jenis pesanan tour --}}

                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>


                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Kursi Dipesan
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="grid-container grid_kursi">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Data Penumpang
                                </h3>
                            </div>
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>kode</th>


                                            <th>Jumlah Kursi</th>
                                            <th>Kursi Pesanan</th>
                                            <th>Status Pesanan</th>
                                            <th>Status Pembayaran</th>
                                            <th>Bukti Pembayaran</th>

                                            <th>Tgl Pesan</th>
                                            <th>Nama</th>
                                            <th>Kontak</th>

                                            <th>#Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('app.pesanan.modal-status-pesanan')
@endsection
@push('js')
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2-min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            })
            let kolom = '';
            for (let i = 1; i <= @json($kursi_mobil->kolom_kursi); i++) {
                kolom += ' auto';
            }
            let kursi_pesanan_array = @json($kursi_pesanan->pluck('id'));
            console.log(kursi_pesanan_array)
            $('.grid-container').css('grid-template-columns', kolom)
            let url = '{{ route('kursi_mobil.index', ':id') }}';
            url = url.replace(':id', @json($jadwal->mobil_id));
            $.get(url, function(response) {
                response.data.forEach(data => {
                    let color = '';
                    if (kursi_pesanan_array.includes(data.id)) {
                        color = '#4ac566';
                    }

                    if (data.tipe == 'KOSONG') {
                        $('.grid_kursi').append(
                            `<div class="grid-item kosong">${data.nama ? data.nama : "" }</div>`
                        );
                    } else if (data.tipe == 'SUPIR') {
                        $('.grid_kursi').append(
                            `<div class="grid-item supir"><i class="fas fa-wheelchair"></i><br>${data.nama}</div>`
                        );
                    } else {
                        $('.grid_kursi').append(
                            `<div style='background-color: ${color}' class="grid-item "><i class="fas fa-wheelchair"></i><br>${data.nama}</div>`
                        );
                    }
                });
            })

            let datatable = $("#datatable").DataTable({
                serverSide: true,
                processing: true,
                searching: true,
                lengthChange: false,
                paging: false,
                info: false,
                ordering: true,
                //  order: [
                //      [5, 'desc']
                //  ],
                ajax: @json(route('jadwal.show', $jadwal->id)),

                columns: [{
                        data: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
                    {
                        data: 'kode_pesanan',
                        orderable: false,
                    },

                    {

                        data: 'jumlah_kursi',
                        orderable: false,
                        className: 'dt-center',
                    },
                    {
                        data: 'kursi_pesanan',
                        orderable: false,
                        className: 'dt-center',

                    },
                    {
                        data: 'status_pesanan',
                        orderable: false,
                    },
                    {
                        data: 'status_pembayaran',
                        orderable: false,
                        className: 'dt-center',
                    },
                    {
                        data: 'bukti_pembayaran',
                        orderable: false,
                        className: 'dt-center',
                        defaultContent: '<span style="color:#80808075">Belum ada</span>'
                    },

                    {
                        data: 'tgl_pesan',
                        orderable: false,
                    },
                    {
                        data: 'nama',
                        orderable: false,
                    },
                    {
                        data: 'kontak',
                        orderable: false,
                    },


                    {
                        data: "action",
                        orderable: false,
                        searchable: false,
                    },
                ]
            });

        });
    </script>
@endpush
