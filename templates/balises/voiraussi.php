<?php
foreach ($data as $top_key => $voiraussi) :
?>
    <div class="fiche-bloc">
        <div class="fiche-item sat-deplie">
            <div class="fiche-item-title">
                <h3><span>Et aussi</span></h3>
            </div>
        </div>
        <div class="fiche-item-content">
            <div class="panel-sat ">
                <ul class="list-arrow">
                    <?php
                    foreach($voiraussi['children'] as $b_key => $b_val) :
                        foreach($b_val as $link_key => $link_val):
                    ?>
                            <li>
                                <p class="panel-link">
                                    <a href="<?php echo $url . $link_val['attributes']['id']; ?>" target="_blank">
                                        <?php echo $link_val['children']['titre'][0]['text']; ?>
                                    </a>
                                </p>
                                <p class="panel-source"><?php echo $link_val['children']['theme'][0]['children']['titre'][0]['text']; ?></p>
                            </li>
                    <?php
                        endforeach;
                    endforeach;
                    ?>
                </ul>
            </div>
        </div>
    </div>
<?php endforeach; ?>