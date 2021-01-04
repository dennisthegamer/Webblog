
<?php
require "../includes/functions.php";

myheader();
// Hiermit wird überprüft, ob der User auf der Submit "einlog" gedrückt hat, wenn ja passiert ein SQL - Abfrage ob die Daten korrekt sind.
  if(isset($_POST["einlog"])){
    require "../includes/connection.php";

    // Die SQL - Abfrage von wo sie die Daten beziehen soll.
    $sql = "SELECT * from benutzer WHERE username = :username";

    $stmt = $dbh -> prepare($sql);
    // Zunächst wird erstmal der username mit der Datenbank verglichen.    
    $stmt->bindParam(":username", $_POST["username"]);
    $_SESSION['username'] = $username;
    $stmt->execute();
    $count = $stmt->rowCount();
    
    // In der nachfolgenden if abfrage, wird das passwort überprüft
    if($count == 1){
      $row = $stmt->fetch();
      // Da das Passwort in der Datenbank als Hashwert gespeicht ist, muss es mit "passwort_verify" überprüft werden.
      if(password_verify($_POST["passwort"], $row["passwort"])){
        session_start();
        $_SESSION["username"] = $row["username"];
        // Wenn alles seine Richtigkeit hat, wird zu "newpost.php" gewechselt.
        header("Location: ../entries/newpost.php");
        // Wenn nicht wird eins der beiden fehler ausgegeben. 1. Fehler: Falsches Passwort - 2. Fehler: Falscher Username
        } else{
        echo '<script type="text/javascript" language="Javascript"> alert("Login fehlgeschlagen falsches Passwort!"); </script>';
      }
    }else{
    echo '<script type="text/javascript" language="Javascript"> alert("Login fehlgeschlagen falscher Usernane!"); </script>';
    }
}

?>
<!-- Der nachstehende "form" beinhaltet das einlog formular -->
<form action="login.php" style="max-width:500px;margin:auto" method="post">
  <h2 class="hanm">Anmelden</h2>
  <div class="eingabefeld">
    <i class="fa fa-user icon"></i>
    <input class="eingabefeld-text" type="text" placeholder="Username" name="username">
  </div>
  
  <div class="eingabefeld">
    <i class="fa fa-key icon"></i>
    <input class="eingabefeld-text" type="password" placeholder="Password" name="passwort">
  </div>

  <button type="submit" class="btn" name="einlog">Einloggen</button> <br>
<a href="register.php" target="_blank" rel="noopener noreferrer"> Noch kein Account? Dann registier dich hier!</a>
</form>


<?php
myFooter();
?>











