<div class="bloc-fiche">
    <ul>
        <?php foreach($data as $fiche) { ?>
            <li>
                <a href="<?php echo $url . $fiche['attributes']['id']; ?>">
                    <?php echo $fiche['text']; ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>