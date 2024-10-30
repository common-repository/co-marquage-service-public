<?php
$data = $data['0'];

switch ($data['attributes']['affichage']) {

    case 'onglet': ?>

            <div class='tabs'>
                <ul class="nav nav-tabs">
                    <?php foreach($data['children']['situation'] as $key => $situation ) : ?>
                        <li class="<?php echo ( ($key == 0) ? 'active': '') ; ?>" data-co-action="tab" data-co-target="#<?php echo $situation['token']; ?>">
                            <span>
                                <?php echo $situation['children']['titre'][0]['text']; ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul><!-- nav nav-tabs -->

                <div class="tab-content">
                    <?php foreach($data['children']['situation'] as $key => $situation ) : ?>
                        <div class="tab-pane <?php echo ( $key == 0 ) ? 'active' : ''; ?>" id="<?php echo $situation['token']; ?>">
                            <?php $this->parse( $situation['children']['texte'][0] ); ?>
                        </div><!-- tab-pane -->
                    <?php endforeach; ?>
                </div><!-- tab-content -->
            </div> <!-- tabs -->

        <?php
        break;

    case 'liste':
        break;

    default:
        break;

}