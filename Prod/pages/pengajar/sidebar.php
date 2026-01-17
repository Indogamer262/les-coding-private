<style>
    .sidebar {
        grid-area: sidebar;
        height: 100vh;
        box-sizing: border-box;
        background-color: #004fa8ff;
        overflow-y: auto;
    }
    .sidebar-content {
        width: 300px;
        padding: 25px;
        box-sizing: border-box;
    }
    .sidebar-content>a {
        display: block;
        border-radius: 8px;
        padding: 12px;
        text-align: left;
        color: white;
        text-decoration: none;
        font-size: 14px;
        margin-bottom: 4px;
    }
    .sidebar-content>a:hover {
        background-color: #0070f0ff;
    }
    .sidebar-content>.active {
        background-color: #006be6ff;
        color: white;
    }

    @media only screen and (max-width: 800px) {
        .sidebar {
            height: auto;
            box-sizing: border-box;
            background-color: #004fa8ff;
            overflow: unset;
            position: absolute;
            z-index: 3;
            display: none;
        }
    }
</style>

<div class="sidebar poppins-regular">
    <div>
        <p style="font-size: 18px; color: white; text-align: center; margin-top: 25px; padding-bottom: 25px; border-bottom: 1px solid black; margin-bottom: 0; box-sizing: border-box;" class="poppins-bold"><b>Les Privat Coding</b></p>
    </div>
    <div class="sidebar-content">
        <a href="dashboard.php" class="<?php if(basename($_SERVER['PHP_SELF'], ".php") == "dashboard") {echo "active";} ?>">Dashboard</a>
        <a href="jadwalLes.php" class="<?php if(basename($_SERVER['PHP_SELF'], ".php") == "jadwalLes") {echo "active";} ?>">Jadwal Mengajar</a>
        <a href="absensi.php" class="<?php if(basename($_SERVER['PHP_SELF'], ".php") == "absensi") {echo "active";} ?>">Absensi Murid</a>
        <a href="kehadiran.php" class="<?php if(basename($_SERVER['PHP_SELF'], ".php") == "kehadiran") {echo "active";} ?>">Riwayat Kehadiran</a>
    </div>
</div>

<script>
    let state = false;
    function sidebarToggle() {
        if(state) {
            document.getElementsByClassName("sidebar")[0].style.display = null;
            state = false;
        }
        else {
            document.getElementsByClassName("sidebar")[0].style.display = "block";
            state = true;
        }
    }
</script>