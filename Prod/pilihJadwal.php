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

    // import pages based on roles
    if($_SESSION["loginRoles"] == "murid") {
        include("pages/murid/pilihJadwal.php");
    }
    else if($_SESSION["loginRoles"] == "pengajar") {
        include("pages/noPermissionException.php");
    }
    else if($_SESSION["loginRoles"] == "admin") {
        include("pages/noPermissionException.php");
    }
?>