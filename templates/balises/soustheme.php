<div class="co-row">
    <?php
    $index = 1;
    foreach ($data as $key => $theme):
    ?>
        <div id="sousThemes_<?php echo $index; ?>" class="co-col-1-2 <?php if(($index % 2) != 0) echo 'co-col-border' ?>">
            <div class="sous-theme">
                <h2><?php echo $theme['children']['titre'][0]['text']; ?></h2>
                <ul>
                    <?php foreach($theme['children']['dossier'] as $dossier) { ?>
                    <li>
                        <a href="<?php echo $url . $dossier['attributes']['id']; ?>">
                            <?php echo $dossier['text']; ?>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php
        if(($index % 2) == 0) echo '<div class="co-clearfix"></div>';
        $index++;
    endforeach;
    ?>
</div>