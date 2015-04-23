<div class="form-group">
	<?php foreach($group['formGroup'] as $item){
		include ROOT_PATH . '/app/views/home/templates/form' . $item['type'] . 'Input.php';
	} ?>
</div>
<?php if(isset($group['fieldEdit']))
	foreach($group['fieldEdit'] as $edit){
		include ROOT_PATH . '/app/views/home/templates/formFieldEdit.php';
	}
?>
