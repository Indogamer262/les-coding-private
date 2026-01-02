<?php
session_start();

// already logged in
if (!empty($_SESSION['logged_in'])) {
    header('Location: dashboard.php');
    exit;
}

// wrong login message (kept compatible with the vanilla pattern)
$wrongLogin = isset($_GET['wrongLogin']) ? (int)$_GET['wrongLogin'] : 0;

$message1 = '';
$message2 = '';
$message3 = '';
$initScript = '';

if ($wrongLogin > 0) {
    $message = '<div style="padding:8px; background-color: #ffd4d1; border-radius: 7px; border: 1px solid #ff4a3d; width:100%; margin-top: 5px; margin-bottom: 12px; box-sizing: border-box;">wrong username/password!</div>';
    switch ($wrongLogin) {
        case 1:
            $message1 = $message;
            $initScript = 'switchPage(1);';
            break;
        case 2:
            $message2 = $message;
            $initScript = 'switchPage(2);';
            break;
        case 3:
            $message3 = $message;
            $initScript = 'switchPage(3);';
            break;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login - Les Coding Private</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&display=swap" rel="stylesheet">

        <!-- Keep project CSS assets (dashboard/layout use this) -->
        <link rel="stylesheet" href="css/style.css">

        <!-- Vanilla-style login UI -->
        <style>
            body, html {box-sizing: border-box;margin: 0;}
            html, body { background-color: #ffffff !important; min-height: 100%; }
            .poppins-regular {font-family: "Poppins", sans-serif;font-weight: 400;font-style: normal;}

            .auth-title {
                margin-top: 0;
                margin-bottom: 6px;
                text-align: center;
                font-weight: 700;
                color: #111827;
            }

            .auth-subtitle {
                text-align: center;
                color: #6b7280;
                margin: 0;
            }

            .auth-header {
                margin-bottom: 18px;
            }

            .centerbox {
                display: inline-block;
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                margin:auto;
                width: min(420px, 92vw);
                border-radius: 8px;
                padding: 28px;
                box-shadow: 0 0 15px 5px #eeeeeeff;
                background: white;
            }

            .auth-body {
                margin-top: 8px;
            }

            .back-link {
                color: #6b7280;
                cursor: pointer;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin: 8px 0 16px;
            }

            .back-link:hover { color: #444444; }

            .auth-form-title {
                margin: 0 0 16px;
                font-size: 28px;
                font-weight: 700;
                color: #111827;
            }

            .login-btn {
                width: 100%;
                cursor: pointer;
            }

            .login-btn:hover {
                background-color: var(--accent);
                border-color: var(--sidebar-primary);
            }

            .login-btn:hover .login-btn__title {
                color: var(--sidebar-primary);
            }
            .submit-btn {
                background-color: #1c47e4ff;
                display: block;
                color: white;
                width: 100%;
                padding: 12px;
                border: none;
                border-radius: 7px;
                cursor: pointer;
                font-size: 16px;
                font-weight: 600;
            }
            .submit-btn:hover {
                background-color: #1a40d5;
            }
            .input-field {
                padding: 12px;
                display: block;
                width: 100%;
                border-radius: 7px;
                box-sizing: border-box;
                border: 1px solid #ddd;
                font-size: 16px;
            }
            label {
                display: inline-block;
                margin-top: 10px;
                color: #111827;
                font-weight: 600;
            }

            .remember-row {
                display: flex;
                align-items: center;
                gap: 10px;
                margin: 12px 0 10px;
                color: #6b7280;
            }

            .remember-row label {
                margin-top: 0;
                font-weight: 400;
                color: #6b7280;
            }

            .auth-message {
                margin-top: 10px;
                margin-bottom: 12px;
            }

            @media (max-width: 480px) {
                .centerbox { padding: 22px; }
                .auth-form-title { font-size: 26px; }
            }
        </style>
    </head>
    <body>
        <div class="centerbox poppins-regular" id="loginSelector">
            <div class="auth-header">
                <h2 class="auth-title">Les Privat Coding</h2>
                <p class="auth-subtitle">Silahkan pilih akun untuk masuk</p>
            </div>

            <div class="flex flex-col gap-4 mt-4">
                <button type="button" class="login-btn flex items-center justify-between px-6 py-4 bg-white border border-gray-200 rounded-lg transition-colors" onclick="switchPage(1);">
                    <span class="flex items-center gap-4">
                        <span class="login-btn__title text-lg text-gray-700">Masuk sebagai Murid</span>
                    </span>
                    <span class="text-gray-400">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </button>

                <button type="button" class="login-btn flex items-center justify-between px-6 py-4 bg-white border border-gray-200 rounded-lg transition-colors" onclick="switchPage(2);">
                    <span class="flex items-center gap-4">
                        <span class="login-btn__title text-lg text-gray-700">Masuk sebagai Pengajar</span>
                    </span>
                    <span class="text-gray-400">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </button>

                <button type="button" class="login-btn flex items-center justify-between px-6 py-4 bg-white border border-gray-200 rounded-lg transition-colors" onclick="switchPage(3);">
                    <span class="flex items-center gap-4">
                        <span class="login-btn__title text-lg text-gray-700">Masuk sebagai Admin</span>
                    </span>
                    <span class="text-gray-400">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </button>
            </div>
        </div>

        <div class="centerbox poppins-regular" id="loginMurid" style="display:none;">
            <div class="auth-header">
                <h2 class="auth-title">Les Privat Coding</h2>
                <p class="auth-subtitle">Silahkan pilih akun untuk masuk</p>
            </div>

            <a onclick="switchPage(0);" class="back-link" role="button" tabindex="0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Kembali</span>
            </a>

            <h3 class="auth-form-title">Login Murid</h3>

            <form method="POST" action="loginVerify.php">
                <input type="hidden" name="role" value="murid">
                <label for="email_m">Email:</label><br>
                <input type="email" class="input-field" placeholder="nama@email.com" name="email" id="email_m" required>
                <label for="password_m">Password:</label><br>
                <input type="password" class="input-field" placeholder="••••••••••••" name="password" id="password_m" required>
                <div class="remember-row">
                    <input type="checkbox" value="true" name="remember" id="remember_m">
                    <label for="remember_m">Ingat saya</label>
                </div>
                <div class="auth-message"><?php echo $message1; ?></div>
                <input type="submit" class="submit-btn" value="Masuk">
            </form>
        </div>

        <div class="centerbox poppins-regular" id="loginPengajar" style="display:none;">
            <div class="auth-header">
                <h2 class="auth-title">Les Privat Coding</h2>
                <p class="auth-subtitle">Silahkan pilih akun untuk masuk</p>
            </div>

            <a onclick="switchPage(0);" class="back-link" role="button" tabindex="0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Kembali</span>
            </a>

            <h3 class="auth-form-title">Login Pengajar</h3>

            <form method="POST" action="loginVerify.php">
                <input type="hidden" name="role" value="pengajar">
                <label for="email_p">Email:</label><br>
                <input type="email" class="input-field" placeholder="nama@email.com" name="email" id="email_p" required>
                <label for="password_p">Password:</label><br>
                <input type="password" class="input-field" placeholder="••••••••••••" name="password" id="password_p" required>
                <div class="remember-row">
                    <input type="checkbox" value="true" name="remember" id="remember_p">
                    <label for="remember_p">Ingat saya</label>
                </div>
                <div class="auth-message"><?php echo $message2; ?></div>
                <input type="submit" class="submit-btn" value="Masuk">
            </form>
        </div>

        <div class="centerbox poppins-regular" id="loginAdmin" style="display:none;">
            <div class="auth-header">
                <h2 class="auth-title">Les Privat Coding</h2>
                <p class="auth-subtitle">Silahkan pilih akun untuk masuk</p>
            </div>

            <a onclick="switchPage(0);" class="back-link" role="button" tabindex="0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Kembali</span>
            </a>

            <h3 class="auth-form-title">Login Admin</h3>

            <form method="POST" action="loginVerify.php">
                <input type="hidden" name="role" value="admin">
                <label for="email_a">Email:</label><br>
                <input type="email" class="input-field" placeholder="nama@email.com" name="email" id="email_a" required>
                <label for="password_a">Password:</label><br>
                <input type="password" class="input-field" placeholder="••••••••••••" name="password" id="password_a" required>
                <div class="remember-row">
                    <input type="checkbox" value="true" name="remember" id="remember_a">
                    <label for="remember_a">Ingat saya</label>
                </div>
                <div class="auth-message"><?php echo $message3; ?></div>
                <input type="submit" class="submit-btn" value="Masuk">
            </form>
        </div>
    </body>

    <script>
        function switchPage(pageId) {
            switch (pageId) {
                case 0:
                    document.getElementById('loginSelector').style.display = 'inline-block';
                    document.getElementById('loginMurid').style.display = 'none';
                    document.getElementById('loginPengajar').style.display = 'none';
                    document.getElementById('loginAdmin').style.display = 'none';
                    break;
                case 1:
                    document.getElementById('loginSelector').style.display = 'none';
                    document.getElementById('loginMurid').style.display = 'inline-block';
                    document.getElementById('loginPengajar').style.display = 'none';
                    document.getElementById('loginAdmin').style.display = 'none';
                    break;
                case 2:
                    document.getElementById('loginSelector').style.display = 'none';
                    document.getElementById('loginMurid').style.display = 'none';
                    document.getElementById('loginPengajar').style.display = 'inline-block';
                    document.getElementById('loginAdmin').style.display = 'none';
                    break;
                case 3:
                    document.getElementById('loginSelector').style.display = 'none';
                    document.getElementById('loginMurid').style.display = 'none';
                    document.getElementById('loginPengajar').style.display = 'none';
                    document.getElementById('loginAdmin').style.display = 'inline-block';
                    break;
            }
        }

        <?php echo $initScript; ?>
    </script>
</html>
