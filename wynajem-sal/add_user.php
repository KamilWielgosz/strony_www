<center>

</br>
</br>
</br>

<?php
$host_name="localhost";
$user_name="root";
$db_name="wynajem_sal";
$db=mysqli_connect($host_name, $user_name);
mysqli_select_db($db, $db_name);


$sql_query_czy_istnieje_uzytkownik = "select imie from osoba where login = '{$_POST["login"]}'";
$sql_result_czy_istnieje_uzytkownik=mysqli_query($db, $sql_query_czy_istnieje_uzytkownik);


$sql_row=mysqli_fetch_array($sql_result_czy_istnieje_uzytkownik);



  if(!$sql_row["imie"]){
    $sql_query="insert into osoba(IMIE, NAZWISKO, LOGIN, HASLO, NR_TELEFONU) values('{$_POST["name"]}','{$_POST["surname"]}','{$_POST["login"]}','{$_POST["haslo"]}','{$_POST["phone"]}')";
    $sql_result=mysqli_query($db, $sql_query);
  echo '<h1>Użytkownik dodany</h1>';
  } else {
  echo '<h1>Istnieje uzytkownik z takim loginem</h1>';
  }
mysqli_close($db);
?>
<a href="index.php">Powrót do strony głównej</a>
</center>
