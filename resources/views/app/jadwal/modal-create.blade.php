<style>
    .modal-dialog {
        min-height: calc(100vh - 60px);
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow: auto;
    }

    @media(max-width: 768px) {
        .modal-dialog {
            min-height: calc(100vh - 20px);
        }
    }
</style>
<div class="modal fade" id="modal_create">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Tambah tujuan Baru</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_tambah">
                @csrf
                <div class="modal-body">
                    <input hidden id="id" name="id" value="" />
                    <input hidden id="jenis_pesanan" name="jenis_pesanan" value="TRAVEL" />
                    <x-select2 id="lokasi_tujuan" label="Lokasi Tujuan" required="true"
                        placeholder="Pilih Lokasi Tujuan">
                        @foreach ($lokasi as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </x-select2>
                    <x-select2 id="lokasi_keberangkatan" label="Lokasi Keberangkatan" required="true"
                        placeholder="Pilih Lokasi Keberangkatan">
                        @foreach ($lokasi as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </x-select2>
                    <x-select2 id="mobil_id" label="Mobil" required="true" placeholder="Pilih Mobil">
                        @foreach ($mobil as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }} | {{ $item->plat }}</option>
                        @endforeach
                    </x-select2>
                    <x-input-rupiah id='harga' label='Harga' required=true />
                    <x-datepicker id='tanggal' label='Tanggal' required=true />
                    <x-timepicker id='jam' label='Jam Keberangkatan' required=true />
                  

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn_submit btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
