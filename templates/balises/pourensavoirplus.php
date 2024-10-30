<div class="fiche-bloc">
    <div class="fiche-item sat-deplie">
        <div class="fiche-item-title">
            <h3><span>Pour en savoir plus</span></h3>
        </div>
    </div>
    <div class="fiche-item-content">
        <div class="panel-sat ">
            <ul class="list-arrow">
                <?php foreach($data as $plus) {  ?>
                <li>
                    <p class="panel-link">
                        <a href="<?php echo $plus['attributes']['url']; ?>" target="_blank">
                            <?php echo $plus['children']['titre'][0]['text']; ?>
                            <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/external-link.svg"); ?>
                        </a>
                    </p>
                    <p class="panel-source">
                        <?php echo $plus['children']['source'][0]['text']; ?>
                    </p>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>