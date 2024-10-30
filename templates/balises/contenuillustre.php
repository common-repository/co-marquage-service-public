<?php
$data = $data[0];
$illustration = $data['children']['illustration']['0'];
?>

<?php if ($data['attributes']['positionillustration'] == 'gauche'): ?>
        <div class="co-row">
            <div class="co-col-2">
                <img
                    src="https://www.service-public.fr/resources-vdd/<?php echo $illustration[
                        'attributes'
                    ]['lienpublication']; ?>"
                >
            </div>
            <div class="co-col-4">
                <?php $this->parse($data['children']['contenu']['0']); ?>
            </div>
        </div>
<?php else: ?>
        <div class="co-row">
            <div class="co-col-4">
                <?php $this->parse($data['children']['contenu']['0']); ?>
            </div>
            <div class="co-col-2">
                <img
                    src="https://www.service-public.fr/resources-vdd/<?php echo $illustration[
                        'attributes'
                    ]['lienpublication']; ?>"
                >
            </div>
        </div>
<?php endif;
