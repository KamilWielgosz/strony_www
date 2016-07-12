<?php

$host_name="localhost";  
$user_name="root";  
$db_name="wynajem_sal";  
$db=mysqli_connect($host_name,$user_name);  
mysqli_select_db($db, $db_name);  
//operacje na baize 


 $sql_query = "select imie from osoba where login = 'kamil'"; 
 $sql_result=mysqli_query($db,$sql_query); 
 $sql_row=mysqli_fetch_array($sql_result);

 
  if($sql_row["imie"]){
    echo 'cos';
  } else {
    echo 'ktos';
  }
 /*
 $sql_result=mysqli_query($db,$sql_query);  
 while($sql_row=mysqli_fetch_array($sql_result)) 
  echo "<br>".$sql_row["nr_sali"]." ";
  */
mysqli_close($db);

/*
?>
<form name="myform" action="" method="POST">
<div align="center"><br>
<input type="checkbox" name="option1" value="Milk"> Milk<br>
<input type="checkbox" name="option2" value="Butter"> Butter<br>
<input type="checkbox" name="option3" value="Cheese"> Cheese<br>
 <input type = "submit" name = "dodaj" value = "Dodaj">  
<br>
</div>
</form>

<?php

if(isset($_POST["option1"])){
echo $_POST["option1"];
} else if(isset($_POST["option2"])){
echo $_POST["option2"];
} else if(isset($_POST["option3"])){
echo $_POST["option3"];
}
*/
?>
