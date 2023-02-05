<style>
    .dropdown-menu>li>a:hover {
        background-color: rgba(127, 75, 223, 0.189);
    }
</style>
<div class="btn-group-vertical">
    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
        </button>
        <ul class="dropdown-menu">
         <li><a data-url='{{ route('pesanan.edit', $data->id) }}' href="#" class="btn_edit dropdown-item">Detail</a> </li>
    <div class="dropdown-divider"></div>
            <li><a data-url='{{ route('pesanan.edit', $data->id) }}' href="#" class="btn_edit dropdown-item">Ubah
                    Data</a> </li>
            <div class="dropdown-divider"></div>
            @if ($data->status_pembayaran == 'BELUM')
                <li><a data-tipe='verifikasi' data-pesanan='{{ $data->kode_pesanan }}' href="#"
                        class="btn_verifikasi dropdown-item">Verifikasi Pembayaran
                        <form hidden id="form-verifikasi" action="{{ route('pesanan.pembayaran.verifikasi') }}" method="POST">
                           @csrf
                           @method('PUT')
                           <input hidden name="id" value="{{ $data->id }}">
                       </form>
                     </a> </li>
                <div class="dropdown-divider"></div>
                @else
                <li><a data-tipe='batal' data-pesanan='{{ $data->kode_pesanan }}' href="#"
                  class="btn_verifikasi dropdown-item">Batalkan Verifikasi Pembayaran
                  <form hidden id="form-verifikasi" action="{{ route('pesanan.pembayaran.verifikasi') }}" method="POST">
                     @csrf
                     @method('PUT')
                     <input hidden name="id" value="{{ $data->id }}">
                 </form>
               </a> </li>
          <div class="dropdown-divider"></div>
            @endif
                    <li><a data-id='{{ $data->id }}'  data-status='{{ $data->status_pesanan }}' data-pesanan='{{ $data->kode_pesanan }}'  href="#"
                      class="btn_status_pesanan dropdown-item">Ubah Status Pesanan
                   </a> </li>
        </ul>
    </div>
</div>
</td>
</tr>
