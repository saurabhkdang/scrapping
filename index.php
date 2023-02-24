<?php
ini_set('memory_limit', '-1');
require('simple_html_dom.php');

$html = file_get_html('http://www.sdadmission.in/center/update-center.php?id=1');

echo '<pre>';
print_r($html);
exit;

foreach($html->find('input[type=text]') as $checkbox) {
    print_r($checkbox->value);
    /* if ($checkbox->checked)
        echo $checkbox->name . ' is checked<br>';
    else
        echo $checkbox->name . ' is not checked<br>'; */
}
?>