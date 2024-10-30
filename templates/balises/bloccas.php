<?php
$data = $data[0];

switch($data['attributes']['affichage']) {

    case 'onglet': ?>
            <div class='tabs'>
                <ul class="nav nav-tabs">
                    <?php foreach($data['children']['cas'] as $key => $cas ) { ?>
                        <li class="<?php echo ( ($key == 0) ? 'active': '') ; ?>" data-co-action="tab" data-co-target="#<?php echo $cas['token']; ?>">
                            <span>
                                <?php echo $cas['children'][0]['titre'][0]['children']['paragraphe'][0]['text']; ?>
                            </span>
                        </li>
                    <?php } ?>
                </ul>

                <div class="tab-content">

                    <?php foreach($data['children']['cas'] as $key => $cas) { ?>
                        <div class="tab-pane <?php echo ( $key == 0 ) ? 'active' : ''; ?>" id="<?php echo $cas['token']; ?>">
                            <?php unset($cas['children'][0]); // Remove titre ?>
                            <?php $this->parse( $cas ); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php
        break;

    case 'radio': ?>
        <div class="bloc-cas bloc-cas-radio">

            <ul class="choice-tree-choice-list">
                <?php foreach($data['children']['cas'] as $key => $cas ) { ?>
                    <li class="choice-tree-choice" data-co-action="radio" data-co-target="#<?php echo $cas['token']; ?>">
                        <div class="co-radio-head">
                            <button class="btn-like-radio" type="button" data-co-action="slide-bloccas-radio" data-co-target="#<?php echo $cas['token']; ?>">
                                <span class="radio-icon-not-active">
                                    <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/circle-radio.svg"); ?>
                                </span>
                                <span class="radio-icon-active">
                                    <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/check-circle.svg"); ?>
                                </span>

                                &nbsp; <?php echo $cas['children'][0]['titre'][0]['children']['paragraphe'][0]['text']; ?>
                            </button>
                        </div>
                        <div class="co-radio-content co-hide" id="<?php echo $cas['token'] ?>">
                            <?php
                            $cas_childs = $cas['children'];
                            array_shift($cas_childs);
                            $cas['children'] = $cas_childs;

                            $this->parse($cas);
                            ?>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>

    <?php
        break;
    default:
        break;
}