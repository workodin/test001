
    <h1><?php echo date("H:i:s") ?></h1>

    <img src="assets/images/photo.jpg" alt="photo">

<?php

// test listing racine
$tabList = glob("/*");
print_r($tabList);

?>