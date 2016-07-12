<?php
require('naglowek.php');

  if(!isset($_SESSION['prawid_uzyt'])){
    echo '<center>';
         echo '<h3>Zaloguj się aby móc wynająć sale</h3>';
    echo '<center>';
	 echo '</br>';
	 echo '</br>';
     echo '</br>';
  } else {
?>

<center>
<h1> Wybierz wydział, na którym chcesz wynająć sale </h1>
</center>

<a style="margin-left: 20px;">*Zaznacz ptaszkiem wydział, na którym chcesz wynająć sale i wybierz numer sali z rozwijanej 

listy</a>

</br>
</br>
<form action = "rezerwacja_dodaj.php" method = "post">  

<?php
		     $host_name="localhost";  
             $user_name="root";  
             $db_name="wynajem_sal";  
             $db=mysqli_connect($host_name,$user_name);  
             mysqli_select_db($db, $db_name);
			 
			$sql_query = "SELECT DATA_ZAKONCZENIA, GODZINA_ZAKONCZENIA, ID_REZERWACJI FROM REZERWACJA WHERE ID_REZERWACJI IN (SELECT ID_REZERWACJI FROM SALA WHERE DOSTEPNOSC=0)"; 
             $sql_result=mysqli_query($db,$sql_query);  
			 while($sql_row=mysqli_fetch_array($sql_result))
			 {
			 $sql_query = "SELECT TIMESTAMPDIFF(hour, now(), concat('{$sql_row["DATA_ZAKONCZENIA"]}',  ' ','{$sql_row["GODZINA_ZAKONCZENIA"]}')) FROM REZERWACJA";
				$sql_result_diff=mysqli_query($db,$sql_query);
				$sql_row_diff=mysqli_fetch_array($sql_result_diff);
				if($sql_row_diff[0]<0)
				{
					mysqli_query($db, "UPDATE sala SET DOSTEPNOSC=1, ID_REZERWACJI=NULL WHERE ID_REZERWACJI='{$sql_row["ID_REZERWACJI"]}'");
					mysqli_query($db, "DELETE FROM rezerwacja WHERE ID_REZERWACJI='{$sql_row["ID_REZERWACJI"]}'");
				}
				
			 }
				
?>

 <table>
 <tr> 
 <td style="padding-left:53px;">
 <a>Sala:</a>
  	<select name="nr_sali1">
		<option value="brak">--------//--------</option>
		<?php 
			 $sql_query = "select nr_sali, koszt_sali from sala where dostepnosc = 1 and id_budynku = 1"; 
             $sql_result=mysqli_query($db,$sql_query);  
             while($sql_row=mysqli_fetch_array($sql_result)) 
             echo "<option value=".$sql_row["nr_sali"].">nr. ".$sql_row["nr_sali"].", ".$sql_row["koszt_sali"]." zł/h"."</option>";  
		?>					
	</select>
 <a><input type="checkbox" name="wydzial1" value="1" /></a>
 </td>
  <td style="padding-left:53px;">
 <a>Sala:</a>
 	<select name="nr_sali2">
		<option value="brak">--------//--------</option>
		<?php 
			 $sql_query = "select nr_sali, koszt_sali from sala where dostepnosc = 1 and id_budynku = 2"; 
             $sql_result=mysqli_query($db,$sql_query);  
             while($sql_row=mysqli_fetch_array($sql_result)) 
             echo "<option value=".$sql_row["nr_sali"].">nr. ".$sql_row["nr_sali"].", ".$sql_row["koszt_sali"]." zł/h"."</option>";   
		?>					
	</select>
 <a><input type="checkbox" name="wydzial2" value="2" /></a>
 </td>
  <td style="padding-left:53px;">
 <a>Sala:</a>
 	<select name="nr_sali3">
		<option value="brak">--------//--------</option>
		<?php 
			 $sql_query = "select nr_sali, koszt_sali from sala where dostepnosc = 1 and id_budynku = 3"; 
             $sql_result=mysqli_query($db,$sql_query);  
             while($sql_row=mysqli_fetch_array($sql_result)) 
             echo "<option value=".$sql_row["nr_sali"].">nr. ".$sql_row["nr_sali"].", ".$sql_row["koszt_sali"]." zł/h"."</option>";  
		?>					
	</select>
 <a><input type="checkbox" name="wydzial3" value="3" /></a>
 </td>
  <td style="padding-left:53px;">
 <a>Sala:</a>
 	<select name="nr_sali4">
		<option value="brak">--------//--------</option>
		<?php 
			 $sql_query = "select nr_sali, koszt_sali from sala where dostepnosc = 1 and id_budynku = 4"; 
             $sql_result=mysqli_query($db,$sql_query);  
             while($sql_row=mysqli_fetch_array($sql_result)) 
             echo "<option value=".$sql_row["nr_sali"].">nr. ".$sql_row["nr_sali"].", ".$sql_row["koszt_sali"]." zł/h"."</option>";  
		?>					
	</select>
 <a><input type="checkbox" name="wydzial4" value="4" /></a>
 </td>

 </tr>
 </table>


 <table>
 <tr> 
 <td><a><img src="obrazki/zdjecie1.png" width="180" height="150" style="padding-left:50px; padding-bottom: 20px;"></a></td>
 <td><a><img src="obrazki/zdjecie2.png" width="180" height="150" style="padding-left:50px; padding-bottom: 20px;"></a></td>
 <td><a><img src="obrazki/zdjecie3.png" width="180" height="150" style="padding-left:50px; padding-bottom: 20px;"></a></td>
 <td><a><img src="obrazki/zdjecie4.png" width="180" height="150" style="padding-left:50px; padding-bottom: 20px;"></a></td>
 </tr>
 </table>

 
 <table>
 <tr> 
 <td style="padding-left:53px;">
 <a>Sala:</a>
 	<select name="nr_sali5">
		<option value="brak">--------//--------</option>
		<?php 
			 $sql_query = "select nr_sali, koszt_sali from sala where dostepnosc = 1 and id_budynku = 5"; 
             $sql_result=mysqli_query($db,$sql_query);  
             while($sql_row=mysqli_fetch_array($sql_result)) 
             echo "<option value=".$sql_row["nr_sali"].">nr. ".$sql_row["nr_sali"].", ".$sql_row["koszt_sali"]." zł/h"."</option>";  
		?>					
	</select>
 <a><input type="checkbox" name="wydzial5" value="5" /></a>
 </td>
  <td style="padding-left:53px;">
 <a>Sala:</a>
 	<select name="nr_sali6">
		<option value="brak">--------//--------</option>
		<?php 
			 $sql_query = "select nr_sali, koszt_sali from sala where dostepnosc = 1 and id_budynku = 6"; 
             $sql_result=mysqli_query($db,$sql_query);  
             while($sql_row=mysqli_fetch_array($sql_result)) 
             echo "<option value=".$sql_row["nr_sali"].">nr. ".$sql_row["nr_sali"].", ".$sql_row["koszt_sali"]." zł/h"."</option>";  
		?>					
	</select>
 <a><input type="checkbox" name="wydzial6" value="6" /></a>
 </td>
  <td style="padding-left:53px;">
 <a>Sala:</a>
 	<select name="nr_sali7">
		<option value="brak">--------//--------</option>
		<?php 
			 $sql_query = "select nr_sali, koszt_sali from sala where dostepnosc = 1 and id_budynku = 7"; 
             $sql_result=mysqli_query($db,$sql_query);  
             while($sql_row=mysqli_fetch_array($sql_result)) 
             echo "<option value=".$sql_row["nr_sali"].">nr. ".$sql_row["nr_sali"].", ".$sql_row["koszt_sali"]." zł/h"."</option>";  
		?>					
	</select>
 <a><input type="checkbox" name="wydzial7" value="7"/></a>
 </td>
  <td style="padding-left:53px;">
 <a>Sala:</a>
 	<select name="nr_sali8">
		<option value="brak">--------//--------</option>
		<?php 
			 $sql_query = "select nr_sali, koszt_sali from sala where dostepnosc = 1 and id_budynku = 8"; 
             $sql_result=mysqli_query($db,$sql_query);  
             while($sql_row=mysqli_fetch_array($sql_result)) 
             echo "<option value=".$sql_row["nr_sali"].">nr. ".$sql_row["nr_sali"].", ".$sql_row["koszt_sali"]." zł/h"."</option>";  
		?>					
	</select>
 <a><input type="checkbox" name="wydzial8" value="8" /></a>
 </td>

 </tr>
 </table>
 
  <table>
 <tr> 
 <td><a><img src="obrazki/zdjecie5.png" width="180" height="150" style="padding-left:50px; padding-bottom: 20px;"></a></td>
 <td><a><img src="obrazki/zdjecie6.png" width="180" height="150" style="padding-left:50px; padding-bottom: 20px;"></a></td>
 <td><a><img src="obrazki/zdjecie7.png" width="180" height="150" style="padding-left:50px; padding-bottom: 20px;"></a></td>
 <td><a><img src="obrazki/zdjecie8.png" width="180" height="150" style="padding-left:50px; padding-bottom: 20px;"></a></td>
 </tr>
 </table>

 <?php
 mysqli_close($db);
 ?>
 
 <center>
 <h1> Wybierz sprzęt </h1>
   <a><input type="checkbox" name="sprzet1" value="1"/></a>
   <a><img src="obrazki/rzutnik.jpg" width="180" height="150"></a>
</center>
 
 
  <center>
 <h1> Wybierz okres wynajmu </h1>
</center>

  <center>
<table>  
<tr><td>Data rozpoczęcia</td><td><input type="text" name="d_beg" value="RRRR-MM-DD" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-

9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))"></td></tr>  
<tr><td>Data zakończenia:</td><td><input type="text" name="d_end" value="RRRR-MM-DD" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-

9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))"></td></tr>  
<tr><td>Godzina rozpoczęcia:</td><td><input type="text" pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}" 

name="t_beg" value="00:00" size=5></td></tr>  
<tr><td>Godzina zakończenia:</td><td><input type="text" pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}" 

name="t_end" value="00:00" size=5></td></tr>     
</table>  

 </br>
 </br>
 </br>
 
 <input type = "submit" name = "dodaj" value = "Dodaj">  
  </center>
 </form>
 
 
 
 <?php
    }
 ?>
 
 
 
</div>

</body>
</html>
