<?php
$internBaseURL = $this->url;
?>

<div id="co-page" class="fiche">

    <?php $this->callRoot( $data, 'fildariane' ); ?>

    <?php $this->callRoot( $data, 'dc:title' ); ?>

    <div class="co-content">
        <?php
        $firstItt = true;
        foreach ($data['children']['groupe'] as $groupe):
            $titre = (isset($groupe['children']['titre'][0]['text'] ) ) ? $groupe['children']['titre'][0]['text'] : null;

            if($firstItt == true):
                $tokenglobal = $this->token();
        ?>
                <p class="tool-slide">
                    <button class="btn-up" data-co-action="slideall-up" type="button" data-co-target="#<?php echo $tokenglobal; ?>">Tout replier <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/chevron-up.svg"); ?></button>
                    <button class="btn-down" data-co-action="slideall-down" type="button" data-co-target="#<?php echo $tokenglobal; ?>" >Tout déplier <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/chevron-down.svg"); ?> </button>
                </p>

                <div class="fiche-bloc bloc-principal" id="<?php echo $tokenglobal; ?>">
            <?php
                $firstItt = false;
            endif; ?>
            <div class="fiche-item fiche-slide">
                <div class="fiche-item-title">
                    <h2>
                        <button class="co-btn co-btn-slide" data-co-action="slide" type="button" data-co-target="#<?php echo $groupe['token']; ?>" role="button">
                            <span><?php echo $titre; ?> </span>
                            <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/chevron-down.svg"); ?>
                        </button>
                    </h2>
                </div>

                <div class="fiche-item-content co-hide" id="<?php echo $groupe['token']; ?>">
                    <ul class="list-arrow">
                        <?php foreach ($groupe['children']['questionreponse'] as $questionreponse): ?>
                            <li><a href="<?php echo $internBaseURL.$questionreponse['attributes']['id'] ?>"><?php echo $questionreponse['text'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div><!-- co-content -->

</div><!-- co-page -->
