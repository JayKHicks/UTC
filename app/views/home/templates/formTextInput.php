<div class="col-sm-<?php echo $item['size'] ?>">
	<?php if(isset($item['label'])) echo '<label class="control-label">' . $item['label'] . '</label>';	?>
	<input type="text" class="form-control <?php echo $item['classname'] ?>" <?php echo $item['attr'] ?>>
</div>