<div class="col-sm-<?php echo $item['size'] ?>">
	<label class="control-label"><?php echo $item['label'] ?></label>
	<select class="form-control <?php echo $item['classname'] ?>" <?php if(isset($item['attr'])) echo $item['attr'] ?>>
		<option val="">--</option>
	</select>
</div>