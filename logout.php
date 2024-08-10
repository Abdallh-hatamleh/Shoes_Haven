<?php 


setcookie('user', 'admin', time() - 86400, '/');
setcookie('userid', "0", time() - 86400, '/');

header('Location: index.php');
exit();