<?php
$internBaseURL = $this->url;
$serviceURL = $data['children']['lienweb'][0]['attributes']['url'];
?>

<div id="co-page" class="fiche">

    <?php $this->callRoot( $data, 'fildariane' ); ?>

    <?php $this->callRoot( $data, 'dc:type' ); ?>

    <?php $this->callRoot( $data, 'dc:title' ); ?>

    <p class="date">
        <?php $this->callRoot( $data, 'dc:date' ); ?>
        <?php $this->callRoot( $data, 'dc:contributor' ); ?>
    </p>

    <div class="co-content">
        <div class="service-in-content">
            <?php $this->callRoot( $data, 'texte' ); ?>
            <?php if (isset($data['children']['lienweb'])): ?>
                <div class="demarche-button">
                    <?php if ($data['attributes']['type'] == 'Téléservice' || $data['attributes']['type'] == 'Téléservice personnalisé sur SP'): ?>
                        <p class="service-button">
                            <a href="<?php echo $serviceURL ?>" class="co-btn co-btn-primary" target="_blank">
                                Accéder au service en ligne &nbsp;
                                <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/external-link.svg"); ?>
                            </a>
                        </p>
                        <?php if (isset($data['children']['lienweb'][0]['children']['source'])) echo '<p class="service-source">'.$data['children']['lienweb'][0]['children']['source'][0]['text'].'</p>'?>
                    <?php elseif ($data['attributes']['type'] == 'Formulaire'): ?>
                        <p class="service-button">
                            <a href="<?php echo $serviceURL ?>" class="co-btn co-btn-primary" target="_blank">
                                Accéder au formulaire
                                <?php
                                $format = (isset($data['attributes']['format']) && $data['attributes']['format'] == 'application/pdf')? 'pdf - ' : '';
                                $poids = (isset($data['attributes']['poids']))? $data['attributes']['poids'] : '';
                                if($poids || $format) {
                                    echo '('. $format . $poids .')';
                                }
                                ?>
                                &nbsp; <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/external-link.svg"); ?>
                            </a>
                        </p>
                        <?php if (isset($data['children']['lienweb'][0]['children']['source'])) echo '<p class="service-source">'.$data['children']['lienweb'][0]['children']['source'][0]['text'].'</p>'?>
                    <?php elseif ($data['attributes']['type'] == 'Modèle de document'): ?>
                        <p class="service-button">
                            <a href="<?php echo $serviceURL ?>" class="co-btn co-btn-primary" target="_blank">
                                Accéder au modèle de document &nbsp;
                                <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/external-link.svg"); ?>
                            </a>
                        </p>
                        <?php if (isset($data['children']['lienweb'][0]['children']['source'])) echo '<p class="service-source">'.$data['children']['lienweb'][0]['children']['source'][0]['text'].'</p>'?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div><!-- co-content -->

    <div class="co-annexe">
        <?php $this->callRoot( $data, 'ficheliee' ); ?>

    </div><!-- co-annexe -->

</div><!-- co-page -->
