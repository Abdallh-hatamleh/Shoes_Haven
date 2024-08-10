<?php 

setcookie('user', 'customer', time() - 86400, '/');
setcookie('userid', 'customer', time() - 86400, '/');
var_dump($_COOKIE);