<?php
$lastRangType = null;

foreach($data as $rangee) {
    switch($rangee['attributes']['type']) {
        case 'header' :
            if($lastRangType != 'header') echo "<thead>";
            $lastRangType = $rangee['attributes']['type'];

            echo "<tr>";
            $this->parse($rangee);
            echo "</tr>";

            break;
        case 'normal' :
            if($lastRangType == 'header') echo "</thead>";
            $lastRangType = $rangee['attributes']['type'];

            echo "<tr>";
            $this->parse($rangee);
            echo "</tr>";

            break;
        default:
            break;
    }
}
