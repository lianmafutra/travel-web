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
 .filepond--item {
        width: calc(32% - 0.5em);
    }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Jadwal Tour </h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">

                            <div class="card-body">
                                <form id="form_tambah">
                                    @csrf
                                    <div class="modal-body">
                                        <input hidden id="id" name="id" value="" />
                                        <input hidden id="jenis_pesanan" name="jenis_pesanan" value="TOUR" />

                                        <x-select2 id="mobil_id" label="Mobil" required="true" placeholder="Pilih Mobil">
                                            @foreach ($mobil as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }} |
                                                    {{ $item->plat }}</option>
                                            @endforeach
                                        </x-select2>
                                        {{-- <x-input-number required=true id="tour_min_orang"
                                            label="Jumlah Minimal Keberangkatan" name="tour_min_orang" value="" /> --}}
                                        {{-- <x-input-rupiah id='harga' label='Harga per 1 Orang' required=true /> --}}
                                        {{-- <x-input-rupiah id='tour_dp' label='Harga DP Awal' required=true /> --}}
                                        <x-datepicker id='tanggal' label='Tanggal Keberangkatan' required=true />
                                        <x-timepicker id='jam' label='Jam Keberangkatan' required=true />

                                        <x-textarea id="tour_deskripsi" required="true" label="Deskripsi Tour"
                                            hint=""></x-textarea>
                                        <x-filepond label='Brosur' required='true'
                                            info='( Format File jpg/png , Maks 5 MB)'>
                                            <input id="tour_brosur" type="file" data-max-file-size="5 MB" required
                                                class="filepond" accept='image/*' name="tour_brosur">
                                        </x-filepond>
                                        <x-filepond label='Tour Galeri' required='true'
                                            info='( Format File jpg/png , Maks 5 MB)'>
                                            <input multiple id="tour_galeri" type="file" data-max-file-size="5 MB" required
                                                class="filepond" accept='image/*' name="tour_galeri[]">
                                        </x-filepond>

                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('jadwal.index') }}" type="button"
                                            class="btn_submit btn btn-secondary">Kembali</a>
                                        <button type="submit" class="btn_submit btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

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
            FilePondPluginFileMetadata,
            FilePondPluginFileEncode,
            FilePondPluginImagePreview,
            FilePondPluginFileValidateType,
            FilePondPluginFileValidateSize);

            let tour_brosur = FilePond.create(document.querySelector('#tour_brosur'));
           
            
            tour_brosur.setOptions({
                storeAsFile: true,
            });
            
            const inputElements = document.querySelectorAll('#tour_galeri');
        Array.from(inputElements).forEach(inputElement => {
            FilePond.create(inputElement, {
                styleItemPanelAspectRatio: 1,
                imageCropAspectRatio: '1:1',
                allowImagePreview: true,
                allowMultiple: true,
                imagePreviewHeight: 300,
                imagePreviewWidth: 300,
                storeAsFile: true
            });
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


            $("#form_tambah").submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                var xhr = $.ajax({
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
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showCancelButton: true,
                                allowEscapeKey: false,
                                showCancelButton: false,
                                allowOutsideClick: false,
                            }).then((result) => {
                                swal.hideLoading()
                                window.location = @json(route('jadwal.index'));
                            })
                            swal.hideLoading()
                        }
                    },
                    error: function(response) {
                        showError(response)
                    }
                });

                //  xhr.abort()
            });


        })
    </script>
@endpush
