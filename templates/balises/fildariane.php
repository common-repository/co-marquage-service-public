<div class="co-breadcrumb">
    <?php
    $fil = $data[0]['children']['niveau'];
    $index = 1;
    foreach($fil as $niveau ) : ?>
        <span>
            <?php if (isset($niveau['attributes']['id'])): ?>
                <a href="<?php echo $url . $niveau['attributes']['id']; ?>" class="<?php echo ( $index == sizeof($fil) ) ? 'last': ''; ?> ">
                    <?php echo $niveau['text']; ?>
                </a>
            <?php else: ?>
                <?php echo $niveau['text']; ?>
            <?php endif; ?>
            <?php if( $index < sizeof($fil) ) echo '<span class="co-breadcrumb-separator">&nbsp;&gt;</span>'; ?>
        </span>
    <?php
    $index++;
    endforeach; ?>
</div>
