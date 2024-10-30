<?php
use \Kienso\Comarquage\Config;
?>

<div id="co-footer">
    <div class="mentions">
        <p>
            &copy;
            <a href="https://www.dila.premier-ministre.gouv.fr" target="_blank">Direction de l'information l&eacute;gale et administrative</a>
            <?php if ( Config::$options->comarquage_global_poweredby ) : ?>
                <br> comarquage developpé par <a href="https://www.baseo.io/" target="_blank">baseo.io</a>
            <?php endif; ?>
        </p>
    </div>
</div>
