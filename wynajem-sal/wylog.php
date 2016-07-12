<?php
  session_start();

  $stary_uzyt=$_SESSION['prawid_uzyt']; // przechowanie do sprawdzenie czy logowanie nastąpiło
  unset($_SESSION['prawid_uzyt']);
  session_destroy();
?>
<html>
<body>
<center>
<h1 style="margin-top: 100px;">Wylogowanie</h1>
<?php
  if (!empty($stary_uzyt))
  {
    echo 'Wylogowano.<br />';
  }
  else
  {
    // jeżeli brak zalogowania, lecz w jakiś sposób uzyskany dostęp do strony
    echo 'Użytkownik niezalogowany, tak więc brak wylogowania.<br />';
  }
?>
<a href="index.php">Powrót do strony głównej</a>
</center>
</body>
</html>