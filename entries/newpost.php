<?php
session_start();
require "../includes/functions.php";
myheader();

    // Mit dieser if abfrage wird sichergestellt das der User eingelogt ist, wenn nicht wird er zur "login" page weitergeleitet.
    if(!isset($_SESSION["username"])){
        header("Location: ../login/login.php");
    }
?>
    <!-- Der nachstehende "form" beinhaltet das neuer post formular -->
    <form action="newpost.php" method="post" style="max-width:750px;margin:auto">
    <h2 class="hanm">Neuer Post</h2>
        <div class="eingabefeld">
            <i class="fa fa-send icon"></i>
            <input placeholder="Hier kommt die Überschrift rein..." class="eingabefeld-text" type="text"  name="ueberschrift">
      
        </div>
        
        <div class="eingabefeld">
            <i class="fa fa-pencil icon"></i>
            <textarea name="text" rows="10" cols="95"  placeholder="Hier kommt der Text rein..."></textarea>

        </div>

  <button type="submit" class="btn" name="posten">Posten</button>


<?PHP
    // Hier werden die Inhalte der Variablen angenommen.
    $ueberschrift = $_POST['ueberschrift'];
    $text = $_POST['text'];
    $username = $_SESSION['username'];

    // Zu nächst wird überprüft ob der btn "posten" betätigt wurden ist.
    if(isset($_POST['posten'])){
        // Wenn ja wird zunächst überprüft ob alle felder ausgefüllt worden sind.
        if(!isset($ueberschrift) || trim($ueberschrift) == '')
        {
        echo "Du musst alle Felder ausfüllen! Überschrift fehlt!";
        }
        elseif(!isset($text) || trim($text) == '')
        {
        echo "Du musst alle Felder ausfüllen! Text fehlt!";
        }
        // Wenn die Felder ausgefüllt sind, werden die Daten in die Datenbank gefüllt.
        else{
            require "../includes/connection.php";
            $sql = "INSERT INTO eintraege (username, ueberschrift, text, inserted_at) VALUES (:username, :ueberschrift, :text, current_timestamp)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':ueberschrift', $ueberschrift);
            $stmt->bindValue(':text',$text);
            $stmt->bindValue(':username',$username);
    
            $stmt->execute();
        }
       
    }

?>

<?php
myFooter();
?>