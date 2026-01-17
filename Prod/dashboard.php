<?php
    session_start();

    include_once("util/dbLesCoding.php");
    $lesCodingUtil = new DBLesCoding();

    if (empty($_SESSION["loginStat"])) {
        $loginStat = 0;

        // however, check for new login
        

        // get data from client
        $roles = $_POST['roles'] ?? null;
        $username = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        // get roles number
        if($roles == "murid") {
            $roleNumber = 1;
            $_SESSION["loginRoles"] = "murid";
        }
        else if($roles == "pengajar") {
            $roleNumber = 2;
            $_SESSION["loginRoles"] = "pengajar";
        }
        else if($roles == "admin") {
            $roleNumber = 3;
            $_SESSION["loginRoles"] = "admin";
        }

        // check to database if not empty
        if(!empty($roles) && !empty($username) && !empty($password)) {
            if($lesCodingUtil->verifyLogin($roles, $username, $password)) {
                $loginStat = $roleNumber;
                $_SESSION["loginStat"] = $roleNumber;
                
                // get username and put it in session
                $_SESSION["loginUSN"] = $lesCodingUtil->getAccountUsername($roles, $username);
                $_SESSION["loginID"] = $lesCodingUtil->getAccountId($roles, $username);
            }
            else {
                $loginStat = -1;
                header("Location: index.php?wrongLogin=$roleNumber");
            }
        }
    }
    else {
        $loginStat = $_SESSION["loginStat"];
    }

    // don't come here if haven't logged in
    if($loginStat == 0) {
        header("Location: .");
    }

    // import pages based on roles
    if($_SESSION["loginRoles"] == "murid") {
        include("pages/murid/dashboard.php");
    }
    else if($_SESSION["loginRoles"] == "pengajar") {
        include("pages/pengajar/dashboard.php");
    }
    else if($_SESSION["loginRoles"] == "admin") {
        include("pages/admin/dashboard.php");
    }
?>

