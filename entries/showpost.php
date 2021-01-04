<?php
session_start();
require "../includes/functions.php";
require "../includes/connection.php";
myheader();

// Hier wird aus der URL die ID Nummer des zu öffenden Text ausgelesen.
$id = $_GET['id']; 
// Der SQL befehl nimmt alle daten aus der tabelle eintraege mit der jeweiligen ID des zu öffnenden Textes.
$sql = "SELECT * FROM eintraege WHERE id = $id ";

?>
<!-- Dieser DIV Container sorgt dafür dass der Text und die Überschrift Jedes Mal an der gleichen Stelle ist und gleich aussieht -->
<div class="vollerpost">
    <!-- Die nachfolgende Schleife geht über Die Datenbank. -->
    <?php foreach ($dbh->query($sql, PDO::FETCH_ASSOC) as $row): ?>
        <!-- um die So geforderten Daten auszugeben -->
        <h2 class="post-title"> <?=$row['ueberschrift']?> </h2>
            <?=$row['text']?>
        <!-- Eine einfache Ausgabe von wem und wann der Text erstellt worden ist. -->
        <p>geposted von <?=$row['username'] ?> am <?=$row['inserted_at']?> </p>

    <hr>

    <!-- Diese Form beinhaltet den zurück Button, um an die genau gleiche Stelle zu gelangen, wo man Vorher gewesen ist. -->
    <form>
        <input id="backpost" type="button" value="Zurück" onclick="history.back()">
    </form>

</div>

<?php endforeach ?>

<?php
myFooter();
?>