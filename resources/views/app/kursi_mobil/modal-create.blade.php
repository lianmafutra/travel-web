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
                <h6 class="modal-title"></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_tambah">
                @csrf
                <div class="modal-body">
                    <input hidden  id="id" name="id" value="" />
                    <input hidden id="mobil_id" name="mobil_id" />
                    <x-input id='nama' label='Nama Kursi'/>
                    <x-input id='posisi' label='Urutan/Posisi Kursi' required=true />
                    <x-select2 id="tipe" label="Tipe Kursi" required="true" placeholder="Pilih Tipe Kursi">
                        <option value="PENUMPANG">PENUMPANG</option>
                        <option value="KOSONG">KOSONG</option>
                        <option value="SUPIR">SUPIR</option>
                    </x-select2>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn_submit btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
