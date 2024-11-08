<?php

if($request->check($session->get("success"))){?>

<div class="alert alert-success" ><?php
    echo $session->get("success");
?></div>

<?php }
$session->remove("success");


?>