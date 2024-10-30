<?php
if(isset($data[0]['children'])){
    echo '<h3>'. $data[0]['children']['paragraphe'][0]['text'] .'</h3>';
} else {
    echo '<h3>'.$data[0]['text'].'</h3>';
}