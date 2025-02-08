<div class="modal fade" id="ModalFilter" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesFilter">
                <input type="hidden" name="page" id="page">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-funnel"></i> Filter Penduduk</h5>
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
                                <option value="nik">NIK</option>
                                <option value="kk">KK</option>
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
                                <option value="nik">NIK</option>
                                <option value="kk">KK</option>
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
<div class="modal fade" id="ModalTambahPenduduk" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahPenduduk">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-person-plus"></i> Tambah Penduduk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <b>A. Identitas Penduduk</b>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="nik">Nomor KTP (NIK)</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="nik" id="nik" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="kk">Kartu Keluarga (KK)</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="kk" id="kk" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="nama">Nama Lengkap</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="nama" id="nama" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3 border-1 border-top">
                        <div class="col-md-12 mt-3">
                            <b>B. Kontak & Alamat</b>
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
                            <label for="alamat">Alamat Tinggal</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="alamat" id="alamat" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3 border-1 border-top">
                        <div class="col-md-12 mt-3">
                            <b>C. Tempat, Tanggal Lahir</b>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="tempat_lahir">Tempat Lahir</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                        </div>
                        <div class="col-md-8">
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3 border-1 border-top">
                        <div class="col-md-12 mt-3">
                            <b>D. Status  Pernikahan</b>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="gender">Gender</label>
                        </div>
                        <div class="col-md-8">
                            <select name="gender" id="gender" class="form-control">
                                <option value="">Pilih</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="pernikahan">Status Pernikahan</label>
                        </div>
                        <div class="col-md-8">
                            <select name="pernikahan" id="pernikahan" class="form-control">
                                <option value="">Pilih</option>
                                <option value="Lajang">Lajang</option>
                                <option value="Menikah">Menikah</option>
                                <option value="Janda">Janda</option>
                                <option value="Duda">Duda</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="pekerjaan">Pekerjaan</label>
                        </div>
                        <div class="col-md-8">
                            <select name="pekerjaan" id="pekerjaan" class="form-control">
                                <option value="">Pilih</option>
                                <option value="Tidak Bekerja">Tidak Bekerja</option>
                                <option value="Pelajar">Pelajar</option>
                                <option value="Wirausaha, Pedagang">Wirausaha, Pedagang</option>
                                <option value="Karyawan Swasta">Karyawan Swasta</option>
                                <option value="PNS, TNI POLRI">PNS, TNI POLRI</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3 border-1 border-top">
                        <div class="col-md-12 mt-3">
                            <b>E. Status Keberadaan</b>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="hidup">Hidup/Mati</label>
                        </div>
                        <div class="col-md-8">
                            <select name="hidup" id="hidup" class="form-control">
                                <option value="Hidup">Hidup</option>
                                <option value="Mati">Mati</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="keberadaan">Keberadaan</label>
                        </div>
                        <div class="col-md-8">
                            <select name="keberadaan" id="keberadaan" class="form-control">
                                <option value="Ada">Ada</option>
                                <option value="Pindah">Pindah</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="NotifikasiTambahPenduduk">
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
<div class="modal fade" id="ModalDetailPenduduk" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><i class="bi bi-info-circle"></i> Detail Penduduk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="FormDetailPenduduk">
                <!-- Menampilkan Form Detail Penduduk -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalEditPenduduk" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditPenduduk">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-person-check"></i> Edit Info Penduduk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12" id="FormEditPenduduk"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="NotifikasiEditPenduduk">
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
<div class="modal fade" id="ModalHapusPenduduk" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusPenduduk">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-trash"></i> Hapus Penduduk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12 text-center" id="FormHapusPenduduk">
                            <!-- Form Hapus Penduduk Disini -->
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 text-center">
                            <code>Apakah Anda Yakin Akan Menghapus Data Penduduk Tersebut?</code>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center" id="NotifikasiHapusPenduduk">

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
<div class="modal fade" id="ModalExport" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="_Page/Penduduk/ProsesExportPenduduk.php" method="POST" target="_blank">
                <input type="hidden" name="page" id="page">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-file-earmark-font"></i> Export
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-12 mt-3">
                            <label for="format">Export Format</label>
                            <select name="format" id="format" class="form-control">
                                <option value="html">HTML</option>
                                <option value="Excel">Excel</option>
                            </select>
                            <small class="credit">Silahkan Pilih Format Data Yang Anda Inginkan</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="bi bi-check"></i> Export
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalImport" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesImport">
                <input type="hidden" name="page" id="page">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-upload"></i> Import
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-12 mt-3">
                            <b>Langkah-Langkah Import Data Penduduk</b>
                            <small class="credit">
                                <ol>
                                    <li>
                                        Download template file yang akan di import pada tombol <a href="_Page/Penduduk/Template_Penduduk.xls">Berikut ini</a>
                                    </li>
                                    <li>
                                        Isi/masukan data yang akan di import pada kolom-kolom yang sudah disediakan.
                                        <ul>
                                            <li>Kontak, NIK dan KK di isi dengan format angka</li>
                                            <li>Gender diisi dengan Laki-laki atau Perempuan</li>
                                            <li>Pernikahan diisi dengan status pernikahan (Lajang, Menikah, Janda, Duda)</li>
                                            <li>Pekerjaan diisi dengan kategori pekerjaan (Tidak Bekerja, PNS TNI Polri, Wirausaha Pedagang, Karyawan Swasta, Pelajar)</li>
                                            <li>Tanggal lahir diisi dengan format Y-m-d</li>
                                            <li>Status Hidup Diisi dengan Hidup, Mati</li>
                                            <li>Status keberadaan diisi dengan (Ada, Pindah)</li>
                                        </ul>
                                    </li>
                                    <li>Data maksimal memiliki 100 baris, jika melebihi lakukan pembagian menjadi beberapa file</li>
                                    <li>Simpan perubahan file pada template.</li>
                                    <li>Upload file template tersebut pada form import yang sudah di sediakan.</li>
                                    <li>Mulai proses import dengan memilih tombol Import</li>
                                </ol>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="file" name="FileImport" class="form-control">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Import
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="NotifikasiImport">
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>