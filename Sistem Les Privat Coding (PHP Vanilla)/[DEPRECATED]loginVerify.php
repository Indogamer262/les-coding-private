<?php
    session_start();

    if (empty($_SESSION["loginStat"])) {
        $loginStat = 0;
    }
    else {
        $loginStat = $_SESSION["loginStat"];
    }

    // don't come here if logged in
    if($loginStat == 1) {
        header("Location: dashboard.php");
    }

    // verify the login credentials
    // check selected user roles, is it Murid, Pengajar or Admin
    //     put code here...

    // login credentials matched, log the user in
    // login credentials mismatch, fallback to previous page and give wrong password message
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
        <h1>Indeed, this thing has nothing</h1>
    </body>

</html>

