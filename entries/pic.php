
    <?php
        require "../includes/connection.php";
        $sqlbild = $dbh->prepare("SELECT file_name, username from bilder WHERE username = 'Dennis96' ");
        $sqlbild -> setFetchMode(PDO::FETCH_ASSOC);
        $sqlbild -> execute();

        while ($data = $sqlbild-> fetch()) {
    ?> 
   
        <?php echo $data['username']; ?> 
      <img src="../pics/<?php echo $data['file_name']; ?>" width="100" height="100">  
    <?php } ?>
   