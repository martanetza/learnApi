<?php
if (!isset($_SESSION['sEmail'])) :
?>

    <nav>
        <a href="admin.php">Momondo - admin panel</a>
        <a href="login.php">login</a>
    </nav>

<?php
else :
?>
    <nav>
        <a href="admin.php">Momondo - admin panel</a>
        <a href="logout.php">logout</a>
    </nav>

<?php
endif;
?>