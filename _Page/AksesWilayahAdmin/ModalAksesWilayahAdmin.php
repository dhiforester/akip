<div class="modal fade" id="ModalDownloadTemplateKecamatan" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><i class="bi bi-cloud-arrow-down"></i> Download Template Kecamatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12 text-center text-dark">
                        <code class="text-dark">
                            Sistem akan melakukan generate pada beberapa parameter untuk mempermudah anda membuat akun wilayah kecamatan.
                        </code>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12 text-center text-danger">
                        Apakah anda yakin ingin Download data template kecamatan?
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="_Page/AksesWilayahAdmin/ProsesDownloadTemplateKecamatan.php" class="btn btn-primary btn-rounded">
                    <i class="bi bi-cloud-arrow-down"></i> Ya, Download Sekarang
                </a>
                <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalDownloadTemplateDesa" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="_Page/AksesWilayahAdmin/ProsesDownloadTemplateDesa.php" method="POST" target="_blank">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-cloud-arrow-down"></i> Download Template Akses Desa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12" id="FormDownloadTemplateDesa">
                            <!-- Form Download Template Desa -->
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 text-center text-dark">
                            <code class="text-dark">
                                Sistem akan melakukan generate pada beberapa parameter untuk mempermudah anda membuat akun untuk Desa.
                            </code>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 text-center text-danger">
                            Apakah anda yakin ingin Download data template kecamatan?
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded">
                        <i class="bi bi-cloud-arrow-down"></i> Ya, Download Sekarang
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalImportAksesKecamatan" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesImportAksesKecamatan">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-upload"></i> Import Akses Kecamatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            Keterangan Import Data Akses Kecamatan
                            <ul>
                                <li>
                                    Download template data akses kecamatan dengan format excel yang tersedia.
                                </li>
                                <li>
                                    ID Wilayah diisi dengan kode wilayah kecamatan.
                                </li>
                                <li>Kolom kecamatan diisi dengan nama kecamatan </li>
                                <li>Kolom nama diisi dengan nama user yang akan memperoleh akses </li>
                                <li>Kolom email diisi dengan email user yang akan memperoleh akses untuk melakukan login</li>
                                <li>Kolom kontak diisi dengan nomor kontak user pemilik akun tersebut</li>
                                <li>Kolom password diisi dengan password real yang akan digunakan untuk melakukan login</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="file_akses_kecamatan">File Excel Akses Kecamatan</label>
                            <input type="file" name="file_akses_kecamatan" id="file_akses_kecamatan" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 text-left" id="NotifikasiImportAksesKecamatan">
                            <code class="text-primary">Pastikan File Yang Anda Import Sudah Sesuai</code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded">
                        <i class="bi bi-upload"></i> Import
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalImportAksesDesa" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesImportAksesDesa">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-upload"></i> Import Akses Desa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            Keterangan Import Data Akses Desa
                            <ul>
                                <li>
                                    Download template data akses desa dengan format excel yang tersedia.
                                </li>
                                <li>
                                    ID Wilayah diisi dengan kode wilayah desa (sesuai template).
                                </li>
                                <li>Kolom desa diisi dengan nama desa </li>
                                <li>Kolom nama diisi dengan nama user yang akan memperoleh akses </li>
                                <li>Kolom email diisi dengan email user yang akan memperoleh akses untuk melakukan login</li>
                                <li>Kolom kontak diisi dengan nomor kontak user pemilik akun tersebut</li>
                                <li>Kolom password diisi dengan password real yang akan digunakan untuk melakukan login</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="file_akses_desa">File Excel Akses Desa</label>
                            <input type="file" name="file_akses_desa" id="file_akses_desa" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 text-left" id="NotifikasiImportAksesDesa">
                            <code class="text-primary">Pastikan File Yang Anda Import Sudah Sesuai</code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded">
                        <i class="bi bi-upload"></i> Import
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalListDesa" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><i class="bi bi-list-columns"></i> List Desa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="table table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <td align="center"><b>No</b></td>
                                        <td align="left"><b>ID</b></td>
                                        <td align="left"><b>Desa</b></td>
                                        <td align="left"><b>Akun Desa</b></td>
                                    </tr>
                                </thead>
                                <tbody id="ListDesa">
                                    <!-- List Desa Akan Ditampilkan Disini -->
                                </tbody>
                            </table>
                        </div>
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
<div class="modal fade" id="ModalListAkun" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><i class="bi bi-list-columns"></i> List Akun Kecamatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="table table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <td align="center"><b>No</b></td>
                                        <td align="left"><b>Nama</b></td>
                                        <td align="left"><b>Kontak</b></td>
                                        <td align="left"><b>Email</b></td>
                                    </tr>
                                </thead>
                                <tbody id="ListAkunKecamatan">
                                    <!-- List Desa Akan Ditampilkan Disini -->
                                </tbody>
                            </table>
                        </div>
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
<div class="modal fade" id="ModalAksesDesa" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><i class="bi bi-list-columns"></i> List Akun Desa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="table table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <td align="center"><b>No</b></td>
                                        <td align="left"><b>Nama</b></td>
                                        <td align="left"><b>Kontak</b></td>
                                        <td align="left"><b>Email</b></td>
                                    </tr>
                                </thead>
                                <tbody id="ListAkunDesa">
                                    <!-- List Desa Akan Ditampilkan Disini -->
                                </tbody>
                            </table>
                        </div>
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
<div class="modal fade" id="ModalTambahAksesKecamatan" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahAksesKecamatan">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-person-plus"></i> Tambah Akses Kecamatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="FormTambahAksesKecamatan">
                        <!-- Form Tambah Akses Kecamatan Disini -->
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="NotifikasiTambahAksesKecamatan">
                            <code class="text-primary">Pastkan data yang anda input sudah benar</code>
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
<div class="modal fade" id="ModalTambahAksesDesa" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahAksesDesa">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-person-plus"></i> Tambah Akses Desa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="FormTambahAksesDesa">
                        <!-- Form Tambah Akses Desa Disini -->
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="NotifikasiTambahAksesDesa">
                            <code class="text-primary">Pastkan data yang anda input sudah benar</code>
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
<div class="modal fade" id="ModalDetailAkses" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><i class="bi bi-info-circle"></i> Detail Akses</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="FormDetailAkses">
                <!-- Menampilkan Form Detail Akses -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalEditAkses" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditAkses">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-person-check"></i> Edit Info Akses</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12" id="FormEditAkses"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiEditAkses">
                            <code class="text-primary">Pastkan data yang anda input sudah benar</code>
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
<div class="modal fade" id="ModalUbahPassword" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesUbahPassword">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-light"><i class="bi bi-key"></i> Ubah Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="FormUbahPassword"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiUbahPassword">
                            <code class="primary">Pastikan Password Yang Anda Masukan Sudah Benar</code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-info">
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
<div class="modal fade" id="ModalUbahIjinAkses" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesUbahIjinAkses">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-key"></i> Ubah Ijin Akses</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="FormUbahIjinAkses">
                            <!-- Form Ubah Ijin Akses Disini -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiUbahIjinAkses">
                            <code class="primary">Pastikan Data Yang Anda Input Sudah Benar</code>
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
<div class="modal fade" id="ModalHapusAkses" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusAkses">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-trash"></i> Hapus Akses</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12 text-center" id="FormHapusAkses">
                            <!-- Form Hapus Akses Disini -->
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 text-center">
                            <code>Apakah Anda Yakin Akan Menghapus Data Akses Tersebut?</code>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center" id="NotifikasiHapusAkses">

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