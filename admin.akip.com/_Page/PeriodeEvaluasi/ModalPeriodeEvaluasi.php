<div class="modal fade" id="ModalTambahPeriode" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahPeriode">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-plus"></i> Tambah Periode
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="periode">Periode/Tahun</label>
                            <input type="text" name="periode" id="periode" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiTambahPeriode">
                            <!-- Notifikasi Tambah Periode -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonTambahPeriode">
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
<div class="modal fade" id="ModalEditPeriode" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditPeriode">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-pencil"></i> Edit Periode
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12" id="FormEditPeriode">
                            <!-- Form Edit Periode -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiEditPeriode">
                            <!-- Notifikasi Tambah Periode -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonEditPeriode">
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

<div class="modal fade" id="ModalHapusPeriode" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusPeriode">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-trash"></i> Hapus Periode
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12" id="FormHapusPeriode">
                            <!-- Form Hapus Periode -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiHapusPeriode">
                            <!-- Notifikasi Hapus Periode -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonHapusPeriode">
                        <i class="bi bi-check"></i> Ya, Hapus
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalTambahIndikator" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahIndikator">
                <input type="hidden" name="id_evaluasi_periode" id="put_id_evaluasi_periode_for_indikator">
                <input type="hidden" name="id_komponen" id="put_id_komponen_for_indikator">
                <input type="hidden" name="id_komponen_sub" id="put_id_komponen_sub_for_indikator">
                <input type="hidden" name="level" id="put_level">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="judul_form_tambah_indikator">
                        <i class="bi bi-plus"></i> Tambah Indikator
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="kode">Kode</label>
                            <input type="text" name="kode" id="kode" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="nama_indikator">Nama</label>
                            <input type="text" name="nama" id="nama_indikator" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiTambahIndikator">
                            <!-- Notifikasi Tambah Indikator -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonTambahIndikator">
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
<div class="modal fade" id="ModalEditIndikator" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditIndikator">
                <input type="hidden" name="id" id="put_id_indikator_edit">
                <input type="hidden" name="level" id="put_level_edit">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="judul_form_indikator_edit">
                        <i class="bi bi-pencil"></i> Edit Indikator
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="kode_edit">Kode</label>
                            <input type="text" name="kode" id="kode_edit" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="nama_indikator">Nama</label>
                            <input type="text" name="nama" id="nama_indikator_edit" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan_edit" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiEditIndikator">
                            <!-- Notifikasi Edit Indikator -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonEditIndikator">
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

