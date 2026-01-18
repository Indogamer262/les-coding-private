<?php 
    session_start();

    include_once("util/dbLesCoding.php");
    $lesCodingUtil = new DBLesCoding();

    if (empty($_SESSION["loginStat"])) {
        $loginStat = 0;
    }
    else {
        $loginStat = $_SESSION["loginStat"];
    }

    // don't come here if haven't logged in
    if($loginStat == 0) {
        header("Location: .");
    }
    else {
        $handlerType = $_POST["handlerType"] ?? null;
        if($handlerType == "tambahAkun") {
            // get all the data this handler needs
            $nama = $_POST["nama"];
            $role = $_POST["role"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            $lesCodingUtil->insertAccount($role, $nama, $email, $password);

            // fallback to previous page
            header("Location: accounts.php?addAccount=success");
        }
        else if($handlerType == "editAkun") {
            // get all the data this handler needs
            $nama = $_POST["nama"];
            $role = $_POST["role"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            $lesCodingUtil->editAccount($id, $nama, $email, $password);

            // fallback to previous page
            header("Location: accounts.php?addAccount=success");
        }
        else {
            header("Location: dashboard.php");
        }
    }
?>