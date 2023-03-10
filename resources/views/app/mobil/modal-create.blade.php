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
                <h6 class="modal-title">Tambah Mobil Baru</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_tambah">
                @csrf
                <div class="modal-body">
                    <input hidden id="id" name="id" value="" />
                    <x-input id='nama' label='Nama Mobil' required=true />
                    <x-input id='plat' label='Plat/Nopol Mobil' required=true />
                    <x-select2 id="mobil_jenis_id" label="Jenis Mobil" required="true" placeholder="Pilih Jenis Mobil">
                     @foreach ($mobil_jenis as $item)
                         <option value="{{ $item->id }}">{{ $item->nama }}</option>
                     @endforeach
                 </x-select2>
                    <x-select2 id="supir_id" label="Supir" required="true" placeholder="Pilih Supir">
                        @foreach ($supir as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </x-select2>

                    <x-filepond label='Foto Mobil' required='true' 
                        info='( Format File jpg/png , Maks 5 MB)'>
                        <input id="foto" type="file" data-max-file-size="5 MB" required
                            class="filepond" accept='image/*' name="foto">
                    </x-filepond>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn_submit btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
