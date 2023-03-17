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
                <h6 class="modal-title">Tambah User Baru</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_tambah">
                @csrf
                <div class="modal-body">
                    <input hidden id="id" name="id" value="" />
                    <x-input id='nama_lengkap' label='Nama Lengkap' required=true />
                    <x-input id='username' label='Username' required=true />
                    <x-input id='password' label='Password' required=true />
                    <x-input id='kontak' label='Kontak' required=false />
                    <x-select2 id="hak_akses" label="Hak Akses" required="true" placeholder="Pilih Hak Akses">
                         <option value="admin">admin</option>
                         <option value="owner">Owner</option>
                 </x-select2>
                    <x-filepond label='Foto Profil' required='true' 
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
