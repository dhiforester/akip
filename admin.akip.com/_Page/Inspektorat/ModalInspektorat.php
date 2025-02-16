<div class="modal fade" id="ModalFilterInspektorat" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="FilterInspektorat">
                <input type="hidden" name="page" id="page">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-funnel"></i> Filter Akses</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label for="batas">Data</label>
                            <select name="batas" id="batas" class="form-control">
                                <option value="5">5</option>
                                <option selected value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="250">250</option>
                                <option value="500">500</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="OrderBy">Mode Urutan</label>
                            <select name="OrderBy" id="OrderBy" class="form-control">
                                <option value="">Pilih</option>
                                <option value="nama">Nama</option>
                                <option value="kontak">Nomor Kontak</option>
                                <option value="email">Email</option>
                                <option value="akses">Akses</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label for="ShortBy">Tipe Urutan</label>
                            <select name="ShortBy" id="ShortBy" class="form-control">
                                <option value="ASC">A To Z</option>
                                <option selected value="DESC">Z To A</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="KeywordBy">Pencarian</label>
                            <select name="KeywordBy" id="KeywordBy" class="form-control">
                                <option value="">Pilih</option>
                                <option value="nama">Nama</option>
                                <option value="kontak">Nomor Kontak</option>
                                <option value="email">Email</option>
                                <option value="akses">Akses</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3" id="FormFilter">
                            <label for="keyword">Kata Kunci</label>
                            <input type="text" name="keyword" id="keyword" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="bi bi-check"></i> Tampilkan
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalTambahInspektorat" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahInspektorat">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-plus"></i> Tambah Inspektorat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="id_provinsi">Provinsi</label>
                        </div>
                        <div class="col-md-8">
                            <select name="id_provinsi" id="id_provinsi" class="form-control">
                                <option value="">Pilih</option>
                                <?php
                                    $query = mysqli_query($Conn, "SELECT * FROM wilayah_provinsi ORDER BY provinsi ASC");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $id_provinsi= $data['id_provinsi'];
                                        $provinsi= $data['provinsi'];
                                        echo '<option value="'.$id_provinsi.'">'.$provinsi.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="id_kabkot">Kabupaten/Kota</label>
                        </div>
                        <div class="col-md-8">
                            <select name="id_kabkot" id="id_kabkot" class="form-control">
                                <option value="">Pilih</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="nama">Nama Inspektorat</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="nama" id="nama" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="kontak">Kontak/HP</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="kontak" id="kontak" class="form-control" placeholder="+62">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="alamat">Alamat</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="alamat" id="alamat" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"></div>
                        <div class="col-md-8" id="NotifikasiTambahInspektorat">
                            <code class="text-primary">Pastkan data yang anda input sudah benar</code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded" id="ButtonTambahInspektorat">
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
<div class="modal fade" id="ModalEditInspektorat" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditInspektorat">
                <input type="hidden" name="id_inspektorat" id="put_id_inspektorat_for_edit">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-pencil"></i> Edit Inspektorat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="id_provinsi_edit">Provinsi</label>
                        </div>
                        <div class="col-md-8">
                            <select name="id_provinsi" id="id_provinsi_edit" class="form-control">
                                <option value="">Pilih</option>
                                <?php
                                    $query = mysqli_query($Conn, "SELECT * FROM wilayah_provinsi ORDER BY provinsi ASC");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $id_provinsi= $data['id_provinsi'];
                                        $provinsi= $data['provinsi'];
                                        echo '<option value="'.$id_provinsi.'">'.$provinsi.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="id_kabkot_edit">Kabupaten/Kota</label>
                        </div>
                        <div class="col-md-8">
                            <select name="id_kabkot" id="id_kabkot_edit" class="form-control">
                                <option value="">Pilih</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="nama_edit">Nama Inspektorat</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="nama" id="nama_edit" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="kontak_edit">Kontak/HP</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="kontak" id="kontak_edit" class="form-control" placeholder="+62">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="alamat_edit">Alamat</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="alamat" id="alamat_edit" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"></div>
                        <div class="col-md-8" id="NotifikasiEditInspektorat">
                            <code class="text-primary">Pastkan data yang anda input sudah benar</code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded" id="ButtonEditInspektorat">
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
<div class="modal fade" id="ModalHapusInspektorat" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusInspektorat">
                <input type="hidden" name="id_inspektorat" id="put_id_inspektorat_for_deleter">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-trash"></i> Hapus Inspektorat
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12" id="FormHapusInspektorat">

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="NotifikasiHapusInspektorat">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded" id="ButtonHapusInspektorat">
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
<div class="modal fade" id="ModalTambahAkses" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahAkses">
                <input type="hidden" name="id_inspektorat" id="put_id_inspektorat_to_tambah_akses">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-person-plus"></i> Tambah Akses
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="nama">Nama Pengguna</label>
                            <input type="text" name="nama" id="nama" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="email">Alamat Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="email@domain.com">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="kontak">Kontak</label>
                            <input type="text" name="kontak" id="kontak" class="form-control" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="62">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <span class="input-group-text" id="GeneratePassword" style="cursor: pointer;">
                                    <i class="bi bi-repeat"></i>
                                </span>
                                <input type="password" name="password" id="password" class="form-control" required>
                                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                    <i class="bi bi-eye" id="eyeIcon"></i>
                                </span>
                            </div>
                            <small>
                                <code class="text text-grayish">Maksimal 20 karakter yang terdiri dari huruf dan angka.</code>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="foto">Foto Profil</label>
                            <input type="file" name="foto" id="foto" class="form-control">
                            <small>
                                <code class="text text-grayish">Foro maksimal 2 mb (JPG, JPEG, GIF, PNG)</code>
                                <p id="NotifikasiValidasiFile"></p>
                            </small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiTambahAkses">
                            <!-- Notifikasi -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonTambahAkses">
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
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark">
                    <i class="bi bi-info-circle"></i> Detail Akses
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12" id="FormDetailAkses">

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
<div class="modal fade" id="ModalEditAkses" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditAkses">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-pencil"></i> Edit Akses
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="FormEditAkses">
                            <!-- Form Edit Akses Disini -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiEditAkses">
                            <!-- Notifikasi -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonEditAkses">
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
<div class="modal fade" id="ModalEditPassword" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditPassword">
                <input type="hidden" name="id_akses" id="put_id_akses_for_edit_password">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-pencil"></i> Edit Password
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="password_edit">Password Baru</label>
                            <input type="password" name="password" id="password_edit" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="Ulangi_password_edit">Ulangi Password</label>
                            <input type="password" name="ulangi_password" id="Ulangi_password_edit" class="form-control" required>
                            <small>
                                <code class="text text-grayish">Password terdiri dari 6 - 20 karakter huruf dan angka.</code>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tampilkan_password" id="tampilkan_password" value="Ya">
                                <label class="form-check-label" for="tampilkan_password">
                                    <small>Tampilkan Password</small>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiEditPassword">
                            <!-- Notifikasi -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonEditPassword">
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
<div class="modal fade" id="ModalEditFoto" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditFoto">
                <input type="hidden" name="id_akses" id="put_id_akses_for_edit_foto">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-image"></i> Edit Foto Profil
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="foto_edit">Upload Foto Baru</label>
                            <input type="file" name="foto" id="foto_edit" class="form-control">
                            <small>
                                <code class="text text-grayish">Foro maksimal 2 mb (JPG, JPEG, GIF, PNG)</code>
                                <p id="NotifikasiValidasiFileEdit"></p>
                            </small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiEditFoto">
                            <!-- Notifikasi -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonEditFoto">
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
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusAkses">
                <input type="hidden" name="id_akses" id="put_id_akses_for_hapus_akses">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-trash"></i> Hapus Akses
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="FormHapusAkses">
                            <!-- Form Hapus Akses -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiEditAkses">
                            <!-- Notifikasi -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonHapusAkses">
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

