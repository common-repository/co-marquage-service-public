<div class="co-sous-theme">
    <ul class="dossiers">
        <?php foreach($data as $dossier) { ?>
            <li>
                <a href="<?php echo $url . $dossier['attributes']['id']; ?>">
                    <?php echo $dossier['children']['titre'][0]['text']; ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>