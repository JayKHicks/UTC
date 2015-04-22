<div class="container box-container create-url collapsable">
	<div class="row">
		<div class="col-lg-12">
			<a data-toggle="collapse" href="#createForm"  class="collapsed" aria-expanded="false">
				<h1 class="title">Create URL</h1>
			</a>
			<form id="createForm" class="form-horizontal collapse">
				<?php
				$createFields = array(
					'URL' => array(
						array(
							array('label' => 'Tracking URL', 'classname' => 'tracking', 'type' => 'Text', 'size' => 11, 'attr' => 'readonly')
						),
						array(
							array('label' => 'Market', 'classname' => 'market', 'type' => 'Select', 'size' => 5),
							array('label' => 'Host', 'classname' => 'host', 'type' => 'Select', 'size' => 3),
							array('label' => 'Path', 'classname' => 'path', 'type' => 'Select', 'size' => 3)
						)
					),
					'Campaign Tracking Codes' => array(
						array(
							array('label' => 'Medium', 'classname' => 'utml_medium', 'type' => 'Select', 'size' => 3),
							array('label' => 'Source', 'classname' => 'utml_source', 'type' => 'Select', 'size' => 3),
							array('label' => 'Name', 'classname' => 'utml_name', 'type' => 'Select', 'size' => 3)
						),
						array(
							array('label' => 'Term', 'classname' => 'utml_term', 'type' => 'Select', 'size' => 3),
							array('label' => 'Content', 'classname' => 'utml_content', 'type' => 'Select', 'size' => 3),
							array('label' => 'GPS Source', 'classname' => 'gps_source', 'type' => 'Select', 'size' => 3)
						)
					)
				);	
				foreach($createFields as $section => $groups){
					echo('<h1 class="line"><span>' . $section . '</span></h1>');
					foreach($groups as $group){
						include ROOT_PATH . '/app/views/home/templates/formGroup.php';
					}
				}
				?>
				<button type="submit" id="create" class="btn btn-primary submit">Submit</button>
			</form>
		</div>
	</div>
</div>
