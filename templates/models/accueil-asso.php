<?php
$internBaseURL = $this->url;
?>
<div id="co-page" class="comarquage-home">

    <div class="co-home-theme">
        <h2>Fiches pratiques les plus consultées</h2>
        <div class="home-theme-list co-row co-row-without-antimargin">
            <div class="home-theme-list-item co-col-1-4">
                <div class="home-item-icon">
                    <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/home-icon-obligations.svg"); ?>
                </div>
                <h3><a href="<?php echo $internBaseURL.'N31403' ?>">Formalités administratives</a></h3>
                <ul>
                    <li><a href="<?php echo $internBaseURL.'F1119'; ?>">Déclaration, </a></li>
                    <li><a href="<?php echo $internBaseURL.'F1926'; ?>">Immatriculation, </a></li>
                    <li><a href="<?php echo $internBaseURL.'F1120'; ?>">Statuts, </a></li>
                    <li><a href="<?php echo $internBaseURL.'N21962'; ?>">Modification - dissolution, </a></li>
                    <li><a href="<?php echo $internBaseURL.'F11966'; ?>">Agrément…</a></li>
                </ul>
            </div>
            <div class="home-theme-list-item co-col-1-4">
                <div class="home-item-icon">
                    <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/home-icon-fonctionnement.svg"); ?>
                </div>
                <h3><a href="<?php echo $internBaseURL.'N31404' ?>">Fonctionnement</a></h3>
                <ul>
                    <li><a href="<?php echo $internBaseURL.'F1121'; ?>">Dirigeants, </a></li>
                    <li><a href="<?php echo $internBaseURL.'N22150'; ?>">Bénévoles, </a></li>
                    <li><a href="<?php echo $internBaseURL.'F1127'; ?>">Constitution de partie civile, </a></li>
                    <li><a href="<?php echo $internBaseURL.'F21899'; ?>">Organisation d’un événement…</a></li>
                </ul>
            </div>
            <div class="home-theme-list-item co-col-1-4">
                <div class="home-item-icon">
                    <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/home-icon-financement.svg"); ?>
                </div>
                <h3><a href="<?php echo $internBaseURL.'N31405' ?>">Financement</a></h3>
                <ul>
                    <li><a href="<?php echo $internBaseURL.'F3180'; ?>">Subventions, </a></li>
                    <li><a href="<?php echo $internBaseURL.'F2722'; ?>">Dons, </a></li>
                    <li><a href="<?php echo $internBaseURL.'N22179'; ?>">Activités commerciales…</a></li>
                </ul>
            </div>
            <div class="home-theme-list-item co-col-1-4">
                <div class="home-item-icon">
                    <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/home-icon-secteurs.svg"); ?>
                </div>
                <h3><a href="<?php echo $internBaseURL.'N31406' ?>">Associations spécifiques et&nbsp;fondations</a></h3>
                <ul>
                    <li><a href="<?php echo $internBaseURL.'N31028'; ?>">Fondations, </a></li>
                    <li><a href="<?php echo $internBaseURL.'F1390'; ?>">Associations de parents d’élèves, </a></li>
                    <li><a href="<?php echo $internBaseURL.'F1319'; ?>">Associations de propriétaires, </a></li>
                    <li><a href="<?php echo $internBaseURL.'F1126'; ?>">Associations de consommateurs…</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="co-row">
        <div class="co-col-2">
            <div class="co-panel co-panel-gray">
                <div class="co-panel-heading">
                    <h2>Questions - réponses</h2>
                </div>
                <div class="co-panel-body">
                    <ul class="list-top-dotted list-arrow">
                        <?php
                        $questionsreponse = $data['children']['groupe'][2]['children']['questionreponse'];

                        foreach ($questionsreponse as $oneQuestion) {
                            echo '<li><a href="'.$internBaseURL.$oneQuestion['attributes']['id'].'">'. $oneQuestion['text'] .'</a></li>';
                        }
                        ?>
                    </ul>
                    <p class="link-all"><a href="<?php echo $internBaseURL ?>questionsReponses">Toutes les questions réponses</a></p>
                </div>
            </div>
        </div>
        <div class="co-col-2">
            <div class="co-panel">
                <div class="co-panel-heading">
                    <h2>Services en ligne</h2>
                </div>
                <div class="co-panel-body">
                    <ul class="list-top-dotted list-arrow">
                        <?php
                        $servicesenligne = $data['children']['groupe'][0]['children']['serviceenligne'];

                        foreach ($servicesenligne as $oneService) {
                            $linkURL = (isset($oneService['attributes']['id']))? $internBaseURL.$oneService['attributes']['id'] : $oneService['attributes']['url'];
                            echo '<li><a href="'.$linkURL.'">'. $oneService['children']['titre'][0]['text'] .'</a></li>';
                        }
                        ?>
                    </ul>
                    <p class="link-all"><a href="<?php echo $internBaseURL ?>servicesEnLigne">Tous les services en ligne</a></p>
                </div>
            </div>
        </div>
        <div class="co-col-2">
            <div class="co-panel co-panel-gray">
                <div class="co-panel-heading">
                    <h2>Comment faire si…</h2>
                </div>
                <div class="co-panel-body">
                    <ul class="list-top-dotted list-arrow">
                        <?php
                        $commentsfairesi = $data['children']['groupe'][3]['children']['commentfairesi'];

                        foreach ($commentsfairesi as $commentfairesi) {
                            echo '<li><a href="'.$internBaseURL.$commentfairesi['attributes']['id'].'">'. $commentfairesi['text'] .'</a></li>';
                        }
                        ?>
                    </ul>
                    <p class="link-all"><a href="<?php echo $internBaseURL ?>commentFaireSi">Tous les Comment faire si…</a></p>
                </div>
            </div>
        </div>
        <div class="co-clearfix"></div>
        <div class="co-col-4">
            <div class="co-panel">
                <div class="co-panel-heading">
                    <h2>Modèles de document</h2>
                </div>
                <div class="co-panel-body">
                    <?php $serviceenligne = $data['children']['groupe'][0]['children']['serviceenligne']; ?>
                    <div class="co-row">
                        <div class="co-col-6">
                            <ul class="list-arrow">
                                <?php
                                foreach ($serviceenligne as $oneService) {
                                    $linkText = (isset($oneService['attributes']['commentairelien']))? $oneService['attributes']['commentairelien'] : $oneService['children']['titre'][0]['text'];
                                    echo '<li><a href="'.$oneService['attributes']['url'].'">'. $linkText .'</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
