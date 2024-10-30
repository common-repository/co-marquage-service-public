<?php
foreach($data as $tableau) {
    $tableau_childs = $tableau['children'];

    echo "<table class='table'>";

    if(isset($tableau_childs['titre'])){
        echo '<caption>'.$tableau_childs['titre'][0]['text'].'</caption>';
        array_shift($tableau_childs);
        $tableau['children'] = $tableau_childs;
    }

    $this->parse($tableau);

    echo '</table>';
}