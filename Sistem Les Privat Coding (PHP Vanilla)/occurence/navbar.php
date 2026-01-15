<!-- custom CSS -->
<style>
    .navbar {
        grid-area: header;
        background-color: white;
        box-shadow: 0 0 4px 0 lightgray;
        padding: 12px;
        text-align: right;
    }
</style>

<!-- Header bar layout -->
<div class="navbar poppins-regular">
    <p>
        <?php echo $_SESSION["loginUSN"]; ?><br>
        <?php echo $_SESSION["loginRoles"]; ?> | <a href=".?action=logout">Logout</a>
    </p>
</div>