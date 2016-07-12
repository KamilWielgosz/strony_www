<?php
require('naglowek.php');
?>


<center>


<?php
$host_name="localhost";
$user_name="root";
$db_name="wynajem_sal";
$koszt_calkowity = 100;

if($_POST["nr_sali1"] != "brak"){
   $nr_sali = $_POST["nr_sali1"];
} else if($_POST["nr_sali2"] != "brak") {
   $nr_sali = $_POST["nr_sali2"];
} else if($_POST["nr_sali3"] != "brak") {
   $nr_sali = $_POST["nr_sali3"];
} else if($_POST["nr_sali4"] != "brak") {
   $nr_sali = $_POST["nr_sali4"];
} else if($_POST["nr_sali5"] != "brak") {
   $nr_sali = $_POST["nr_sali5"];
} else if($_POST["nr_sali6"] != "brak") {
   $nr_sali = $_POST["nr_sali6"];
} else if($_POST["nr_sali7"] != "brak") {
   $nr_sali = $_POST["nr_sali7"];
} else if($_POST["nr_sali8"] != "brak") {
   $nr_sali = $_POST["nr_sali8"];
}


if(isset($_POST["wydzial1"])){
   $id_budynku = $_POST["wydzial1"];
} else if(isset($_POST["wydzial2"])){
   $id_budynku = $_POST["wydzial2"];
} else if(isset($_POST["wydzial3"])){
   $id_budynku = $_POST["wydzial3"];
} else if(isset($_POST["wydzial4"])){
   $id_budynku = $_POST["wydzial4"];
} else if(isset($_POST["wydzial5"])){
   $id_budynku = $_POST["wydzial5"];
} else if(isset($_POST["wydzial6"])){
   $id_budynku = $_POST["wydzial6"];
} else if(isset($_POST["wydzial7"])){
   $id_budynku = $_POST["wydzial7"];
} else if(isset($_POST["wydzial8"])){
   $id_budynku = $_POST["wydzial8"];
}



$db=mysqli_connect($host_name, $user_name);
mysqli_select_db($db, $db_name);
$sql_query_sala = "UPDATE sala SET dostepnosc = 0 WHERE nr_sali = ".$nr_sali." and id_budynku = ".$id_budynku;

$sql_query_id_osoby = "select id_osoby from osoba where login = '{$_SESSION['prawid_uzyt']}'";

$sql_result1=mysqli_query($db, $sql_query_id_osoby);
$sql_row=mysqli_fetch_array($sql_result1);

$sql_query_rezerwacja="insert into rezerwacja(GODZINA_ROZPOCZECIA, GODZINA_ZAKONCZENIA, DATA_ROZPOCZECIA, DATA_ZAKONCZENIA, ID_OSOBY) values('{$_POST["t_beg"]}','{$_POST["t_end"]}','{$_POST["d_beg"]}','{$_POST["d_end"]}','{$sql_row["id_osoby"]}')";

$sql_result2=mysqli_query($db, $sql_query_rezerwacja);
$sql_result3=mysqli_query($db, $sql_query_sala);

$sql_query_id_rezerwacji = "select max(id_rezerwacji) from rezerwacja ";
$sql_result2=mysqli_query($db, $sql_query_id_rezerwacji);
$sql_row1=mysqli_fetch_array($sql_result2);

 
$sql_query_sala1 = "UPDATE sala SET id_rezerwacji = ".$sql_row1[0]." WHERE nr_sali = ".$nr_sali." and id_budynku = ".$id_budynku;
$sql_result4=mysqli_query($db, $sql_query_sala1);


$sql_koszt="call koszt(".$sql_row1[0].")";
$sql_result5=mysqli_query($db, $sql_koszt);
$sql_row2=mysqli_fetch_array($sql_result5);
echo "Calkowity koszt: ".$sql_row2[0];

/*(isset($_POST["sprzet1"]))
{
	echo "jestem";
   $id_sprzetu = $_POST["sprzet1"];
   echo $nr_sali.$id_sprzetu;
   $sql_query_sprzet = "update sprzet set dostepnosc=0, id_sali=".$nr_sali."where id_sprzetu=".$id_sprzetu;
   $sql_result5=mysqli_query($db, $sql_query_sprzet);
   echo $sql_result5;
   $sql_query_sprzet = "insert into rezerwacja_sprzet values (".$sql_query_id_rezerwacji.", ".$id_sprzetu.")";
   $sql_result5=mysqli_query($db, $sql_query_sprzet);
}*/

?>
<h1>Rezerwacja zakończona</h1>
</br>
</br>
</br>
<?php
mysqli_close($db);
?>
<a href="index.php">Powrót do strony głównej</a>
</center>
</div>

</body>
</html>
