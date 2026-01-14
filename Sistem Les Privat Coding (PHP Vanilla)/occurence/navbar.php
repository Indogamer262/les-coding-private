<!-- Header bar layout -->
<div class="navbar poppins-regular">
    <p>
        <?php echo $_SESSION["loginUSN"]; ?><br>
        <?php echo $_SESSION["loginRoles"]; ?> | <a href=".?action=logout">Logout</a>
    </p>
</div>