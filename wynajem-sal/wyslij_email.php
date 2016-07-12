<?php
require('naglowek.php');
?>

<center>
<h1>Witaj w systemie email</h1>
 
<p>Na tej stronie możesz wysłać email z zapytaniem<p>
 
<form method="POST">
<p>Twój email:(na jaki chcesz otrzymać odpowiedź)<br />
<input type="text" name="nazwa" size="40" /></p>
 
<p>Temat zapytania:<br />
<input type="text" name="email" size="40" /></p>
 
<p>Treść zapytania:<br />
<textarea name="komentarz" cols="70" rows="12" wrap="virtual"></textarea></p>
<p><input type="submit" value="Wyślij wiadomość" name="submit" /></p>
<input type="hidden" name="pole_formularza" value="ok">
 
</form>
 
<?php
if(isset($_POST['pole_formularza'])) {
  // utworzenie krótkich nazw zmiennych
  $nazwa = $_POST['nazwa'];
  $email = $_POST['email'];
  $komentarz = $_POST['komentarz'];
 
 
  // zdefiniowanie danych statycznych
  $adresdo = "bigos1995-95@o2.pl";
 
  $temat = "Pytanie od klienta";
 
  $zawartosc = "Email klienta: ".$nazwa."\n"
               ."Temat: ".$email."\n"
               ."Treść zapytania: \n".$komentarz."\n";
 
  $adresod = "Pytanie od klienta";
 
  // wywołanie funkcji mail() w
  if(isset($_POST['submit']))  { 
  
mail($adresdo, $temat, $zawartosc, $adresod); 
echo "Wiadomość została wysłana";
} 
 }
?>	 
</center>

</div>

</body>
</html>