<div class="modal fade" id="ModalTambahOpd" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahOpd">
                <input type="hidden" name="id_inspektorat" id="put_id_inspektorat_for_tambah_opd">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-plus"></i> Tambah OPD
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="opd">Nama OPD</label>
                            <input type="text" name="opd" id="opd" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="telepon">Telepon</label>
                            <input type="text" name="telepon" id="telepon" class="form-control" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiTambahOpd">
                            <!-- Notifikasi -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonTambahOpd">
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
<div class="modal fade" id="ModalDetailOpd" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark">
                    <i class="bi bi-info-circle"></i> Detail OPD
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" id="FormDetailOpd">
                        <!-- Notifikasi -->
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
<div class="modal fade" id="ModalEditOpd" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditOpd">
                <input type="hidden" name="id_opd" id="put_id_opd">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-pencil"></i> Edit OPD
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12" id="FormEditOpd">
                            <!-- Form Edit OPD -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiEditOpd">
                            <!-- Notifikasi -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonEditOpd">
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

<div class="modal fade" id="ModalHapusOpd" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusOpd">
                <input type="hidden" name="id_opd" id="put_id_opd_hapus">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-trash"></i> Hapus OPD
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="FormHapusOpd">
                            <!-- Form Hapus OPD -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiHapusOpd">
                            <!-- Notifikasi -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded" id="ButtonHapusOpd">
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