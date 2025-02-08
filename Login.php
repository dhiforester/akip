<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            //Koneksi
            session_start();
            include "_Config/Connection.php";
            include "_Config/SettingGeneral.php";
            include "_Partial/JsPlugin.php";
        ?>
    </head>
    <body>
        <main class="bg bg-dark">
            <div class="container">
                <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                                <img src="assets/img/<?php echo $logo;?>" alt="<?php echo $title_page;?>" width="100px">
                                <div class="d-flex justify-content-center py-2">
                                    <p>
                                        <a href="" class="logo d-flex align-items-center w-auto">
                                            <span class="d-none d-lg-block text-light"><?php echo $title_page;?></span>
                                        </a>
                                    </p>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="pt-4 pb-2">
                                            <h5 class="card-title text-center pb-0 fs-4">Login Ke Akun Anda</h5>
                                            <p class="text-center small">Masukan Email Dan Password Untuk Melakukan Login</p>
                                        </div>
                                        <form action="javascript:void(0);" class="row g-3" id="ProsesLogin">
                                            <div class="col-12">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id="email" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" name="password" id="password" class="form-control" required>
                                                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                                        <i class="bi bi-eye" id="eyeIcon"></i>
                                                    </span>
                                                </div>
                                                <small class="credit">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Tampilkan" id="TampilkanPassword2" name="TampilkanPassword2">
                                                        <label class="form-check-label" for="TampilkanPassword2">
                                                            Tampilkan Password
                                                        </label>
                                                    </div>
                                                </small>
                                            </div>
                                            <div class="col-12">
                                                <label for="captcha" class="form-label">
                                                    Captcha 
                                                    <a href="javascript:void(0);" onclick="reloadCaptcha()"> 
                                                        <small>(Muat Ulang)</small>
                                                    </a>
                                                </label>
                                                <img src="_Config/Captcha.php" class="mb-2" id="captchaImage" alt="No Image" width="100%" style="border: 1px solid #ddd; margin-right: 10px;"/>
                                                <input type="text" class="form-control" id="captcha" name="captcha" required>
                                                <small>Masukan Kode Captcha</small>
                                            </div>
                                            <div class="col-12">
                                                Pastikan email dan password sudah benar.
                                            </div>
                                            <div class="col-12" id="NotifikasiLogin"></div>
                                            <div class="col-12">
                                                <button class="btn btn-lg btn-primary w-100" type="submit" id="TombolLogin">
                                                    <i class="bi bi-box-arrow-in-left"></i> Login
                                                </button>
                                            </div>
                                            <div class="col-12">
                                                <p class="small mb-0">Anda Lupa Password? <a href="LupaPassword.php">Reset password</a></p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="credits">
                                    <small>
                                        <span class="text-light">Designed by</span> <span class="text-warning"><b>PT.KARYA DIGITAL ADVERTISA</b></span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    </main>
        <?php
            include "_Partial/BackToTop.php";
            include "_Partial/FooterJs.php";
            include "_Partial/RoutingSwal.php";
        ?>
        <script>
            //Untuk menampilkan password
            const togglePassword = document.querySelector("#togglePassword");
            const passwordField = document.querySelector("#password");
            const eyeIcon = document.querySelector("#eyeIcon");

            togglePassword.addEventListener("click", function () {
                // Toggle jenis input antara 'password' dan 'text'
                const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
                passwordField.setAttribute("type", type);

                // Toggle ikon mata
                eyeIcon.classList.toggle("bi-eye");
                eyeIcon.classList.toggle("bi-eye-slash");
            });

            //Reload Captcha
            function reloadCaptcha() {
                document.getElementById('captchaImage').src = '_Config/Captcha.php?' + new Date().getTime();
            }

            // Reload Captcha setiap 10 menit
            setInterval(reloadCaptcha, 600000);


            //Proses Login
            $('#ProsesLogin').submit(function(){
                var ProsesLogin = $('#ProsesLogin').serialize();
                $('#TombolLogin').html('<div class="spinner-border text-info" role="status"><span class="visually-hidden">Loading...</span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Login/ProsesLogin.php',
                    data 	    :  ProsesLogin,
                    dataType    : 'json',
                    success     : function(response){
                        //Kembalikan Tombol Login Seperti Semula
                        $('#TombolLogin').html('<i class="bi bi-box-arrow-in-left"></i> Login');
                        
                        //Apabila Login Berhasil
                        if(response.code==200){
                            window.location.href = "index.php";
                        }else{
                            //Tampilkan Kesalahan
                            $('#NotifikasiLogin').html(response.message);
                        }
                    }
                });
            });
        </script>
    </body>
</html>