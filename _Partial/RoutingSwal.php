<?php
    if(!empty($_SESSION['NotifikasiSwal'])){
        $NotifikasiSwal=$_SESSION['NotifikasiSwal'];
?>
    <!------- Notifikasi ------------>
    <?php if($NotifikasiSwal=="Login Berhasil"){ ?>
        <script>
            swal("Success!", "Anda Berhasil Melakukan Login", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Akses Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Akses Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus Akses Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus Akses Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Atur Akses Berhasil"){ ?>
        <script>
            swal("Success!", "Atur Akses Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Pendaftaran Mitra Berhasil"){ ?>
        <script>
            swal("Success!", "Pendaftaran Mitra Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Verifikasi Akun Mitra Berhasil"){ ?>
        <script>
            swal("Success!", "Verifikasi Akun Mitra Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Mitra Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Mitra Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Update Logo Mitra Berhasil"){ ?>
        <script>
            swal("Success!", "Update Logo Mitra Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Update Info Mitra Berhasil"){ ?>
        <script>
            swal("Success!", "Update Info Mitra Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Pelanggan Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Pelanggan Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Simpan Setting General Berhasil"){ ?>
        <script>
            swal("Success!", "Pengaturan Berhasil Disimpan", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Simpan Setting Whatsapp Berhasil"){ ?>
        <script>
            swal("Success!", "Save Whatsapp Settings Successful", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Simpan Setting Payment Berhasil"){ ?>
        <script>
            swal("Success!", "Save Payment Settings Successful", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Simpan Setting Email Berhasil"){ ?>
        <script>
            swal("Success!", "Simpan Setting Email Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Kirim Email Berhasil"){ ?>
        <script>
            swal("Success!", "Send Email Successful", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Simpan Dokumentasi API Berhasil"){ ?>
        <script>
            swal("Success!", "Save API Documentation Successful", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Edit Mitra Berhasil"){ ?>
        <script>
            swal("Success!", "Edit Partner Successful", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Edit Pasien Berhasil"){ ?>
        <script>
            swal("Success!", "Edit Patient Successful", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Edit Akses Berhasil"){ ?>
        <script>
            swal("Success!", "Edit Access Successful", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Edit Password Berhasil"){ ?>
        <script>
            swal("Success!", "Edit Password Successful", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Simpan Help Berhasil"){ ?>
        <script>
            swal("Success!", "Save content data successfully", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus Help Berhasil"){ ?>
        <script>
            swal("Success!", "Delete content data successfully", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Kunjungan Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Kunjungan Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Simpan Konten Web Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Konten Web Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Layanan Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Layanan Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus Layanan Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus Layanan Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Edit Layanan Berhasil"){ ?>
        <script>
            swal("Success!", "Edit Layanan Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Booking Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Booking Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Edit Booking Berhasil"){ ?>
        <script>
            swal("Success!", "Edit Booking Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Edit Metode Transaksi Berhasil"){ ?>
        <script>
            swal("Success!", "Edit Metode Transaksi Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Edit Status Transaksi Berhasil"){ ?>
        <script>
            swal("Success!", "Edit Status Transaksi Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Edit Pembayaran Berhasil"){ ?>
        <script>
            swal("Success!", "Edit Pembayaran Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus Rincian Detail Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus Rincian Detail Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Rincian Detail Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Rincian Detail Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Simpan Pembayaran Berhasil"){ ?>
        <script>
            swal("Success!", "Simpan Pembayaran Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Klaim Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Klaim Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus Klaim Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus Klaim Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Edit Klaim Berhasil"){ ?>
        <script>
            swal("Success!", "Edit Klaim Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Kirim Pesan Berhasil"){ ?>
        <script>
            swal("Success!", "Kirim Pesan Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Simpan Form Setting Berhasil"){ ?>
        <script>
            swal("Success!", "Simpan Form Setting Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus Form Setting Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus Form Setting Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Draft Medrek Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Draft Medrek Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Edit Draft Medrek Berhasil"){ ?>
        <script>
            swal("Success!", "Edit Draft Medrek Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus Jadwal Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus Jadwal Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Jadwal Hairstylist Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Jadwal Hairstylist Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Wilayah Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Wilayah Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Hairstylist Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Hairstylist Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Kategori Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Kategori Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Barang Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Barang Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus Galeri Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus Galeri Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Rincian Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Rincian Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Edit Rincian Berhasil"){ ?>
        <script>
            swal("Success!", "Edit Rincian Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus Rincian Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus Rincian Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Edit Transaksi Berhasil"){ ?>
        <script>
            swal("Success!", "Edit Transaksi Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Jadwal Praktek Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Jadwal Praktek Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Testimoni Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Testimoni Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah FAQ Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah FAQ Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Rekening Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Rekening Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Struktur Organisasi Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Struktur Organisasi Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Edit Struktur Organisasi Berhasil"){ ?>
        <script>
            swal("Success!", "Edit Struktur Organisasi Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus Struktur Organisasi Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus Struktur Organisasi Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Demografi Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Demografi Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Edit Demografi Berhasil"){ ?>
        <script>
            swal("Success!", "Edit Demografi Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus Demografi Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus Demografi Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Capaian Target Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Capaian Target Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Edit Capaian Target Berhasil"){ ?>
        <script>
            swal("Success!", "Edit Capaian Target Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus Capaian Target Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus Capaian Target Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Update Response Berhasil"){ ?>
        <script>
            swal("Success!", "Update Response Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Update Rekapitulasi Berhasil"){ ?>
        <script>
            swal("Success!", "Update Rekapitulasi Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Update Progress Berhasil"){ ?>
        <script>
            swal("Success!", "Update Progress Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah RPJMDES Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah RPJMDES Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Update RPJMDES Berhasil"){ ?>
        <script>
            swal("Success!", "Update RPJMDES Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus RPJMDES Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus RPJMDES Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah RKPDES Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah RKPDES Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Update RKPDES Berhasil"){ ?>
        <script>
            swal("Success!", "Update RKPDES Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus RKPDES Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus RKPDES Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Import Dataset RKPDES Berhasil"){ ?>
        <script>
            swal("Success!", "Import Dataset RKPDES Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Kirim Jawaban Berhasil"){ ?>
        <script>
            swal("Success!", "Update Jawaban Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="File Berhasil Di Hapus Dari Directory"){ ?>
        <script>
            swal("Success!", "File Berhasil Di Hapus Dari Directory", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="File Gagal Di Hapus Dari Directory"){ ?>
        <script>
            swal("Success!", "File Gagal Di Hapus Dari Directory", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah APBDES Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah APBDES Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus APBDES Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus APBDES Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Update APBDES Berhasil"){ ?>
        <script>
            swal("Success!", "Update APBDES Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Import Dataset APBDES Berhasil"){ ?>
        <script>
            swal("Success!", "Import Dataset APBDES Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Perjanjian Kinerja Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Perjanjian Kinerja Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Update Perjanjian Kinerja Berhasil"){ ?>
        <script>
            swal("Success!", "Update Perjanjian Kinerja Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus Perjanjian Kinerja Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus Perjanjian Kinerja Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Sasaran Target Perjanjian Kinerja Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Sasaran Target Perjanjian Kinerja Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Update Sasaran Target Perjanjian Kinerja Berhasil"){ ?>
        <script>
            swal("Success!", "Update Sasaran Target Perjanjian Kinerja Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus Sasaran Perjanjian Kinerja Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus Sasaran Perjanjian Kinerja Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Upload File Berhasil"){ ?>
        <script>
            swal("Success!", "Upload File Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus File Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus File Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Konfirmasi Desa Berhasil"){ ?>
        <script>
            swal("Success!", "Konfirmasi Desa Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tambah Capaian Berhasil"){ ?>
        <script>
            swal("Success!", "Tambah Capaian Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Hapus Capaian Kinerja Berhasil"){ ?>
        <script>
            swal("Success!", "Hapus Capaian Kinerja Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Edit Capaian Berhasil"){ ?>
        <script>
            swal("Success!", "Edit Capaian Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Buka Kunci Berhasil"){ ?>
        <script>
            swal("Success!", "Buka Kunci Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Tutup Kunci Berhasil"){ ?>
        <script>
            swal("Success!", "Tutup Kunci Berhasil", "success");
        </script>
    <?php } ?>
    <?php if($NotifikasiSwal=="Rekap Evaluasi Berhasil"){ ?>
        <script>
            swal("Success!", "Rekap Evaluasi Berhasil", "success");
        </script>
    <?php } ?>
<?php 
    unset($_SESSION['NotifikasiSwal']);
    }
?>