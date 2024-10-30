<?php
foreach ($data as $asavoir) :
	$asavoir_child = $asavoir['children'];
?>

<div class="bloc-asavoir">
	<p class="bloc-asavoir-title"><?php include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/arrow-circle-o-right.svg") ?> &nbsp; <?php echo $asavoir_child[0]['titre'][0]['text'] ?></p>
	<?php
	array_shift($asavoir_child);
	$asavoir['children'] = $asavoir_child;
	$this->parse($asavoir);
	?>
</div>
<?php endforeach; ?>