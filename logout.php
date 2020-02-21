<?php
$page_title = "Momonod admin-logout";
require_once('compTop.php');
require_once('compNav.php');

session_start();
session_destroy();
?>
<main>
  <section class="logout-section">
    <p>You have been successfully logged out.</p>
    <p>Thank you for using momonod-admin</p>
  </section>
</main>
<?php
require_once('compBottom.php');

?>