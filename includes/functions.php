<!-- Diese Funktion beinhalten den HTML Teil der auf jeder Seite einhaltlich sein soll. In diesem Fall die Navigationsleiste, den Stylesheet und die Meta Angaben. -->
<?php 
error_reporting(0);
function myheader(){ ?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webblog</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<!-- Die Navigationsleiste befindet sich in einem DIV-Container, um einfacher sie an der richtigen stelle zu behalten. -->
<div class="nav-div">
  <!-- Die Navigationsleiste besteht aus einer 'Unordert List' mit den Links als Listen einträge. Mit CSS werden alle eigeschaften getroffen. -->
  <ul id="navleiste">
        <li class="navlinks"><a href="../entries/post.php">Home</a></li>
        <li class="navlinks"><a href="../entries/about.php">Über uns</a></li>

        <?php 
        // Zunächst wird überprüft ob ein User eingeloggt ist.
          if(isset($_SESSION["username"])){
            // Wenn ja wird eine Variable mit dem usernamen angelegt.
            $sesionname = $_SESSION['username']; 
    
            // Die nachfolgenden Ausgaben sind dafür da dass zum einen der logout Button erscheint und der username wenn man auf dem usernamen klickt kommt man zu seinem Profil dass er bearbeiten kann
            echo ('<li style="float:right" class="navlinks" > <a href="../login/logout.php"> Logout  </a></li> <li class="navlinks"> <a href="../entries/newpost.php">Posten</a> </li> ');
            echo ('<li  style="float:right" class="navlinks"> <a href= "../login/profileedit.php?username='); echo $sesionname; echo ('">'); echo $sesionname; echo ('</a> </li>');
          }
          // Falls kein User eingeloggt ist erscheint nur der Login button.
          else {
            echo ('<li style="float:right" class="navlinks"><a href="../login/login.php">Login</a></li>');
          }
          
        ?>
        
  </ul>
</div>

<!-- Die Funktion dient als Endstück für den obrigen Teil. Es beinhalten die schließung des Bodys und HTML Tag. -->
<?php } function myFooter(){ ?>

  </body>

</html>
<?php } ?>
