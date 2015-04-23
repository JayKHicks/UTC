<div class="col-sm-<?php echo $item['size'] ?>">
	<?php 
	if(isset($item['label'])){
		if(isset($item['collapse']))
			echo '<label class="control-label collapsed accordian-toggle" data-toggle="collapse" data-target="#' . $item['classname'] . 'x">' . $item['label'] . '</label>';
		else
			echo '<label class="control-label">' . $item['label'] . '</label>';
	}
	?>
	<select class="form-control <?php echo $item['classname'] ?>" <?php if(isset($item['attr'])) echo $item['attr'] ?>>
		<option val="">--</option>
	</select>
</div>
