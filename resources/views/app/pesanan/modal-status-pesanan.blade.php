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
<div class="modal fade" id="modal_status_pesanan">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_status_pesanan" method="POST" action="{{ route('pesanan.status') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input hidden id="pesanan_id" name="pesanan_id" value="" />
                    <x-select2 id="status_pesanan" label="Status Pesanan" required="true"
                        placeholder="Ubah Status Pesanan">
                        <option value="SELESAI">SELESAI</option>
                        <option value="DITOLAK">DITOLAK</option>
                        <option value="PROSES">PROSES</option>
                        
                    </x-select2>
                  
                    <div style="display: none" class="form-group layout_pesan_tolak">
                        <label>Informasi Penolakan</label>
                        <input id="pesan_tolak" type="text" class="form-control input"
                            name="pesan_tolak" placeholder="" value="">
                        <span class="text-danger error error-text pesan_tolak_err"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn_submit btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
