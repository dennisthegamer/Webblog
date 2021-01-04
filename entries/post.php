<?php 
session_start();
require "../includes/functions.php";
require "../includes/connection.php";
myheader();
?>
<!-- Zwei simple Überschriften -->
<h1 id="h1start">Leben und erleben mit Behinderung!</h1>
<h2 id="h2start">Es ist noch nicht vorbei, man kann trotzdem sein Leben leben!</h2>

<?php
// Hier wird ausgewählt, was für Daten aus der Datenbank und aus welcher Spalte es entnommen werden soll.
$sql = "SELECT * FROM eintraege Order By id DESC";
// Eine Schleife die über die Datenbank läuft um die Objekte zurück zu geben.
foreach($dbh -> query ($sql) as $row)

?>
<!-- Um alle Vorschautexte gleich aussehen zulassen & um alle Daten vordentlich zu halten. -->
<div class="post-text">
  <!-- Die Schleife geht über die komplette Datenbank, und gibt so alle Daten, die vorher im SQL befehl angegeben wurden sind, aus. -->
  <?php foreach ($dbh->query($sql, PDO::FETCH_ASSOC) as $row):  ?>
    <!-- Das die Überschrift anklickbar ist mit der richtigen ID aus der Datenbank zum vollen Artikel geführt wird. -->
    <a href="showpost.php?id=<?=$row['id']?>">
        <!-- Die ausgabe der Überrschrift. Sie wird aus der Datenbank geladen. -->
        <h2 class="post-title"> <?=$row['ueberschrift']?> </h2> </a>
        <!-- Hier wird angegeben das nur die ersten 200 aus den String ausgegeben werden, dies dient als Vorschau. -->
        <?=substr($row['text'], 0, 200)?> ...
        <br>
        <!-- Eine einfache Ausgabe, von wem der Artikel kommt & wann er verfasst wurde. -->
          <p>geposted von <?=$row['username'] ?> am <?=$row['inserted_at']?> </p>
        <hr>
      <br>
  <!-- Hiermit wird die oben angefangene Schleife beendet. -->
  <?php endforeach ?>
</div>

<?php
myFooter();
?>