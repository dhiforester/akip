<div class="modal fade" id="ModalTambahLampiranBukti" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahLampiranBukti">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-plus"></i> Tambah Parameter Lampiran/Bukti</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="nama_bukti"><b>Nama Lampiran/Bukti</b></label>
                            <input type="text" name="nama_bukti" id="nama_bukti" class="form-control" placeholder="Dokumen RPJMDES Terbaru">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="single_multi"><b>Single/Multi Upload</b></label>
                            <select name="single_multi" id="single_multi" class="form-control">
                                <option value="">Pilih</option>
                                <option value="Single">Single</option>
                                <option value="Multi">Multi</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="type_bukti"><b>Type File (Document)</b></label>
                            <ul>
                                <li>
                                    <input type="checkbox" name="type_bukti[]" id="type_bukti1" value="application/pdf"> 
                                    <label for="type_bukti1">PDF</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="type_bukti[]" id="type_bukti2" value="application/vnd.ms-excel"> 
                                    <label for="type_bukti2">XLS</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="type_bukti[]" id="type_bukti3" value="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"> 
                                    <label for="type_bukti3">XLSX</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="type_bukti[]" id="type_bukti4" value="text/csv"> 
                                    <label for="type_bukti4">CSV-1</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="type_bukti[]" id="type_bukti5" value="application/csv"> 
                                    <label for="type_bukti5">CSV-2</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="type_bukti[]" id="type_bukti6" value="text/plain"> 
                                    <label for="type_bukti6">CSV-3</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="type_bukti[]" id="type_bukti7" value="application/msword"> 
                                    <label for="type_bukti7">DOC</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="type_bukti[]" id="type_bukti8" value="application/vnd.openxmlformats-officedocument.wordprocessingml.document"> 
                                    <label for="type_bukti8">DOCX</label>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <label for="type_bukti"><b>Type File (Image)</b></label>
                            <ul>
                                <li>
                                    <input type="checkbox" name="type_bukti[]" id="type_bukti9" value="image/jpeg"> 
                                    <label for="type_bukti9">JPEG</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="type_bukti[]" id="type_bukti10" value="image/png"> 
                                    <label for="type_bukti10">PNG</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="type_bukti[]" id="type_bukti11" value="image/gif"> 
                                    <label for="type_bukti11">GIF</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="max_file"><b>Ukuran Maksimal (MB)</b></label>
                            <input type="text" name="max_file" id="max_file" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="deskripsi"><b>Deskripsi/Petunjuk Upload</b></label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 text-center" id="NotifikasiTambahLampiranBukti">
                            <span class="text-primary">Pastikan Data Yang Anda Input Sudah Benar</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalHapusLampiranBukti" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusLampiranBukti">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-trash"></i> Hapus Parameter Lampiran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12 text-center" id="FormHapusLampiranBukti">
                            <!-- Form Hapus Disini -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center" id="NotifikasiHapusLampiranBukti">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="bi bi-check"></i> Ya, Hapus
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tidak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalEditLampiranBukti" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditLampiranBukti">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-pencil"></i> Edit Parameter Lampiran/Bukti</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="FormEditLampiranBukti"></div>
                    <div class="row mb-3">
                        <div class="col-md-12 text-center" id="NotifikasiEditLampiranBukti">
                            <span class="text-primary">Pastikan Data Yang Anda Input Sudah Benar</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>