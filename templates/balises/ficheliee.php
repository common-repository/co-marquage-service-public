<div class="bloc-ficheliee co-panel">
    <div class="co-panel-heading">
        <h2>Pour toute explication, consulter les fiches pratiques :</h2>
    </div>
    <div class="co-panel-body">
        <h3>Particuliers</h3>
        <ul class="list-arrow">
            <?php foreach ($data as $ficheliee): ?>
                <li><a href="<?php echo $url.$ficheliee['attributes']['id'] ?>"><?php echo $ficheliee['children']['titre'][0]['text'] ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>