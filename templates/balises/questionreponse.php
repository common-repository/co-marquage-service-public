<div class="fiche-bloc">
    <div class="fiche-item sat-deplie">
        <div class="fiche-item-title">
            <h3><span>Questions ? Réponses !</span></h3>
        </div>
    </div>
    <div class="fiche-item-content">
        <div class="panel-sat ">
            <ul class="list-arrow">
                <?php foreach($data as $question) {  ?>
                <li>
                    <p class="panel-link">
                        <a href="<?php echo $url . $question['attributes']['id']; ?>">
                            <?php echo $question['text']; ?>
                        </a>
                    </p>
                </li>
                <?php }  ?>

            </ul>
        </div>
    </div>
</div>