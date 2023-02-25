@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('content')
    <style>

    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$title}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h3 class="card-title">
                                    <a href="#" class="btn btn-sm btn-primary" id="btn_tambah"><i
                                            class="fas fa-plus"></i> Tambah Rekening</a>
                                </h3>
                            </div> --}}
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="card-body table-responsive">
                                        <table id="datatable" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>kode</th>
                                                    <th>Keberangkatan</th>
                                                    <th>Tujuan</th>
                                                    <th>Jumlah Kursi</th>
                                                    <th>Status Pesanan</th>
                                                    <th>Status Pembayaran</th>
                                                    <th>Bukti Pembayaran</th>
                                                    <th>Tgl Keberangkatan</th>
                                                    <th>Tgl Pesan</th>
                                                    <th>Nama</th>
                                                    <th>Kontak</th>
                                                    <th>created_at</th>
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

            let datatable = $("#datatable").DataTable({
                serverSide: true,
                processing: true,
                searching: true,
                lengthChange: true,
                paging: true,
                info: true,
                ordering: true,
                 order: [
                     [12, 'desc']
                 ],
                ajax: @json(route('pesanan.index')),

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
                        data: 'jadwal.lokasi_keberangkatan_r.nama',
                        orderable: false,
                    },
                    {
                        data: 'jadwal.lokasi_tujuan_r.nama',
                        orderable: false,
                    },
                    {
                        data: 'jumlah_kursi',
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
                        data: 'tgl_keberangkatan',
                        orderable: false,
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
                        data: 'created_at',
                    },
                    {
                        data: "action",
                        orderable: false,
                        searchable: false,
                    },
                ]
            });

            $("#btn_tambah").click(function() {
                clearInput()
                $('#modal_create').modal('show')
                $('.modal-title').text('Tambah Data')
            });


            $('#datatable').on('click', '.btn_verifikasi', function(e) {
                clearInput()
                let data = $(this).attr('data-pesanan');
                let tipe = $(this).attr('data-tipe');
                if (tipe == 'verifikasi'){
                  pesan = 'Apakah anda yakin ingin Verifikasi Pembayaran ?'
                    button = 'Ya, Verifikasi'
                }
                   
                else if (tipe == 'batal') {
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

            $('#datatable').on('click', '.btn_status_pesanan', function(e) {
                clearInput()
            
                $('#modal_status_pesanan').modal('show')
                $('#pesanan_id').val($(this).attr('data-id'))
                $('#status_pesanan').val($(this).attr('data-status')).trigger('change')
                $('.modal-title').text('Ubah Status Pesanan ('+  $(this).attr('data-pesanan')+' )')
            });

            $("#form_tambah").submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: @json(route('pesanan.store')),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        showLoading()
                    },
                    success: (response) => {
                        if (response) {
                            this.reset()
                            $('#modal_create').modal('hide')
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showCancelButton: true,
                                allowEscapeKey: false,
                                showCancelButton: false,
                                allowOutsideClick: false,
                            }).then((result) => {
                                swal.hideLoading()
                                datatable.ajax.reload()
                            })
                            swal.hideLoading()
                        }
                    },
                    error: function(response) {
                        showError(response)
                    }
                });
            });

            $('#datatable').on('click', '.btn_edit', function(e) {
                $('#modal_create').modal('show')
                $('.modal-title').text('Ubah Data')
                $('.error').hide();
                let url = $(this).attr('data-url');

                $.get(url, function(response) {
                    $('#id').val(response.data.id)
                    $('#nama_bank').val(response.data.nama_bank)
                    $('#no_rek').val(response.data.no_rek)
                    $('#nama_pemilik').val(response.data.nama_pemilik)
                    $('#kontak').val(response.data.kontak)
                })
            });

            $('#datatable').on('click', '.btn_hapus', function(e) {
                let data = $(this).attr('data-hapus');
                Swal.fire({
                    title: 'Apakah anda yakin ingin menghapus data Pesanan ?',
                    text: data,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).find('#form-delete').submit();
                    }
                })
            });

        })
    </script>
@endpush