<div class="modal fade" id="ModalHapusIndikator" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusIndikator">
                <input type="hidden" name="id" id="put_id_indikator_hapus">
                <input type="hidden" name="level" id="put_level_hapus">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="judul_form_indikator_hapus">
                        <i class="bi bi-trash"></i> Hapus Indikator
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-4"><small>Kode</small></div>
                        <div class="col-8"><small class="text text-grayish" id="put_kode_for_delete_indikator"></small></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4"><small>Nama</small></div>
                        <div class="col-8"><small class="text text-grayish" id="put_nama_for_delete_indikator"></small></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4"><small>Keterangan</small></div>
                        <div class="col-8"><small class="text text-grayish" id="put_keterangan_for_delete_indikator"></small></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiHapusIndikator">
                            <!-- Notifikasi Hapus Indikator -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonHapusIndikator">
                        <i class="bi bi-trash"></i> Ya, Hapus
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalTambahUraian" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahUraian">
                <input type="hidden" name="id_kriteria" id="put_id_kriteria_for_tambah_uraian">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-trash"></i> Tambah Uraian
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="kode_uraian">Kode Uraian</label>
                            <input type="text" name="kode" id="kode_uraian" class="form-control">
                            <small>
                                <code class="text text-grayish">Digunakan untuk mengatur urutan uraian ketika ditampilkan</code>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="nama_uraian">Uraian</label>
                            <input type="text" name="nama" id="nama_uraian" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <label for="tipe_uraian">Tipe Jawaban</label>
                            <select name="tipe" id="tipe_uraian" class="form-control">
                                <option value="">Pilih</option>
                                <option value="select_option">Select Option</option>
                                <option value="list_option">List Option</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3 border-1 border-top">
                        <div class="col-10 mb-3 mt-3">Alternatif Jawaban</div>
                        <div class="col-2 mb-3 mt-3 text-end">
                            <button type="button" class="btn btn-sm btn-floating btn-outline-secondary" id="TambahFormAlternatif">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 border-1 border-bottom" id="list_alternatif">
                            <!-- List Form Alternatif Akan Muncul Disini -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiTambahUraian">
                            <!-- Notifikasi Tambah Uraian -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonTambahUraian">
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
<div class="modal fade" id="ModalEditUraian" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditUraian">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-pencil"></i> Edit Uraian
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="FormEditUraian">
                            <!-- Form Edit Uraian -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiEditUraian">
                            <!-- Notifikasi Edit Uraian -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonEditUraian">
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
<div class="modal fade" id="ModalHapusUraian" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusUraian">
                <input type="hidden" name="id_uraian" id="put_id_uraian_for_hapus_uraian">
                <input type="hidden" name="id_kriteria" id="put_id_kriteria_for_hapus_uraian">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-trash"></i> Hapus Uraian
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-4"><small>Kode</small></div>
                        <div class="col-8"><small class="text text-grayish" id="put_kode_for_delete_uraian"></small></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4"><small>Uraian</small></div>
                        <div class="col-8"><small class="text text-grayish" id="put_name_for_delete_uraian"></small></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiHapusUraian">
                            <!-- Notifikasi Hapus Uraian -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonHapusUraian">
                        <i class="bi bi-trash"></i> Ya, Hapus
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalTambahLampiran" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahLampiran">
                <input type="hidden" name="id_uraian" id="put_id_uraian_untuk_lampiran">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-trash"></i> Tambah Lampiran
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="nama_lampiran">Nama Lampiran</label>
                            <input type="text" name="nama_lampiran" id="nama_lampiran" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="lampiran_uraian">Lampiran File</label>
                            <select name="lampiran_uraian" id="lampiran_uraian" class="form-control">
                                <option value="Tidak Wajib">Tidak Wajib</option>
                                <option value="Wajib">Wajib Diisi</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="tipe_file">Tipe File Lampiran</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tipe_file[]" id="tipe_file_1" value="aplication/pdf">
                                <label class="form-check-label" for="tipe_file_1">PDF</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tipe_file[]" id="tipe_file_2" value="image/jpg">
                                <label class="form-check-label" for="tipe_file_2">JPG</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tipe_file[]" id="tipe_file_3" value="image/jpeg">
                                <label class="form-check-label" for="tipe_file_3">JPEG</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tipe_file[]" id="tipe_file_4" value="image/png">
                                <label class="form-check-label" for="tipe_file_4">PNG</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tipe_file[]" id="tipe_file_5" value="image/gif">
                                <label class="form-check-label" for="tipe_file_5">GIF</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3" id="FormMaxFile">
                        <div class="col-md-12">
                            <label for="max_file">Ukuran Maksimal Lampiran (mb)</label>
                            <input type="number" class="form-control" name="max_file" id="max_file">
                            <small class="text text-grayish">Dalam Satuan Mb</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiTambahLampiran">
                            <!-- Notifikasi Tambah Lampiran -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonTambahLampiran">
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

<div class="modal fade" id="ModalHapusLampiran" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusLampiran">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-trash"></i> Hapus Lampiran
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="FormHapusLampiran">
                            <!-- Notifikasi Hapus Lampiran -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiHapusLampiran">
                            <!-- Notifikasi Hapus Lampiran -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonHapusLampiran">
                        <i class="bi bi-trash"></i> Ya, Hapus
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>