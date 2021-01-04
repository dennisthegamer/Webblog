<?php
session_start();
require "../includes/functions.php";
require "../includes/connection.php";
myheader();
// Zunächst wird aus der url der username extrahiert mit einer globalen Variable.
$usernamee = $_GET['username'];
?>
  <!-- bearbeitung der eingegebenen Daten -->
  

<?php
    // Wenn ein User nicht eingeloggt ist wird er direkt wieder zur login page gesendet.
    if(!isset($_SESSION["username"])){
      header("Location: ../login/login.php");
    }
 
    // Diese SQL-Abfrage beinhaltet zunächst einmal dass die angegebenen Daten mit dem bestimmten Benutzername aus der Datenbank extrahiert werden diese werden in die jeweiligen Spalten eingefügt um sie editieren zu können username ist nicht editierbar
    $stmt = $dbh -> prepare("Select username, vname, age, behinderung, hobbys FROM benutzer WHERE username = '$usernamee'");
    $stmt ->execute(array('username' => $_GET['username'] ));
    $row = $stmt->fetch(); 
    
  ?>
  <!-- ein formular für die daten zum editieren. -->
  <form action="profileedit.php" style="max-width:500px;margin:auto" method="post">
  <h2 class="hanm">Daten bearbeiten</h2>

  <div class="eingabefeld">
    <i class="fa fa-user icon"></i>
    <input class="eingabefeld-text" type="text" readonly name="username" value='<?php echo $row['username'];?>' >
  </div>

  <div class="eingabefeld">
    <i class="fa fa-user icon"></i>
    <input class="eingabefeld-text" type="text" readonly  name="vname" value='<?php echo $row['vname'];?>' >
  </div>
  
  <div class="eingabefeld">
    <i class="fa fa-birthday-cake icon"></i>
    <input class="eingabefeld-text" type="number" name="age" value='<?php echo $row['age'];?>'>
  </div>

  <div class="eingabefeld">
    <i class="fa fa-wheelchair-alt icon"></i>
    <input class="eingabefeld-text" type="text" name="behinderung" value='<?php echo $row['behinderung'];?>'>
  </div>

  <div class="eingabefeld">
    <i class="fa fa-pencil icon"></i>
    <input class="eingabefeld-text" type="text" name="hobbys" value='<?php echo $row['hobbys'];?>'>
  </div>

<input  class="btn" type="submit" value="Speichern" name="speichern">
</form>

<form action="profileedit.php" method="post" style="max-width:500px;margin:auto" enctype="multipart/form-data">
<br> <br>
<h2 class="hanm">Profilfoto bearbeiten</h2>

<div class="eingabefeld">
    <i class="fa fa-image icon"></i>
    <input class="eingabefeld-text" type="file" name="bild"  accept="image/png, image/jpeg">
  </div>
    <input type="submit" value="Hochladen" class="btn" name="fotosave">

</form>


<?php
  // die zu übergebenen variablen.
  $username = $_SESSION['username']; 
  $statusMsg = '';
  $zielpfad = "../pics/";
  $bildname = basename($_FILES["bild"]["name"]);
  $zielbildpfad = $zielpfad . $bildname;
  $fileType = pathinfo($zielbildpfad, PATHINFO_EXTENSION);

  // Erst wird überprüft ob das Formular abgesendet worden ist und nicht leer ist.
  if(isset($_POST["fotosave"]) && !empty($_FILES["bild"]["name"])){
    require "../includes/connection.php";
    // hier wird gesagt welche files erlaubt ist.
    
    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType, $allowTypes)){
        // Upload file zum server.
        if(move_uploaded_file($_FILES["bild"]["tmp_name"], $zielbildpfad)){
            // einfügen des Bild in die Datenbank
            $insert = $dbh->query("INSERT into  bilder (username, file_name, uploaded_on) VALUES ('".$username."','".$bildname."', current_timestamp)");
            
            // Wenn alles geklappt hat, wird man zurück geleitet.
            echo '<meta http-equiv="refresh" content="0; URL=../entries/about.php">';
            // Dient als fehler quelle behebung für den User.
            if($insert){
                $statusMsg = "Das Bild ".$bildname. " wurde erfolgreich hochgeladen";
            }else{
                $statusMsg = "Hochladen fehlgeschlagen.";
            } 
        }else{
            $statusMsg = "Hochladen fehlgeschlagen.";
        }
    }else{
        $statusMsg = 'Sorry, nur JPG, JPEG & PNG Dateien können hochgeladen werden.';
    }
  }else{
    $statusMsg = 'Bitte wähle eine Datei aus die du Hochladen willst!';
  }

  // hier wird der status ausgegeben aus der if abfrage.
  echo ('<p style= "text-align:center">'. $statusMsg .'</p>');
?>


<?PHP
    // Zunächst werden die editierten oder nicht editierten Daten aus der form übernommen
    $vname = $_POST['vname'];
    $age = $_POST['age'];
    $behinderung = $_POST['behinderung'];
    $hobbys = $_POST['hobbys'];
    $usernamee= $_SESSION['username'];
    if(isset($_POST['speichern'])){
        require "../includes/connection.php";
        
        // Dieser SQL-Befehl updatet die neuen Daten
        $sql = "UPDATE benutzer set vname =:vname_, age= :age_, behinderung = :behinderung_, hobbys = :hobbys_ WHERE vname =:vname_ ";
        $stmt = $dbh->prepare($sql);
        
        $stmt->bindValue(':vname_', $vname);
        $stmt->bindValue(':age_',$age);
        $stmt->bindValue(':behinderung_',$behinderung);
        $stmt->bindValue(':hobbys_',$hobbys);
       
        
        $stmt->execute();
        // Nach den man auf speichern gedrückt hat, wird man direkt zur about page weitergeleitet. 
        echo '<meta http-equiv="refresh" content="0; URL=../entries/about.php">';
    }

?>


<?php
myFooter();
?>
