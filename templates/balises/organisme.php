<?php
$orgMaps = (isset($oneOrg->Adresse->Localisation))? $oneOrg->Adresse->Localisation : null;
?>

<div class="co-organisme-info">

    <table class="organisme-header">
        <tr>
        <td>
            <?php if (!empty($oneOrg->CoordonnéesNum->Téléphone)): ?>
                <p>
                    Tél. : <a href='tel:<?php echo str_replace(' ', '', $oneOrg->CoordonnéesNum->Téléphone); ?>'><?php echo $oneOrg->CoordonnéesNum->Téléphone; ?></a>
                </p>
            <?php endif; ?>
            <?php if(!empty($oneOrg->CoordonnéesNum->Télécopie)) : ?>
                <p>
                    Fax : <?php echo $oneOrg->CoordonnéesNum->Télécopie ?>
                </p>
            <?php endif; ?>
        </td>
        <td>
            <?php if (!empty($oneOrg->CoordonnéesNum->Url) || !empty($oneOrg->CoordonnéesNum->Email)): ?>
                <p>
                    <?php if(!empty($oneOrg->CoordonnéesNum->Email)) echo 'Courriel : <a href="mailto:'.$oneOrg->CoordonnéesNum->Email.'">'.$oneOrg->CoordonnéesNum->Email.'</a><br>' ?>

                    <?php if(!empty($oneOrg->CoordonnéesNum->Url)) echo 'Site web : <a href="'.$oneOrg->CoordonnéesNum->Url.'" target="_blank">'.$oneOrg->CoordonnéesNum->Url.'</a><br>' ?>
                </p>
            <?php endif; ?>
        </td>
        </tr>
    </table>

    <?php if (!is_null($orgMaps)): ?>

        <div id="org-maps-<?php echo $oneOrg['token'] ?>" class="co-org-maps"
            data-co-gmaps-lat="<?php echo $orgMaps->Latitude ?>" data-co-gmaps-lon="<?php echo $orgMaps->Longitude ?>"
            data-co-gmaps-zoom="<?php echo $orgMaps->Précision ?>">
        </div>

    <?php endif; ?>

    <table class="organisme-footer">
        <tr>
        <td>

            <p class="geo-perso-item-how">Adresse :</p>
            <p>
                <?php echo $oneOrg->Adresse->Ligne ?><br>
                <?php echo $oneOrg->Adresse->CodePostal.' '.$oneOrg->Adresse->NomCommune ?>
            </p>
        </td>
        <td>

            <p class="geo-perso-item-how">Horaires d'ouverture :</p>
            <?php if (isset($oneOrg->Ouverture->PlageJ)): ?>
                <?php foreach ($oneOrg->Ouverture->PlageJ as $plageJourn): ?>
                    <p>
                        <?php
                        if ($plageJourn['début'] == $plageJourn['fin']) {
                            echo 'Le '.$plageJourn['début'].' : ';
                        } else {
                            echo 'Du '.$plageJourn['début'].' au '.$plageJourn['fin'].' : ';
                        }

                        $firstH = true;
                        foreach ($plageJourn->PlageH as $plageHorr):
                            if (!$firstH) echo " - ";
                            $debut = (strlen($plageHorr['début']) > 5)? substr($plageHorr['début'], 0, -3) : $plageHorr['début'];
                            $fin = (strlen($plageHorr['fin']) > 5)? substr($plageHorr['fin'], 0, -3) : $plageHorr['fin'];

                            echo $debut." &agrave; ".$fin;
                            $firstH = false;
                        endforeach; ?>
                    </p>
                <?php endforeach; ?>
            <?php endif; ?>
        </td>
        </tr>
    </table>

    <p class="geo-date">
        Vérifié le <?php echo date("d-m-Y", strtotime($oneOrg['dateMiseAJour'])) ?> par <?php echo $oneOrg->EditeurSource; ?>
    </p>
</div>
