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
            padding: 5px;
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

        .checked {
            color: orange;
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Data Penumpang
                                </h3>
                            </div>
                            <div class="card-body">
                                <table style="width:100%">
                                    <tr>
                                        <th>Kode Pesanan</th>
                                        <td>{{ $data->kode_pesanan }}</td>
                                    </tr>
                                    {{-- jika jenis pesanan tour  --}}
                                    @if ($data->jadwal->jenis_pesanan == 'TOUR')
                                        <tr>
                                            <th>Brosur Tour</th>
                                            <td><img style="object-fit: cover" src="{{ $data->jadwal->getFotoBrosur() }}"
                                                    width="300px" height="300px"></td>
                                        </tr>
                                        <tr>
                                            <th>Deskripsi Tour</th>
                                            <td>{{ $data->jadwal->tour_deskripsi }}</td>
                                        </tr>
                                        {{-- <tr>
                                            <th>Harga DP </th>
                                            <td> @rupiah($data->jadwal->tour_dp)</td>
                                        </tr> --}}
                                    @endif
                                    {{-- jika jenis pesanan tour --}}

                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $data->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>User Foto</th>
                                        <td><img style="object-fit: cover" src="{{ $data->user->getFotoUrl() }}"
                                                width="80px" height="80px"></td>
                                    </tr>
                                    <tr>
                                        <th>Kontak</th>
                                        <td>{{ $data->kontak }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Kursi Dipesan</th>
                                        <td>{{ $data->getjumlahKursiPesanan() }} Kursi (
                                            {{ $kursi_pesanan->implode(', ', ', ') }} )</td>
                                    </tr>
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
                                        <td>{{ $kursi_mobil->supir->nama }} ( {{ $kursi_mobil->supir->kontak }})</td>
                                    </tr>
                                    {{-- jika jenis pesanan tour  --}}
                                    @if ($data->jadwal->jenis_pesanan == 'TRAVEL')
                                        <tr>
                                            <th>Rute</th>
                                            <td>{{ $data->jadwal->lokasi_keberangkatan_r->nama }} -
                                                {{ $data->jadwal->lokasi_tujuan_r->nama }}</td>
                                        </tr>
                                    @endif
                                    {{-- jika jenis pesanan tour --}}


                                    <tr>
                                        <th>Tanggal Pesan</th>
                                        <td>@tanggal($data->tgl_pesan)</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Keberangkatan</th>
                                        <td>@tanggal($data->tgl_keberangkatan) </td>
                                    </tr>
                                    <tr>
                                        <th>Status Pesanan</th>
                                        <td>
                                            @if ($data->status_pesanan == 'PROSES')
                                                <span class="badge badge-secondary">Proses</span>
                                            @elseif ($data->status_pesanan == 'SELESAI')
                                                <span class="badge badge-success">Selesai</span>
                                            @elseif ($data->status_pesanan == 'DIBATALKAN')
                                                <span class="badge badge-danger">Dibatalkan oleh pengguna</span>
                                            @elseif ($data->status_pesanan == 'DITOLAK')
                                                <span class="badge badge-danger">Ditolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status Pembayaran</th>
                                        <td>
                                            @if ($data->status_pembayaran == 'BELUM')
                                                <span class="badge badge-secondary">Belum Verifikasi</span>
                                            @elseif($data->status_pembayaran == 'LUNAS')
                                                <span class="badge badge-success">Dibayar</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Bukti Pembayaran</th>
                                        <td>
                                            @if (!empty($data->bukti_pembayaran))
                                                <a target="_blank" href="{{ $data->getBuktiPembayaranUrl() }}"
                                                    class=""><i class="far fa-eye"></i> Lihat</a>
                                            @else
                                                <span style="color:#80808075">Belum ada</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Biaya Perjalanan</th>
                                        <td>@rupiah($data->jadwal->harga)</td>
                                    </tr>
                                    <tr>
                                        <th>Total Biaya </th>
                                        <td>{{ $data->getjumlahKursiPesanan() }} x @rupiah($data->jadwal->harga) = @rupiah($data->getjumlahKursiPesanan() * $data->jadwal->harga)
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer">


                                @if ($data->status_pesanan != 'DIBATALKAN')
                                    @if ($data->status_pembayaran == 'BELUM')
                                        <a data-tipe='verifikasi' data-pesanan='{{ $data->kode_pesanan }}' href="#"
                                            class="btn_verifikasi btn btn-sm btn-secondary" id="btn_tambah"><i
                                                class="fas fa-edit"></i> Verifikasi Pembayaran
                                            <form hidden id="form-verifikasi"
                                                action="{{ route('pesanan.pembayaran.verifikasi') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input hidden name="id" value="{{ $data->id }}">
                                            </form>
                                        </a>
                                    @else
                                        <a data-tipe='batal' data-pesanan='{{ $data->kode_pesanan }}' href="#"
                                            class="btn_verifikasi btn btn-sm btn-danger" id="btn_tambah"><i
                                                class="fas fa-edit"></i> Batalkan Verifikasi Pembayaran
                                            <form hidden id="form-verifikasi"
                                                action="{{ route('pesanan.pembayaran.verifikasi') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input hidden name="id" value="{{ $data->id }}">
                                            </form>
                                        </a>
                                    @endif
                                    <a data-id='{{ $data->id }}' data-status='{{ $data->status_pesanan }}'
                                        data-pesan_tolak='{{ $data->pesan_tolak }}'
                                        data-pesanan='{{ $data->kode_pesanan }}' href="#"
                                        class="btn btn_status_pesanan btn-sm btn-secondary" id="btn_tambah"><i
                                            class="fas fa-edit"></i> Ubah Status Pesanan</a>
                                @endif

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
                        @if ($data->rating_created_at)
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Review Pengguna
                                    </h3>
                                </div>
                                <div class="card-body">
                                    " {{ $data->rating_komen }} " <br><br>

                                    {!! $rating !!}
                                </div>
                            </div>
                        @endif

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


            //trigger only select dropdown
            $('#status_pesanan').change(function(e) {
                let val = $(this).val();
                if (val == "DITOLAK") {
                    $('.layout_pesan_tolak').css('display', 'block');
                } else {
                    $('.layout_pesan_tolak').css('display', 'none');
                }
            });

            $('.select2bs4').select2({
                theme: 'bootstrap4',
            })
            let kolom = '';
            for (let i = 1; i <= @json($kursi_mobil->kolom_kursi); i++) {
                kolom += ' auto';
            }
            let kursi_pesanan_array = @json($data->kursi_pesanan->pluck('kursi_mobil_id'));
            $('.grid-container').css('grid-template-columns', kolom)
            let url = '{{ route('kursi_mobil.index', ':id') }}';
            url = url.replace(':id', @json($data->jadwal->mobil_id));
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
            $('.btn_verifikasi').click(function(e) {
                e.preventDefault();
                clearInput()
                let pesan, button;
                let data = $(this).attr('data-pesanan');
                let tipe = $(this).attr('data-tipe');
                if (tipe == 'verifikasi') {
                    pesan = 'Apakah anda yakin ingin Verifikasi Pembayaran ?'
                    button = 'Ya, Verifikasi'
                } else if (tipe == 'batal') {
                    pesan = 'Apakah anda yakin ingin Membatalkan Verifikasi Pembayaran ?'
                    button = 'Ya, Batalkan'
                }
                Swal.fire({
                    title: pesan,
                    text: 'Kode Pesanan : ' + data,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: button,
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).find('#form-verifikasi').submit();
                    }
                })
            });
            $('.btn_status_pesanan').click(function(e) {
                e.preventDefault();
                clearInput()
                $('#modal_status_pesanan').modal('show')
                $('#pesanan_id').val($(this).attr('data-id'))
                $('#pesan_tolak').val($(this).attr('data-pesan_tolak'))
                $('#status_pesanan').val($(this).attr('data-status')).trigger('change')
                $('.modal-title').text('Ubah Status Pesanan (' + $(this).attr('data-pesanan') + ' )')
            });
        });
    </script>
@endpush
