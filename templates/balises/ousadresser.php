
<div class="bloc-ousadresser">
    <h3>Où s’adresser ?</h3>
    <div class="fiche-bloc bloc-principal">

        <?php if (isset($pivotlocal_data) && !empty($pivotlocal_data)): ?>
            <?php foreach ($pivotlocal_data as $oneOrg): ?>
                <div class="fiche-item fiche-slide">
                    <div class="fiche-item-title">
                        <h3>
                            <button class="co-btn co-btn-slide" data-co-action="slide-org" type="button" role="button" data-co-target="#<?php echo $oneOrg['token'] ?>">
                                <span><?php echo $oneOrg->Nom ?></span> <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/chevron-down.svg"); ?>
                            </button>
                        </h3>
                    </div>
                    <div class="fiche-item-content co-hide" id="<?php echo $oneOrg['token']; ?>">
                        <?php include(KIENSO_COMARQUAGE_TEMPLATES . 'balises/organisme.php'); ?>
                    </div>
                </div>
                <?php
            endforeach;
        else:
            foreach ($data as $value):
                $ousadresser = $value['ousadresser'];
                $ousadresser_childs = $ousadresser['children'];
                ?>
                <div class="fiche-item fiche-slide">
                    <div class="fiche-item-title">
                        <h3>
                            <?php if (isset($ousadresser_childs['texte'])): // If have text content ?>
                                <button class="co-btn co-btn-slide" data-co-action="slide-org" type="button" role="button" data-co-target="#<?php echo $ousadresser['token'] ?>">
                                    <span><?php echo $ousadresser_childs['titre'][0]['text'] ?></span> <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/chevron-down.svg"); ?>
                                </button>
                            <?php else: ?>
                                <a class="co-btn co-btn-slide  co-btn-slide-link" href="<?php echo $ousadresser_childs['ressourceweb'][0]['attributes']['url'] ?>" target="_blank">
                                    <span><?php echo $ousadresser_childs['titre'][0]['text'] ?></span> <div class="co-external-link"><?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/external-link.svg"); ?></div>
                                </a>
                            <?php endif; ?>
                        </h3>
                    </div>
                    <?php if (isset($ousadresser_childs['texte'])): // If have text content ?>
                        <div class="fiche-item-content co-hide" id="<?php echo $ousadresser['token']; ?>">
                            <?php
                            $contacts_info = $ousadresser_childs['texte'][0]['children'];

                            foreach ($contacts_info as $contact_info) :
                                $first_key = key($contact_info);
                                $thisContent = $contact_info[$first_key];

                                if ($first_key != 'chapitres') {
                                    $this->parse_not_children($first_key, $thisContent);
                                } else {
                                    echo '<div class="co-organisme-info">';
                                    foreach ($thisContent as $oneChapitre) {
                                        $oneChapitre_childs = $oneChapitre['chapitre']['children'];
                                        echo '<p class="geo-perso-item-how">'.$oneChapitre_childs[0]['titre'][0]['children']['paragraphe'][0]['text'].'</p>';

                                        $oneChapitre_title = array_shift($oneChapitre_childs);
                                        $oneChapitre['chapitre']['children'] = $oneChapitre_childs;
                                        $this->parse($oneChapitre['chapitre']);
                                    }
                                    echo '</div>';
                                }
                            endforeach;
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
