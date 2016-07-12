<?php
require('naglowek.php');
?>

<center>

<h1>Zarejestruj się</h1>


<form action = "add_user.php" method = "post">  
<table>  
<tr><td>Imie</td><td><input type="text" name="name" size=30></td></tr>  
<tr><td>Nazwisko</td><td><input type="text" name="surname" size=30></td></tr>  
<tr><td>Login</td><td><input type="text" name="login" size=30></td></tr>  
<tr><td>Haslo</td><td><input type="password" name="haslo" size=30></td></tr>  
<tr><td>Telefon</td><td><input type="text" name="phone" size=30></td></tr>  
</table>  
 
 <input type = "submit" name = "dodaj" value = "Dodaj">  
 </form>

 </br>
 </br>
 
</center>




</div>

</body>
</html>