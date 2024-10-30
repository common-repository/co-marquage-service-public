<?php $token = $this->token(); ?>

<?php if($opt['context'] == 'root'): ?>
    <div class="fiche-bloc fiche-slide service-in-root">
        <div class="fiche-item">
            <div class="fiche-item-title">
                <h3>
                    <button class="co-btn co-btn-slide" data-co-action="slide" data-co-target="#<?php echo $token; ?>" type="button">
                        <span>Services en ligne et formulaires</span>
                        <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/chevron-down.svg"); ?>
                    </button>
                </h3>
            </div>
        </div>

        <div class="fiche-item-content co-hide" id="<?php echo $token; ?>">
            <div class="panel-sat">
                <ul class="list-arrow">
                    <?php
                    foreach($data as $service) {
                        if (!empty($service['attributes']['url'])){
                            $serviceURL = $service['attributes']['url'];
                        } else {
                            $serviceURL = $url.$service['attributes']['id'];
                        }
                        ?>
                        <li>
                            <p class="panel-link">
                                <a href="<?php echo $serviceURL; ?>" target="_blank">
                                    <?php echo $service['children']['titre'][0]['text']; ?>
                                </a>
                            </p>
                            <p class="panel-comment"><?php echo $service['attributes']['type']; ?></p>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
<?php else:
    $service = $data[0];
    $service_childs = $service['children'];

    if (!empty($service['attributes']['url'])){
        $serviceURL = $service['attributes']['url'];
    } else {
        $serviceURL = $url .$service['attributes']['id'];
    }
    ?>
    <div class="service-in-content">
        <?php
        if (isset($service_childs['titre'])):
            ?>
            <div class="co-bloc-title">
                <?php if ($service['attributes']['type'] == 'Téléservice' || $service['attributes']['type'] == 'Téléservice personnalisé sur SP' ): ?>
                    <div class="title-icons">
                        <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/exchange.svg"); ?>
                    </div>
                    <p class="title-text">
                        Service en ligne<br/>
                        <strong><?php echo $service_childs['titre'][0]['text'] ?></strong>
                    </p>
                <?php else: ?>
                    <div class="title-icons">
                        <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/file-text-o.svg"); ?>
                    </div>
                    <p class="title-text">
                        <?php echo $service['attributes']['type'] ?> <br/>
                        <strong><?php echo $service_childs['titre'][0]['text'] ?></strong>
                    </p>
                <?php endif; ?>
            </div>
            <?php if (isset($service['attributes']['numerocerfa'])): ?>
                <p class="co-numerocerfa">Cerfa n° <?php echo $service['attributes']['numerocerfa'] ?> </p>
            <?php endif; ?>
            <?php
        endif;

        if (isset($service_childs['introduction'])):
            ?>
            <div class="bloc-introduction">
                <?php
                foreach ($service_childs['introduction'][0]['children'] as $balise_name => $balise_val) :
                    $this->parse_not_children($balise_name, $balise_val);
                endforeach;
                ?>
            </div>
        <?php endif; ?>
        <div class="demarche-button">
            <?php if ($service['attributes']['type'] == 'Téléservice' || $service['attributes']['type'] == 'Téléservice personnalisé sur SP'): ?>
                <p class="service-button">
                    <a href="<?php echo $serviceURL ?>" class="co-btn co-btn-primary" target="_blank">
                        Accéder au service en ligne &nbsp;
                        <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/external-link.svg"); ?>
                    </a>
                </p>
                <?php if (isset($service_childs['source'])) echo '<p class="service-source">'.$service_childs['source'][0]['text'].'</p>'?>
            <?php elseif ($service['attributes']['type'] == 'Formulaire'): ?>
                <p class="service-button">
                    <a href="<?php echo $serviceURL ?>" class="co-btn co-btn-primary" target="_blank">
                        Accéder au formulaire
                        <?php
                        $format = (isset($service['attributes']['format']) && $service['attributes']['format'] == 'application/pdf')? 'pdf - ' : '';
                        $poids = (isset($service['attributes']['poids']))? $service['attributes']['poids'] : '';
                        if($poids || $format) {
                            echo '('. $format . $poids .')';
                        }
                        ?>
                        &nbsp; <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/external-link.svg"); ?>
                    </a>
                </p>
                <?php if (isset($service_childs['source'])) echo '<p class="service-source">'.$service_childs['source'][0]['text'].'</p>'?>
            <?php elseif ($service['attributes']['type'] == 'Modèle de document'): ?>
                <p class="service-button">
                    <a href="<?php echo $serviceURL ?>" class="co-btn co-btn-primary" target="_blank">
                        Accéder au modèle de document &nbsp;
                        <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/external-link.svg"); ?>
                    </a>
                </p>
                <?php if (isset($service_childs['source'])) echo '<p class="service-source">'.$service_childs['source'][0]['text'].'</p>'?>
            <?php elseif ($service['attributes']['type'] == 'Simulateur'): ?>
                <p class="service-button">
                    <a href="<?php echo $serviceURL ?>" class="co-btn co-btn-primary" target="_blank">
                        Accéder au simulateur &nbsp;
                        <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/external-link.svg"); ?>
                    </a>
                </p>
                <?php if (isset($service_childs['source'])) echo '<p class="service-source">'.$service_childs['source'][0]['text'].'</p>'?>
            <?php endif; ?>
        </div>

        <?php if(isset($service_childs['noticeliee'])): ?>
            <p><b>Pour vous aider à remplir le formulaire :</b></p>
            <ul>
                <?php
                foreach ($service_childs['noticeliee'] as $notice) :
                    if (!empty($notice['attributes']['url'])){
                        $noticeURL = $notice['attributes']['url'];
                    } else {
                        $noticeURL = $url .$notice['attributes']['id'];
                    }
                    ?>
                    <li><a href="<?php echo $noticeURL; ?>" target="_blank"><?php echo $notice['text']; ?>&nbsp;<?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/external-link.svg"); ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <?php if(isset($service_childs['serviceenligneannexe'])): ?>
            <p><b>Formulaire annexe :</b></p>

            <?php
            foreach ($service_childs['serviceenligneannexe'] as $annexe) :
                $annexeURL = $annexe['children']['lienweb'][0]['attributes']['url'];

                if (isset($annexe['attributes']['numerocerfa'])) echo '<p><b>Cerfa n°'.$annexe['attributes']['numerocerfa'].'</b></p>';

                $this->parse_not_children('texte', $annexe['children']['texte']);
                ?>
                <ul>
                    <li><a href="<?php echo $annexeURL; ?>" target="_blank"><?php echo $annexe['children']['titre'][0]['text']; ?>&nbsp;<?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/external-link.svg"); ?></a></li>
                </ul>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>
