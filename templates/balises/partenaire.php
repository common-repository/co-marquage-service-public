<div id="partenaire" class="panel-sat">
    <div class="panel-heading">
        <h2>Réalisé en partenariat avec&nbsp;:</h2>
    </div>
    
    <div class="panel-body">
        <ul id="listePartenaires" class="list-arrow">
        <?php foreach($data as $partenaire) { ?>
            <li>
            <a href="<?php echo $partenaire['attributes']['url']; ?>" target="_blank" rel="noopener noreferrer" title="<?php echo $partenaire['attributes']['url']; ?> - Nouvelle fenêtre">
                <?php echo $partenaire['attributes']['url']; ?>
                <span aria-hidden="true" class="icon icon-external-link"></span>
            </a>
            </li>
        <?php } ?>
        </ul>
    </div>
</div>