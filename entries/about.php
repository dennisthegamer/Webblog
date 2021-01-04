<?php
session_start();
require "../includes/functions.php";
require "../includes/connection.php";
myheader();

//Dieser SQL - Befehl dient zur Auswahl der Daten aus der Datenbank, welche Daten er auswhälen soll, aus welcher Tabelle und in welcher Reihenfolge. 
$sql = "SELECT username, vname, nname, age, behinderung, hobbys From benutzer Order by id DESC";







// Die Schleife geht über die komplette Datenbank, und gibt so alle Daten, die vorher im SQL befehl angegeben wurden sind, aus.
foreach($dbh -> query ($sql) as $row){
  
  $usernamee = $row['username'];
  $sqlbild = $dbh->prepare("SELECT file_name, username from bilder WHERE username = :username Order by uploaded_on DESC");
  $sqlbild -> setFetchMode(PDO::FETCH_ASSOC);
  $sqlbild ->bindValue(':username',$usernamee);
  $sqlbild -> execute();
  $data = $sqlbild-> fetch();


  // Die Ausgabe der Daten laufen über den "echo". Die Daten sind in in einem DIV-Container um den Style bei zu behalten.
  echo          '<div class="user">'.
                    '<div class="usertext">'."<br>"."<br>".
                        "Username: ".$usernamee."<br>".
                        "Vorname: ".$row['vname']."<br>".
                        "Alter: " .$row['age']."<br>".
                        "Was habe ich für eine behinderung: " .$row['behinderung']."<br>".
                        "Hobbys: ".$row['hobbys']."<br>".
                    '</div>'."<br>"."<br>".
                      '<div class="bild"> <img src= ../pics/'.$data['file_name'].'> </div>'.
                
                '<?php endforeach ?>'.
                '</div>';           
  }
 


myFooter();
?>