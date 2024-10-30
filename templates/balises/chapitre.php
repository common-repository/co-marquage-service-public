<?php
$index = 0;
$first = true;

foreach($data as $val) {

    $chapitre = $val['chapitre'];

    // Get and remove titre before parse children
    $titre = ( isset( $chapitre['children'][0]['titre'][0]['children']['paragraphe'][0]['text'] ) ) ? $chapitre['children'][0]['titre'][0]['children']['paragraphe'][0]['text'] : null;

    if(empty($titre)) {

        $this->parse( $chapitre );

    } else {

        // Unset titre. Should not be display twice.
        unset( $chapitre['children'][0]['titre'] );

        if($first) { ?>

            <?php $tokenglobal = $this->token(); ?>
            <p class="tool-slide">
                <button class="btn-up" data-co-action="slideall-up" type="button" data-co-target="#<?php echo $tokenglobal; ?>">Tout replier <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/chevron-up.svg"); ?></button>
                <button class="btn-down" data-co-action="slideall-down" type="button" data-co-target="#<?php echo $tokenglobal; ?>" >Tout déplier <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/chevron-down.svg"); ?> </button>
            </p>

            <div class="fiche-bloc bloc-principal" id="<?php echo $tokenglobal; ?>">
            <?php
            $first = false;
        }
        ?>

        <div class="fiche-item fiche-slide">
            <div class="fiche-item-title">
                <h2>
                    <button class="co-btn co-btn-slide" data-co-action="slide" type="button" data-co-target="#<?php echo $chapitre['token']; ?>" role="button">
                        <span><?php echo $titre; ?> </span>
                        <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/chevron-down.svg"); ?>
                    </button>
                </h2>
            </div>

            <div class="fiche-item-content co-hide" id="<?php echo $chapitre['token']; ?>">
                <?php $this->parse( $chapitre ); ?>
            </div>
        </div>

<?php
    }
$index++;
}
if(!empty($titre)) echo '</div>';
?>