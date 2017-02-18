<?php

$constants = file('config.ini');
foreach ($constants as $constant) {
    $constant = explode('=', trim($constant));
    define($constant[0], $constant[1]);
}

?>