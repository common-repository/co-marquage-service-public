<?php $token = $this->token(); ?>

<div class="fiche-bloc fiche-slide">
    <div class="fiche-item">
        <div class="fiche-item-title">
            <h3>
            <button class="co-btn co-btn-slide" data-co-action="slide" data-co-target="#<?php echo $token; ?>" type="button">
                <span>Textes de référence</span>
                <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/chevron-down.svg"); ?>
            </button>
            </h3>
        </div>
    </div>
    <div class="fiche-item-content co-hide" id="<?php echo $token; ?>">
        <div class="panel-sat ">
            <ul class="list-arrow">
                <?php foreach($data as $reference) {  ?>
                <li>
                    <p class="panel-link">
                        <a href="<?php echo $reference['attributes']['url']; ?>" target="_blank">
                            <?php echo $reference['children']['titre'][0]['text']; ?>
                            <?php
                            $format = (isset($reference['attributes']['format']) && $reference['attributes']['format'] == 'application/pdf')? 'pdf - ' : '';
                            $poids = (isset($reference['attributes']['poids']))? $reference['attributes']['poids'] : '';
                            if($poids || $format) {
                                echo '('. $format . $poids .')';
                            }
                            ?>
                            <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/external-link.svg"); ?>
                        </a>
                    </p>
                    <?php if( isset($reference['children']['complement'][0]['text']) ): ?>
                    <p class="panel-comment"><?php echo $reference['children']['complement'][0]['text']; ?></p>
                    <?php endif; ?>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>