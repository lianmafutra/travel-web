@extends('admin.layouts.master-custom')
@push('css')
@endpush
@section('content')
    <style>
      
    </style>
    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="grid-container grid_kursi">
                                 <table style="width:100%">
                                    <tr>
                                      <th>Nama : </th>
                                      <td>Bill Gates</td>
                                    </tr>
                                    <tr>
                                      <th>kontak : </th>
                                      <td>555 77 854</td>
                                    </tr>
                                    <tr>
                                      <th>Tgl Keberangkatan : </th>
                                      <td>555 77 855</td>
                                    </tr>
                                    <tr>
                                       <th>Lokasi Keberangkatan : </th>
                                       <td>555 77 855</td>
                                     </tr>
                                  </table>
                                </div>
                            </div>
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
       
    </script>
@endpush
