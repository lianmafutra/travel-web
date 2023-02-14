@extends('admin.layouts.master-custom')
@push('css')
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

        .clicked {
            background-color: yellow;
        }
    </style>
    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-4">
                        <div class="card">

                            <div class="card-body">
                                <div class="grid-container grid_kursi">
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
        $(document).ready(function() {

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
                    status = "tersedia"
                    if (kursi_pesanan_array.includes(data.id)) {
                        color = '#4ac566';
                        status = "terisi"
                    }

                    if (data.tipe == 'KOSONG') {
                        $('.grid_kursi').append(
                            `<div class="grid-item grid-item kosong">${data.nama ? data.nama : "" }</div>`
                        );
                    } else if (data.tipe == 'SUPIR') {
                        $('.grid_kursi').append(
                            `<div class="grid-item supir"><i class="fas fa-wheelchair"></i><br>${data.nama}</div>`
                        );
                    } else {
                        $('.grid_kursi').append(
                            `<a style="text-decoration:none" href="#" class="aa"><div  id="${data.id}" style='background-color: ${color}' class="grid-item grid-kursi ${status}"><i class="fas fa-wheelchair"></i><br>${data.nama}</div></a>`
                        );
                    }
                });
            })


            $('.grid_kursi').on('click', '.grid-kursi', function(e) {

                if ($(this).hasClass("terisi")) {
                    alert("Kursi Telah Terisi")
                } else {
                    $(this).toggleClass('clicked');
                }
                // alert(e.target.id)

                var cusid_ele = document.getElementsByClassName('clicked');
                let kursi_dipilih2 = [];
            
                for (var i = 0; i < cusid_ele.length; ++i) {
                    var item = cusid_ele[i];
                    kursi_dipilih2.push(item.id);
                    
                }
              
                Android.sendData(kursi_dipilih2.toString());

                  


            });


            // function init(val) {
            //     Android.sendData(val);
            // }







        });
    </script>
@endpush
