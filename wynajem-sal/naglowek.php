<html>
 <head>
   <title>Wynajem sal.</title>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
   <link rel="stylesheet" type="text/css" href="style.css" />
 <head>
 
<body>

<div id="cialo">
<div id="buttonglowny">
  
  <div id="panellogowania">
  <?php
    echo '<h3>Panel logowania</h3>';
	session_start();

if(isset($_POST['iduzytkownika']) && isset($_POST['haslo']))
{
  // jeżeli użytkownik właśnie podjął próbę zalogowania
  $iduzytkownika = $_POST['iduzytkownika'];
  $haslo = $_POST['haslo'];
  
  $host_name="localhost";
  $user_name="root";
  $db_name="wynajem_sal";

  $bd_lacz = new mysqli($host_name, $user_name, '', $db_name);

  if (mysqli_connect_errno()) {
    echo 'Połączenie z bazą danych nie powiodło się: '.mysqli_connect_error();
    exit();
  }
 /*
  if(!get_magic_quotes_gpc()) {
    $iduzytkownika = mysql_escape_string($iduzytkownika);
    $haslo = mysql_escape_string($haslo);
  }
*/
  $zapytanie = 'select * from osoba '
               ."where login='$iduzytkownika' "
               ." and haslo='$haslo'";

  $wynik = $bd_lacz->query($zapytanie);
  if($wynik->num_rows > 0)
  {
    // jeżeli dane są w bazie zarejestrowanie identyfikatora użytkownika
	session_regenerate_id();
    $_SESSION['prawid_uzyt'] = $iduzytkownika;
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
  }
  $bd_lacz->close();
}
  if(isset($_SESSION['prawid_uzyt']))
  {
    echo 'Użytkownik zalogowany jako: '.$_SESSION['prawid_uzyt'].'<br />';	
    echo '<a href="wylog.php">Wyloguj</a><br />';
	  if($_SESSION['ip'] != $_SERVER['REMOTE_ADDR'])
        {
                die('Proba przejecia sesji udaremniona!');      
        }
  }
  else
  {
    if(isset($iduzytkownika))
    {
      // jeżeli próba logowania była nieudana
      echo 'Zalogowanie niemożliwe.<br />';
    }
    else
    {
      // nie było próby logowania lub nastąpiło wylogowanie
      echo 'Użytkownik niezalogowany.<br />';
    }

    // tworzenie formularza logowania
    echo '<form method="post" action="index.php">';
    echo '<table>';
    echo '<tr><td>Użytkownik:</td>';
    echo '<td><input type="text" name="iduzytkownika"></td></tr>';
    echo '<tr><td>Hasło:</td>';
    echo '<td><input type="password" name="haslo"></td></tr>';
    echo '<tr><td colspan="2" align="center">';
    echo '<input type="submit" value="Logowanie"></td></tr>';
    echo '</table></form>';
  }
?>
  </div>
</div>
<div id="menu">
    <ul>
      <li><a id="kontakt" href="kontakt.php"></a></li>
      <li><a id="rezerwacja" href="rezerwacja.php"></a></li>
	  <li><a id="rejestracja" href="rejestracja.php"></a></li>
	  <li><a id="wyslij_email" href="wyslij_email.php"></a></li>
    </ul>
</div>
