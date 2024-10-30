<?php
foreach ($data as $key => $bloc_attention) :
?>
    <div class="bloc-attention">

        <p class="bloc-attention-title">
            <?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/exclamation-triangle.svg"); ?>
            <?php echo '&nbsp;' . $bloc_attention['children']['titre'][0]['text'] . " : "; ?>
        </p>

        <p class="bloc-paragraphe bloc-attention-content">
            <?php if( isset($bloc_attention['children']['paragraphe']) ) echo $bloc_attention['children']['paragraphe'][0]['text']; ?>
        </p>

        <?php 
        // Remove Titre and Paragraphe from children
        unset( $bloc_attention['children']['titre'] );
        unset( $bloc_attention['children']['paragraphe'] );
        ?>

        <?php $this->parse($bloc_attention); ?>

    </div>
<?php
endforeach;