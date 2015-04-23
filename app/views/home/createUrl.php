<div class="container box-container create-url">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="title collapsed" data-toggle="collapse" data-target="#createForm" aria-expanded="false">Create URL</h1>
			<form id="createForm" class="form-horizontal collapse">
				<?php
				$createFields = array(
					'URL' => array(
						array(
							'formGroup' => array(
								array('label' => 'Tracking URL', 'classname' => 'tracking', 'type' => 'Text', 'size' => 11, 'attr' => 'readonly')
							)
						),
						array(
							'formGroup' => array(
								array('label' => 'Market', 'classname' => 'market', 'type' => 'Select', 'size' => 5),
								array('label' => 'Host', 'classname' => 'host', 'type' => 'Select', 'size' => 3),
								array('label' => 'Path', 'classname' => 'path', 'type' => 'Select', 'size' => 3, 'collapse' => true)
							),
							'fieldEdit' => array(
								array('label' => 'Path', 'classname' => 'pathx', 'size' => 12)
							)
						)
					),
					'Campaign Tracking Codes' => array(
						array(
							'formGroup' => array(
								array('label' => 'Name', 'classname' => 'utm_name', 'type' => 'Select', 'size' => 3, 'collapse' => true),
								array('label' => 'Medium', 'classname' => 'utm_medium', 'type' => 'Select', 'size' => 3, 'collapse' => true),
								array('label' => 'Source', 'classname' => 'utm_source', 'type' => 'Select', 'size' => 3, 'collapse' => true)
							),
							'fieldEdit' => array(
								array('label' => 'Name', 'classname' => 'utm_namex', 'size' => 12),
								array('label' => 'Medium', 'classname' => 'utm_mediumx', 'size' => 12),
								array('label' => 'Source', 'classname' => 'utm_sourcex', 'size' => 12)
							)
						),
						array(
							'formGroup' => array(
								array('label' => 'Content', 'classname' => 'utm_content', 'type' => 'Select', 'size' => 3, 'collapse' => true),
								array('label' => 'Term', 'classname' => 'utm_term', 'type' => 'Select', 'size' => 3, 'collapse' => true),
								array('label' => 'GPS Source', 'classname' => 'gps_source', 'type' => 'Select', 'size' => 3, 'collapse' => true)
							),
							'fieldEdit' => array(
								array('label' => 'Content', 'classname' => 'utm_contentx', 'size' => 12),
								array('label' => 'Term', 'classname' => 'utm_termx', 'size' => 12),
								array('label' => 'GPS Source', 'classname' => 'gps_sourcex', 'size' => 12)								
							)
						)
					)
				);
				$editFormFields = array(
					
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
