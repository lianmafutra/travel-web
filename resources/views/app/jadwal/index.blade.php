@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/flatpicker/flatpickr.min.css') }}">
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
                        <h1 class="m-0">Data Jadwal Travel</h1>
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
                                    <a href="#" class="btn btn-sm btn-secondary" id="btn_tambah"><i
                                            class="fas fa-plus"></i> Tambah Jadwal</a>
                                            <a href="{{ route('create.tour') }}" class="btn btn-sm btn-secondary" id="btn_tambah_tour"><i
                                             class="fas fa-plus"></i> Tambah Jadwal Tour</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="card-body table-responsive">
                                        <table id="datatable" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Jenis</th>
                                                    <th>Brosur</th>
                                                    <th>Minimal Keberangkatan</th>
                                                    <th>Tour DP</th>
                                                    <th>Keberangkatan</th>
                                                    <th>Tujuan</th>
                                                    <th>Kursi Tersedia</th>
                                                    <th>Mobil</th>
                                                    <th>Supir</th>
                                                    <th>Harga</th>
                                                    <th>Jam</th>
                                                    <th>Tanggal</th>
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
    @include('app.jadwal.modal-create')

    @endsection
{{-- @include('app.jadwal.modal-create-tour') --}}
@push('js')
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2-min.js') }}"></script>
    <script src="{{ asset('plugins/autoNumeric.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('plugins/flatpicker/flatpickr.min.js') }}"></script>
    <script src="{{ asset('plugins/flatpicker/id.min.js') }}"></script>
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

            const tanggal = flatpickr("#tanggal", {
                allowInput: true,
                dateFormat: "d-m-Y",
                locale: "id",
            });

            
            // Filepond
            FilePond.registerPlugin(
                FilePondPluginFileEncode,
                FilePondPluginImagePreview,
                FilePondPluginFileValidateType,
                FilePondPluginFileValidateSize);
            let tour_brosur = FilePond.create(document.querySelector('#tour_brosur'));
            tour_brosur.setOptions({
                storeAsFile: true,
            });


            const jam = flatpickr("#jam", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });

            $('.tanggal').mask('00-00-0000');
            AutoNumeric.multiple('.rupiah', {
                //  currencySymbol: 'Rp ',
                digitGroupSeparator: '.',
                decimalPlaces: 0,
                minimumValue: 0,
                decimalCharacter: ',',
                formatOnPageLoad: true,
                allowDecimalPadding: false,
                alwaysAllowDecimalCharacter: false
            });

            let datatable = $("#datatable").DataTable({
                serverSide: true,
                processing: true,
                searching: true,
                lengthChange: true,
                paging: true,
                info: true,
                "deferRender": true,
                ordering: true,
               //  order: [
               //      [2, 'desc']
               //  ],
                ajax: @json(route('jadwal.index')),

                columns: [{
                        data: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
                    {
                        data: 'jenis_pesanan',
                    },
                    {
                        data: 'tour_brosur',
                    },
                    {
                        data: 'tour_min_orang',
                    },
                    {
                        data: 'tour_dp',
                        render: function(data, type, row, meta) {
                           if(row.jenis_pesanan == "TOUR"){
                              return rupiah(data)
                           }else{
                              return "-"
                           }
                           
                        }
                    },
                    {
                        data: 'lokasi_keberangkatan_r.nama',
                        defaultContent : '-'
                    },

                    {
                        data: 'lokasi_tujuan_r.nama',
                        defaultContent : '-'
                    },
                    {
                        data: 'kursi_tersedia',
                        className: 'dt-center',
                    },
                    {
                        data: 'mobil.nama',
                    }, {
                        data: 'supir.nama',
                    }, {
                        data: 'harga',
                        render: function(data, type, row, meta) {
                            return rupiah(data)
                        }
                    }, {
                        data: 'jam',
                    },
                    {
                        data: 'tanggal',
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
            })

            $("#btn_tambah_tour").click(function() {
                clearInput()
                $('#modal_create_tour').modal('show')
                $('.modal-title').text('Tambah Data Tour')
            })
            
            $("#form_tambah").submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
             
                $.ajax({
                    type: 'POST',
                    url: @json(route('jadwal.store')),
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
                    $('#lokasi_tujuan').val(response.data.lokasi_tujuan).trigger('change');
                    $('#lokasi_keberangkatan').val(response.data.lokasi_keberangkatan).trigger('change');
                    $('#mobil_id').val(response.data.mobil_id).trigger('change');
                    AutoNumeric.getAutoNumericElement('#harga').set(response.data.harga)
                    tanggal.setDate(response.data.tanggal)
                    jam.setDate(response.data.jam)
                })
            });

            $('#datatable').on('click', '.btn_hapus', function(e) {
                let data = $(this).attr('data-hapus');
                Swal.fire({
                    title: 'Apakah anda yakin ingin menghapus data Lokasi?',
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
