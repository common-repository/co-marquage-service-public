<?php
$internBaseURL = $this->url;
?>

<div id="co-page" class="fiche">

    <?php $this->callRoot( $data, 'fildariane' ); ?>

    <?php $this->callRoot( $data, 'dc:title' ); ?>

    <div class="co-content">
        <div class="bloc-serviceenligne-index">
            <?php
            foreach ($data['children']['groupe'] as $groupe):
                switch ($groupe['children']['titre'][0]['text']) {
                    case 'Téléservice':
                        $thisTitre = 'Services en ligne les plus demandés';
                        break;
                    case 'Formulaires':
                        $thisTitre = 'Formulaires les plus demandés';
                        break;
                    case 'Simulateurs':
                        $thisTitre = 'Simulateurs les plus demandés';
                        break;
                    case 'Modèles de documents':
                        $thisTitre = 'Modèles de document les plus demandés';
                        break;
                }
            ?>
                <h2><?php echo $thisTitre; ?></h2>

                <ul class="list-arrow">
                    <?php foreach ($groupe['children']['serviceenligne'] as $service): ?>
                        <li><a href="<?php echo $internBaseURL.$service['attributes']['id'] ?>"><?php echo $service['children']['titre'][0]['text'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </div>
    </div><!-- co-content -->

</div><!-- co-page -->
