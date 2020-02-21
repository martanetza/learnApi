<?php
$page_title = "Momonod admin-login";
require_once('compTop.php');
require_once('compNav.php');

// Validation
if (
  isset($_POST['email']) &&
  isset($_POST['password'])
) {
  // Connect to the database
  $sCorrectEmail      = 'a@a.com';
  $sCorrectPassword   = '12345';
  $sUserEmail         = $_POST['email'];
  $sUserPassword      = $_POST['password'];
  if (
    $sCorrectEmail ==  $sUserEmail &&
    $sCorrectPassword == $sUserPassword
  ) {
    // To start using sessions/cookies 
    session_start();
    // You can put anything in the session
    $_SESSION['sEmail'] = $sUserEmail;
    header('Location: admin.php');
    exit();
  }
}

?>
<main>
  <section class="login-section">
    <p>admin login</p>
    <form id="loginForm" action="login.php" method='POST'>
      <label for="email">email</label>
      <input id="email" name="email" type="text" />
      <label for="password">paswword (2 to 50 characters)</label>
      <input id="password" name="password" type="text" />
      <button>login</button>
    </form>
  </section>
</main>
<?php
require_once('compBottom.php');

?>