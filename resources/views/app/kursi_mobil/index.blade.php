@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link href="{{ asset('plugins/filepond/filepond.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/filepond/filepond-plugin-image-preview.css') }} " rel="stylesheet" />
@endpush
@section('content')
    <style>
        .grid-container {

            display: grid;
            /* grid-template-columns: auto auto auto; */
            background-color: #2195f365;
            padding: 10px;
        }

        .grid-item {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
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
                        <h1 class="m-0">Kelola Kursi Kendaraan</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            {{-- <div class="card-header">
                           
                        </div> --}}
                            <div class="card-body">
                                <div class="grid-container grid_kursi">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="#" class="btn btn-sm btn-primary" id="btn_tambah"><i
                                            class="fas fa-plus"></i> Tambah Kursi</a>
                                    <a href="#" class="btn btn-sm btn-secondary" id="btn_kolom"><i
                                            class="fas fa-edit"></i> Jumlah Kolom Kursi</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="card-body table-responsive">
                                        <table id="datatable" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>

                                                    <th>nama</th>
                                                    <th>Posisi</th>
                                                    <th>Tipe</th>
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
    @include('app.kursi_mobil.modal-create')
    @include('app.kursi_mobil.modal-edit-kolom')
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
            for (let i = 1; i <= @json($data->kolom_kursi); i++) {
                kolom += ' auto';
            }

            $('.grid-container').css('grid-template-columns', kolom)

            let url = '{{ route('kursi_mobil.index', ':id') }}';
            url = url.replace(':id', @json(last(request()->segments())));

            $.get(url, function(response) {

                response.data.forEach(data => {

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
                            `<div class="grid-item "><i class="fas fa-wheelchair"></i><br>${data.nama}</div>`
                        );
                    }
                });

            })


            //trigger only select dropdown
            $('#tipe').on('select2:select', function(e) {
               let val = $(this).val()
               if(val=="SUPIR"){
                  $('#nama').val('SUPIR');
               }else{
                  $('#nama').val('');
               }

               if(val=="KOSONG"){
                  $('#nama').val('');
                  $('#nama').prop('disabled', true);
               }else{
                  $('#nama').prop('disabled', false);
               }
            })



            let datatable = $("#datatable").DataTable({
                serverSide: true,
                processing: true,
                searching: false,
                lengthChange: false,
                paging: false,
                info: false,
                ordering: false,
                //  order: [
                //      [4, 'desc']
                //  ],
                ajax: url,

                columns: [{
                        data: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },

                    {
                        data: 'nama',
                        orderable: false,
                    },
                    {
                        data: 'posisi',
                        orderable: false,
                    },
                    {
                        data: 'tipe',
                        orderable: false,
                        width: '1%'
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
                $('#mobil_id').val(@json(last(request()->segments())))
                $('.modal-title').text('Tambah Data')
            });


            $("#btn_kolom").click(function() {
                clearInput()
                $('#modal_kolom').modal('show')
                $('.modal-title').text('Atur Jumlah Kolom Kursi')
            });


            $("#form_tambah").submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: @json(route('kursi_mobil.store')),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        showLoading()
                    },
                    success: (response) => {
                        $('.grid_kursi').empty();
                        $.get(url, function(response) {

                            response.data.forEach(data => {

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
                                        `<div class="grid-item "><i class="fas fa-wheelchair"></i><br>${data.nama}</div>`
                                    );
                                }
                            });

                        })
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

            $("#form_kolom").submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: @json(route('kursi_mobil.update.kolom')),
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
                            $('#modal_kolom').modal('hide')
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
                                location.reload();
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
                    console.log(response)
                    $('#id').val(response.data.id)
                    $('#nama').val(response.data.nama)
                    $('#posisi').val(response.data.posisi)
                    $('#tipe').val(response.data.tipe).trigger('change')
                })
            });

            $('#datatable').on('click', '.btn_hapus', function(e) {
                let data = $(this).attr('data-hapus');
                Swal.fire({
                    title: 'Apakah anda yakin ingin menghapus data Kursi?',
                    text: 'Nomor : ' + data,
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
