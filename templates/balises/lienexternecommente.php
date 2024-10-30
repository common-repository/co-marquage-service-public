<ul class="bloc-lienexternecommente">
<?php foreach ($data as $lienexterne) {
    $lien_a = $lienexterne['children']['a'][0];
    ?>
    <li>
        <p class="panel-link"><a href="<?php echo $lien_a['attributes']['href']; ?>" target="<?php echo $lien_a['attributes']['target']; ?>">
            <?php echo $lien_a['text']; ?>&nbsp;
            <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/external-link.svg"); ?>
        </a></p>
        <p class="panel-source"><?php echo $lienexterne['children']['source'][0]['text']; ?></p>
    </li>
    <?php
} ?>
</ul>