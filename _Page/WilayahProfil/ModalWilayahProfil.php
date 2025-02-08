<div class="modal fade" id="ModalUpdateIdentitasWilayah" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesUpdateIdentitasWilayah">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-pencil"></i> Update Identitas Wilayah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12" id="FormUpdateIdentitasWilayah">
                            
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="NotifikasiUpdateIdentitasWilayah">
                            <code class="text-primary">Pastkan data yang anda input sudah benar.</code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
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
<div class="modal fade" id="ModalTambahStrukturOrganisasi" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahStrukturOrganisasi">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-plus"></i> Tambah Struktur Organisasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12" id="FormTambahStrukturOrganisasi">
                            
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="NotifikasiTambahStrukturOrganisasi">
                            <code class="text-primary">Pastkan data yang anda input sudah benar.</code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
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
<div class="modal fade" id="ModalEditStrukturOrganisasi" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditStrukturOrganisasi">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-pencil"></i> Edit Struktur Organisasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12" id="FormEditStrukturOrganisasi">
                            
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="NotifikasiEditStrukturOrganisasi">
                            <code class="text-primary">Pastkan data yang anda input sudah benar.</code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
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
<div class="modal fade" id="ModalHapusStrukturOrganisasi" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusStrukturOrganisasi">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-trash"></i> Hapus Struktur Organisasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12 text-center" id="FormHapusStrukturOrganisasi">
                            
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 text-center" id="NotifikasiHapusStrukturOrganisasi">
                            <code class="text-primary">Pastkan data yang anda input sudah benar.</code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
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
<div class="modal fade" id="ModalTambahDemografi" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahDemografi">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-plus"></i> Tambah Demografi Wilayah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="periode">Periode Data</label></div>
                        <div class="col-md-8">
                            <input type="number" min="<?php echo date('Y')-3; ?>" max="<?php echo date('Y'); ?>" name="periode" id="periode" class="form-control" value="<?php echo date('Y'); ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12"><b>A. Jumlah Penduduk</b></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="jumlah_penduduk">A.1 Total Penduduk</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="jumlah_penduduk" id="jumlah_penduduk" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="penduduk_laki_laki">A.2 Laki-Laki</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="penduduk_laki_laki" id="penduduk_laki_laki" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="penduduk_perempuan">A.3 Perempuan</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="penduduk_perempuan" id="penduduk_perempuan" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="usia_1">A.4 Usia 0-17</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="usia_1" id="usia_1" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="usia_2">A.4 Usia 18-56</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="usia_2" id="usia_2" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="usia_3">A.5 Usia >56</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="usia_3" id="usia_3" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12"><b>B. Pendidikan</b></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="tidak_sekolah">B.1 Tidak Sekolah</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="tidak_sekolah" id="tidak_sekolah" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="tidak_selesai">B.2 Tidak Selesai</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="tidak_selesai" id="tidak_selesai" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="tk">B.3 TK</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="tk" id="tk" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="sd">B.4 SD</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="sd" id="sd" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="smp">B.5 SMP</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="smp" id="smp" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="sma">B.6 SMA</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="sma" id="sma" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="d1">B.7 D1</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="d1" id="d1" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="d2">B.8 D2</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="d2" id="d2" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="d3">B.9 D3</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="d3" id="d3" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="s1">B.10 S1</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="s1" id="s1" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="s2">B.11 S2</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="s2" id="s2" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="s3">B.10 S3</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="s3" id="s3" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12"><b>C. Sarana Prasarana</b></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="FormContainer">
                            <div class="input-group mb-3">
                                <input type="text" name="nama_sarana[]" class="form-control" placeholder="Sarana">
                                <input type="text" name="unit_sarana[]" class="form-control" placeholder="Unit/Satuan">
                                <input type="number" min="0" name="jumlah_sarana[]" class="form-control" placeholder="Jumlah">
                                <button type="button" class="btn btn-sm btn-success" id="add_form_sarana"><i class="bi bi-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="NotifikasiTambahDemografi">
                            <code class="text-primary">Pastkan data yang anda input sudah benar.</code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
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
<div class="modal fade" id="ModalEditDemografi" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditDemografi">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-pencil"></i> Edit Demografi Wilayah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12" id="FormEditDemografi">

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="NotifikasiEditDemografi">
                            <code class="text-primary">Pastkan data yang anda input sudah benar.</code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
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
<div class="modal fade" id="ModalDetailDemografi" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><i class="bi bi-info-circle"></i> Detail Demografi Wilayah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12" id="FormDetailDemografi">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalHapusDemografi" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusDemografi">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-trash"></i> Hapus Demografi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12 text-center" id="FormHapusDemografi">
                            
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 text-center" id="NotifikasiHapusDemografi">
                            <code class="text-primary">Pastkan data yang anda input sudah benar.</code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
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
<div class="modal fade" id="ModalTambahCapaianTarget" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahCapaianTarget">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-plus"></i> Tambah Capaian Target Program</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="periode">Periode Data</label></div>
                        <div class="col-md-8">
                            <input type="number" min="<?php echo date('Y')-3; ?>" max="<?php echo date('Y'); ?>" name="periode" id="periode" class="form-control" value="<?php echo date('Y'); ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12"><b>A. Keluarga Miskin</b></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="target_miskin">1. Target</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="target_miskin" id="target_miskin" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="capaian_miskin">2. Capaian</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="capaian_miskin" id="capaian_miskin" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12"><b>B. Pencegahan Stunting</b></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="target_stunting">1. Target</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="target_stunting" id="target_stunting" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="capaian_stunting">2. Capaian</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="capaian_stunting" id="capaian_stunting" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12"><b>C. Indeks Kepuasan Masyarakat</b></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="target_ikm">1. Target</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="target_ikm" id="target_ikm" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="capaian_ikm">2. Capaian</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="capaian_ikm" id="capaian_ikm" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12"><b>D. Indeks Desa Membangun</b></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="target_idm">1. Target</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="target_idm" id="target_idm" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><label for="capaian_idm">2. Capaian</label></div>
                        <div class="col-md-8">
                            <input type="number" min="0" name="capaian_idm" id="capaian_idm" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="NotifikasiTambahCapaianTarget">
                            <code class="text-primary">Pastkan data yang anda input sudah benar.</code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
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
<div class="modal fade" id="ModalDetailCapaianTarget" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><i class="bi bi-info-circle"></i> Detail Capaian Target</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12" id="FormDetailCapaianTarget">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalEditCapaianTarget" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditCapaianTarget">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-pencil"></i> Edit Capaian Target</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12" id="FormEditCapaianTarget">

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="NotifikasiEditCapaianTarget">
                            <code class="text-primary">Pastkan data yang anda input sudah benar.</code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
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
<div class="modal fade" id="ModalHapusCapaianTarget" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusCapaianTarget">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-trash"></i> Hapus Capaian Target</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12 text-center" id="FormHapusCapaianTarget">
                            
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 text-center" id="NotifikasiHapusCapaianTarget">
                            <code class="text-primary">Pastkan data yang anda input sudah benar.</code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
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