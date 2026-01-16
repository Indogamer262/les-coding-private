<?php
    session_start();

    // remove session if action=logout
    if(!empty($_GET["action"])) {
        if($_GET["action"] == "logout") {
            $_SESSION["loginStat"] = 0;
            $_SESSION["loginUSN"] = null;
            $_SESSION["loginRoles"] = null;
        }
    }

    if (empty($_SESSION["loginStat"])) {
        $_SESSION["loginStat"] = 0;
    }

    // don't come here if already logged in
    if($_SESSION["loginStat"] > 0) {
        header("Location: dashboard.php");
    }
    
    
    // for wrong login message
    if(empty($_GET["wrongLogin"])) {
        $wrongLogin = 0;
    }
    else {
        $wrongLogin = $_GET["wrongLogin"];
    }
    $message1 = "";
    $message2 = "";
    $message3 = "";
    $initScript = "";

    if($wrongLogin > 0) {
        $message = '<div style="padding:8px; background-color: #ffd4d1; border-radius: 7px; border: 1px solid #ff4a3d; width:100%; margin-top: 5px; margin-bottom: 12px; box-sizing: border-box;">' .
                    'wrong username/password!' .
                    '</div>';

        switch($wrongLogin) {
            case 1:
                $message1 = $message;
                $initScript = "switchPage(1);";
                break;
            case 2:
                $message2 = $message;
                $initScript = "switchPage(2);";
                break;
            case 3:
                $message3 = $message;
                $initScript = "switchPage(3);";
                break;
            default:
                break;
        }
    }
?>

<!-- Frontend by 2472008, member of "Les Coding Private" Team -->
<!DOCTYPE html>
<html>
    <head>
        <title>Login - Les Coding Private</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Library Import -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&display=swap" rel="stylesheet">

        <style>
            body, html {box-sizing: border-box;margin: 0;}
            .poppins-light {font-family: "Poppins", sans-serif;font-weight: 300;font-style: normal;}
            .poppins-regular {font-family: "Poppins", sans-serif;font-weight: 400;font-style: normal;}
            .poppins-semibold {font-family: "Poppins", sans-serif;font-weight: 600;font-style: normal;}
            .poppins-bold {font-family: "Poppins", sans-serif;font-weight: 700;font-style: normal;}
            .poppins-light-italic {font-family: "Poppins", sans-serif;font-weight: 300;font-style: italic;}
            .poppins-regular-italic {font-family: "Poppins", sans-serif;font-weight: 400;font-style: italic;}
            
            .centerbox {
                display: inline-block;
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                margin:auto;
                width: auto;
                border-radius: 8px;
                padding: 32px;
                padding-left: 48px;
                padding-right: 48px;
                box-shadow: 0 0 15px 5px #eeeeeeff;
            }

            .login-btn {
                display: block;
                margin-bottom: 7px;
                width: 100%;
                padding: 12px;
            }
            .submit-btn {
                background-color: #1c47e4ff;
                display: block;
                color: white;
                width: 100%;
                padding: 10px;
                border: none;
                border-radius: 7px;
                cursor: pointer;
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
            }
            label {
                display: inline-block;
                margin-top: 10px;
            }
            
            .back-link {
                color: #444444;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <div class="centerbox poppins-regular" id="loginSelector">
            <h2 style="margin-top: 0; margin-bottom: 5px; text-align: center;">Les Privat Coding</h2>
            <span style="color: #353535ff; text-align: center;">Silahkan pilih akun untuk masuk</span><br>
            <br>
            <button class="login-btn" onclick="switchPage(1);">Masuk sebagai Murid</button>
            <button class="login-btn" onclick="switchPage(2);">Masuk sebagai Pengajar</button>
            <button class="login-btn" onclick="switchPage(3);">Masuk sebagai Admin</button>
        </div>

        <div class="centerbox poppins-regular" id="loginMurid" style="display:none;">
            <h2 style="margin-top: 0; margin-bottom: 5px; text-align: center;">Les Privat Coding</h2>
            <span style="color: #353535ff; text-align: center;">Silahkan pilih akun untuk masuk</span><br>
            <br>
            <a onclick="switchPage(0);" class="back-link">< Kembali</a>
            <h3 style="margin-top: 0; margin-bottom: 5px;">Login Murid</h3>

            <form method="POST" action="dashboard.php">
                <input type="hidden" name="roles" value="murid">
                <label for="email">Email:</label><br>
                <input type="email" class="input-field" placeholder="nama@email.com" name="email" id="email" required>
                <label for="email">Password:</label><br>
                <input type="password" class="input-field" placeholder="••••••••••••" name="password", id="password" required>
                <input type="checkbox" value="true" name="remember" id="remember">
                <label for="remember">Ingat saya</label><br>
                <?php echo $message1; ?>
                <input type="submit" class="submit-btn" value="Masuk">
            </form>
        </div>

        <div class="centerbox poppins-regular" id="loginPengajar" style="display:none;">
            <h2 style="margin-top: 0; margin-bottom: 5px; text-align: center;">Les Privat Coding</h2>
            <span style="color: #353535ff; text-align: center;">Silahkan pilih akun untuk masuk</span><br>
            <br>
            <a onclick="switchPage(0);" class="back-link">< Kembali</a>
            <h3 style="margin-top: 0; margin-bottom: 5px;">Login Pengajar</h3>

            <form method="POST" action="dashboard.php">
                <input type="hidden" name="roles" value="pengajar">
                <label for="email">Email:</label><br>
                <input type="email" class="input-field" placeholder="nama@email.com" name="email" id="email" required>
                <label for="email">Password:</label><br>
                <input type="password" class="input-field" placeholder="••••••••••••" name="password", id="password" required>
                <input type="checkbox" value="true" name="remember" id="remember">
                <label for="remember">Ingat saya</label><br>
                <?php echo $message2; ?>
                <input type="submit" class="submit-btn" value="Masuk">
            </form>
        </div>

        <div class="centerbox poppins-regular" id="loginAdmin" style="display:none;">
            <h2 style="margin-top: 0; margin-bottom: 5px; text-align: center;">Les Privat Coding</h2>
            <span style="color: #353535ff; text-align: center;">Silahkan pilih akun untuk masuk</span><br>
            <br>
            <a onclick="switchPage(0);" class="back-link">< Kembali</a>
            <h3 style="margin-top: 0; margin-bottom: 5px;">Login Admin</h3>

            <form method="POST" action="dashboard.php">
                <input type="hidden" name="roles" value="admin">
                <label for="email">Email:</label><br>
                <input type="email" class="input-field" placeholder="nama@email.com" name="email" id="email" required>
                <label for="email">Password:</label><br>
                <input type="password" class="input-field" placeholder="••••••••••••" name="password", id="password" required>
                <input type="checkbox" value="true" name="remember" id="remember">
                <label for="remember">Ingat saya</label><br>
                <?php echo $message3; ?>
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
                    break;
                case 2:
                    document.getElementById('loginSelector').style.display = 'none';
                    document.getElementById('loginPengajar').style.display = 'inline-block';
                    break;
                case 3:
                    document.getElementById('loginSelector').style.display = 'none';
                    document.getElementById('loginAdmin').style.display = 'inline-block';
                    break;
            }
        }

        <?php echo $initScript; ?>
    </script>
</html>