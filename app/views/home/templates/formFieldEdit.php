<div class="form-group accordian-body collapse edit-form-field" id="<?php echo $edit['classname'] ?>">
	<div class="edit-form-field-wrapper">
		<div class="col-sm-3">
			<label class="control-label">Modify <span class="title"><?php echo $edit['label'] ?></span> Values:</label>
		</div>
		<div class="btn-group btn-toggle col-sm-3"> 
			<button class="btn active add">Add</button>
			<button class="btn delete">Delete</button>
		</div>
		<div class="add-item col-sm-3">
			<input type="text" class="form-control sub-edit add-<?php echo $edit['classname'] ?>" placeholder="Enter value">
		</div>
		<div class="add-submit col-sm-3">
			<button type="submit" class="btn btn-primary submit add-<?php echo $edit['classname'] ?>">Add</button>
		</div>
		<div class="hidden delete-item col-sm-3">
			<select class="form-control sub-edit delete-<?php echo $item['classname'] ?>">
				<option val="">--</option>
			</select>
		</div>
		<div class="hidden delete-submit col-sm-3">
			<button type="submit" class="btn btn-primary submit delete-<?php echo $edit['classname'] ?>">Delete</button>
		</div>
	</div>
</div>