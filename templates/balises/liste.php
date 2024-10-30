<?php
foreach ($data as $liste) {
    echo '<ul class="bloc-liste list-'. $liste['attributes']['type'] .'">';
    $this->parse($liste);
    echo '</ul>';
}