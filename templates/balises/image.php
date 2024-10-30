<?php
$img = $data[0];
$img_childs = $img['children'];
$img_url = 'https://www.service-public.fr/resources-vdd/' . $img['attributes']['lienpublication'];
$img_alt = isset($img_childs['textederemplacement'][0]['text']) ? $img_childs['textederemplacement'][0]['text'] : '';
?>

<div class="bloc-image">
    <figure>
        <img
            src="<?php echo $img_url; ?>"
            alt="<?php echo $img_alt; ?>"
        />
        <?php if (isset($img_childs['legende'])): ?>
            <figcaption> <?php echo $img_childs['legende'][0]['text']; ?> </figcaption>
        <?php endif; ?>

        <?php if (isset($img_childs['description'])): ?>
            <div class="co-longdesc">
                <button
                    class="co-btn co-btn-outline-primary"
                    type="button"
                    role="role"
                    data-co-action="slide"
                    data-co-target="#<?php echo $img['token']; ?>"
                >
                    Voir la version texte
                </button>
                <div class="co-collapse co-hide" id="<?php echo $img['token']; ?>">
                    <?php $this->parse_not_children('description', $img_childs['description']); ?>
                </div>
            </div>
        <?php endif; ?>
    </figure>
</div>
