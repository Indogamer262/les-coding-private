<!-- custom CSS -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=menu" />
<style>
    .navbar {
        grid-area: header;
        background-color: white;
        box-shadow: 0 0 4px 0 lightgray;
        padding: 12px;
        text-align: right;
        display:flex;
        justify-content: space-between;
        align-items: center;
        flex-direction: row-reverse;
    }
    .burger {
        display: none;
    }

    @media only screen and (max-width: 800px) {
        .burger {
            display: block;
        }
    }
</style>

<!-- Header bar layout -->
<div class="navbar poppins-regular">
    <p>
        <?php echo $_SESSION["loginUSN"]; ?><br>
        <?php echo $_SESSION["loginRoles"]; ?> | <a href=".?action=logout">Logout</a>
    </p>
    <div class="burger" onclick="sidebarToggle();">
        <span class="material-symbols-outlined">menu</span>
    </div>
</div>