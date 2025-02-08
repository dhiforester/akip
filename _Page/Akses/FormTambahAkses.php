<?php
    include "../../_Config/Connection.php";
?>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="nama_akses">Nama Lengkap</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="nama_akses" id="nama_akses" class="form-control">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="kontak_akses">Kontak/HP</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="kontak_akses" id="kontak_akses" class="form-control" placeholder="+62">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="email">Email</label>
    </div>
    <div class="col-md-8">
        <input type="email" name="email" id="email" class="form-control" placeholder="email@domain.com">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="akses">Level Akses</label>
    </div>
    <div class="col-md-8">
        <select name="akses" id="akses" class="form-control">
            <option value="">Pilih</option>
            <option value="Admin">Admin</option>
            <option value="Provinsi">Provinsi</option>
            <option value="Kabupaten">Kabupaten/Kota</option>
            <option value="Kecamatan">Kecamatan</option>
            <option value="Desa">Desa/Kelurahan</option>
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="id_akses_entitas">Entitas</label>
    </div>
    <div class="col-md-8">
        <select name="id_akses_entitas" id="id_akses_entitas" class="form-control">
            <option value="">Pilih</option>
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="foto">Foto</label>
    </div>
    <div class="col-md-8">
        <input type="file" name="image_akses" id="image_akses" class="form-control">
        <small class="credit">Maximum File 2 Mb (PNG, JPG, JPEG, GIF)</small>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="password1">Password</label>
    </div>
    <div class="col-md-8">
        <input type="password" name="password1" id="password1" class="form-control">
        <small class="credit">Password hanya boleh terdiri dari 6-20 karakter angka dan huruf</small>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="password2">Ulangi Password</label>
    </div>
    <div class="col-md-8">
        <input type="password" name="password2" id="password2" class="form-control">
        <small class="credit">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Tampilkan" id="TampilkanPassword" name="TampilkanPassword">
                <label class="form-check-label" for="TampilkanPassword">
                    Tampilkan Password
                </label>
            </div>
        </small>
    </div>
</div>
