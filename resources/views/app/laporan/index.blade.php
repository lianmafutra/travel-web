@extends('admin.layouts.master')
@push('css')
  
   
    <link rel="stylesheet" href="{{ asset('plugins/flatpicker/flatpickr.min.css') }}">

@endpush
@section('content')
    <style>
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Rekap Pembayaran Per periode</h1>
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
                              <div class="col-md-3">
                                 <x-datepicker id='tanggal_awal' label='Tanggal Awal' required=true />
                                 <x-datepicker id='tanggal_akhir' label='Tanggal Akhir' required=true />
                              </div>
                            </div>
                            <div class="card-footer">
                              <button type="submit" class="btn_submit btn btn-success"><i
                                 class="fas fa-print"></i> Cetak Laporan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
@push('js')

  
 
    <script src="{{ asset('plugins/flatpicker/flatpickr.min.js') }}"></script>
    <script src="{{ asset('plugins/flatpicker/id.min.js') }}"></script>
    <script>
            const tanggal_awal = flatpickr("#tanggal_awal", {
                allowInput: true,
                dateFormat: "d-m-Y",
                locale: "id",
            });
            const tanggal_akhir = flatpickr("#tanggal_akhir", {
                allowInput: true,
                dateFormat: "d-m-Y",
                locale: "id",
            });
          
    </script>
@endpush
