<?php
session_start();
require "../includes/functions.php";
require "../includes/connection.php";

myheader();
?>

<form action="register.php" method="post" style="max-width:750px;margin:auto">
    <h2 class="hanm">Registrieren</h2>
        <div class="eingabefeld">
            <i class="fa fa-send icon"></i>
            <input placeholder="Benutzername" class="eingabefeld-text" type="text"  name="username">
      
        </div>
        <div class="eingabefeld">
            <i class="fa fa-send icon"></i>
            <input placeholder="Vorname" class="eingabefeld-text" type="text"  name="vname">
      
        </div>
        <div class="eingabefeld">
            <i class="fa fa-send icon"></i>
            <input placeholder="Nachname" class="eingabefeld-text" type="text"  name="nname">
      
        </div>
        <div class="eingabefeld">
            <i class="fa fa-send icon"></i>
            <input placeholder="Passwort" class="eingabefeld-text" type="password"  name="passwort">
      
        </div>

        <div class="eingabefeld">
            <i class="fa fa-send icon"></i>
            <input placeholder="Passwort wiederholen" class="eingabefeld-text" type="password"  name="passwort2">
      
        </div>

        <div class="eingabefeld">
            <i class="fa fa-send icon"></i>
            <input placeholder="Alter" class="eingabefeld-text" type="number"  name="age">
      
        </div>
        <div class="eingabefeld">
            <i class="fa fa-send icon"></i>
            <input placeholder="behinderung" class="eingabefeld-text" type="text"  name="behinderung">
      
        </div>
        <div class="eingabefeld">
            <i class="fa fa-send icon"></i>
            <input placeholder="Hobbys" class="eingabefeld-text" type="text"  name="hobbys">
      
        </div>

  <button type="submit" class="btn" name="regis">Registrieren</button>



  <?php
  

    // Hier werden die Inhalte der Variablen angenommen.
   $username = $_POST['username'];
   $vname  = $_POST['vname'];
   $nname = $_POST['nname'];
   $passwort = $_POST['passwort'];
   $passwort2 = $_POST['passwort2'];
   $age = $_POST['age'];
   $behinderung = $_POST['behinderung'];
   $hobbys = $_POST['hobbys'];
    // Zu nächst wird überprüft ob der btn "regis" betätigt wurden ist.
    if($passwort == $passwort2){
    if(isset($_POST['regis'])){
        require "../includes/connection.php";
        $passwort = password_hash($passwort,PASSWORD_BCRYPT);
        $sql = "INSERT INTO benutzer (username, vname, nname, passwort, age, behinderung, hobbys, inserted_at) VALUES (:username_, :vname_, :nname_, :passwort_ ,:age_, :behinderung_ ,:hobbys_, current_timestamp)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':username_', $username);
        $stmt->bindValue(':vname_',$vname);
        $stmt->bindValue(':nname_',$nname);
        $stmt->bindValue(':passwort_',$passwort);
        $stmt->bindValue(':age_',$age);
        $stmt->bindValue(':behinderung_',$behinderung);
        $stmt->bindValue(':hobbys_',$hobbys);
        $stmt->execute(); 
       
        header("Location: ../login/login.php");
       
                    
    }  
    } else{
        echo '<script type="text/javascript" language="Javascript"> alert("Fehler beim Passwort"); </script>';
        // echo "";
    }
?>

<?php
myFooter();
?>
