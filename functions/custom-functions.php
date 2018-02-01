<?php

/**
  * Prints an easy-to-read debugging output
  *
  * @param mixed $data the array, object or string of information to output
  * @param bool $pre Sets whether <pre> is used or not
  * @param mixed $title An optional title for the output
  * @param bool $die Determines whether the script is halted after output
  *
  * @return void
  */
function print_debug($data, $pre = true, $title = false, $die = false) {
    if ($pre) echo '<pre><br /><br /><br /><br /><br />';
    if ($title) echo $title;
    print_r($data);
    if ($pre) echo '</pre>';
    if ($die) die();
}

?>
