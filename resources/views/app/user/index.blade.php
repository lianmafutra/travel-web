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
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data User</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                           <div class="card-header">
                              <h3 class="card-title">
                                  <a href="#" class="btn btn-sm btn-primary" id="btn_tambah"><i
                                          class="fas fa-plus"></i> Tambah Data User</a>
                              </h3>
                          </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="card-body table-responsive">
                                        <table id="datatable" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Username</th>
                                                    <th>Hak Akses</th>
                                                    <th>Kontak</th>
                                                    <th>Foto</th>
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
    @include('app.user.modal-create')
@endsection
@push('js')
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2-min.js') }}"></script>
    <script src="{{ asset('plugins/filepond/filepond.js') }}"></script>
    <script src="{{ asset('plugins/filepond/filepond-plugin-file-metadata.js') }}"></script>
    <script src="{{ asset('plugins/filepond/filepond-plugin-file-encode.js') }}"></script>
    <script src="{{ asset('plugins/filepond/filepond-plugin-file-validate-type.js') }}"></script>
    <script src="{{ asset('plugins/filepond/filepond-plugin-file-validate-size.js') }} "></script>
    <script src="{{ asset('plugins/filepond/filepond-plugin-image-preview.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            })
            // Filepond
            FilePond.registerPlugin(
                FilePondPluginFileEncode,
                FilePondPluginImagePreview,
                FilePondPluginFileValidateType,
                FilePondPluginFileValidateSize);
            let foto_user = FilePond.create(document.querySelector('#foto'));
            foto_user.setOptions({
                storeAsFile: true,
            });
            let datatable = $("#datatable").DataTable({
                serverSide: true,
                processing: true,
                searching: true,
                lengthChange: true,
                paging: true,
                info: true,
                ordering: true,
                order: [
                    [4, 'desc']
                ],
                ajax: @json(route('user.index')),
                columns: [{
                        data: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
                    {
                        data: 'nama_lengkap',
                        orderable: false,
                    },
                    {
                        data: 'username',
                        orderable: false,
                    },
                    {
                        data: 'hak_akses',
                        orderable: false,
                    },
                    {
                        data: 'kontak',
                        orderable: false,
                    },
                    {
                        data: 'foto',
                        orderable: false,
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
                $('.password').show()
                $('#modal_create').modal('show')
                $('.modal-title').text('Tambah Data')
                if (foto_user.getFiles().length != 0) {
                    for (var i = 0; i <= foto_user.getFiles().length - 1; i++) {
                     foto_user.removeFile(foto_user.getFiles()[0].id)
                    }
                }
            });
            $("#form_tambah").submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: @json(route('user.store')),
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
                          
                        }
                    },
                    error: function(response) {
                        showError(response)
                    }
                });
            });
            $('#datatable').on('click', '.btn_edit', function(e) {
               $('.password').hide()
               $('#password').val("123")
                $('#modal_create').modal('show')
                $('.modal-title').text('Ubah Data')
                $('.error').hide();
                let url = $(this).attr('data-url');
                if (foto_user.getFiles().length != 0) {
                    for (var i = 0; i <= foto_user.getFiles().length - 1; i++) {
                     foto_user.removeFile(foto_user.getFiles()[0].id)
                    }
                }
                $.get(url, function(response) {
                    $('#id').val(response.data.id)
                    $('#nama_lengkap').val(response.data.nama_lengkap)
                    $('#username').val(response.data.username)
                    $('#kontak').val(response.data.kontak)
                    $('#hak_akses').val(response.data.hak_akses).trigger('change')
                    foto_user.setOptions({
                        storeAsFile: true,
                        files: [{
                            source: '/storage/' + response.data.foto
                        }]
                    });
                })
            });
            $('#datatable').on('click', '.btn_hapus', function(e) {
                let data = $(this).attr('data-hapus');
                Swal.fire({
                    title: 'Apakah anda yakin ingin menghapus data User?',
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


            $('#datatable').on('click', '.btn_reset_password', function(e) {
                let data = $(this).attr('data-username');
                Swal.fire({
                    title: 'Apakah anda yakin ingin Mereset Password User (password default : travel123)?',
                    text: data,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Reset',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).find('#form-reset-password').submit();
                    }
                })
            });
        })
    </script>
@endpush
