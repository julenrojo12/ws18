 <?php
 session_start();
 if(!isset($_SESSION['erabiltzailea'])){echo "<script language='javascript'>window.location='logIn.php'; </script>";}
 $user = $_SESSION['erabiltzailea'];
 $_SESSION = array();
 if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
 echo "<br><br>";
 echo "<b>$user</b>-(r)en sesioa itxita";
 session_destroy();
 ?>
 <br>
 <a href='../layout.html'>Home</a>
