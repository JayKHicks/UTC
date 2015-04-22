<div class="form-group">
	<?php foreach($group as $item){
		include ROOT_PATH . '/app/views/home/templates/form' . $item['type'] . 'Input.php';
	} ?>
</div>