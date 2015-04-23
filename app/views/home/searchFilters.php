<div class="container box-container search-urls">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="title">Search Filters</h1>
			<form id="searchForm" class="form-horizontal">
			<?php
			$searchFields = array(
				'fields' => array(
					array(
						'formGroup' => array(
							array('classname' => 'market', 'type' => 'Select', 'size' => 12)
						)
					),
					array(
						'formGroup' => array(
							array('classname' => 'url', 'type' => 'Text', 'size' => 12, 'attr' => 'placeholder="URL (full or partial)"')
						)
					),
					array(
						'formGroup' => array(
							array('label' => 'Campaign Name', 'classname' => 'utm_name', 'type' => 'Select', 'size' => 12)
						)
					),
					array(
						'formGroup' => array(
							array('label' => 'Campaign Medium', 'classname' => 'utm_medium', 'type' => 'Select', 'size' => 12)
						)
					),
					array(
						'formGroup' => array(
							array('label' => 'Campaign Source', 'classname' => 'utm_source', 'type' => 'Select', 'size' => 12)
						)
					),
					array(
						'formGroup' => array(
							array('label' => 'Campaign Content', 'classname' => 'utm_content', 'type' => 'Select', 'size' => 12)
						)
					),
					array(
						'formGroup' => array(
							array('label' => 'Campaign Term', 'classname' => 'utm_term', 'type' => 'Select', 'size' => 12)
						)
					),
					array(
						'formGroup' => array(
							array('label' => 'GPS Source', 'classname' => 'gps_source', 'type' => 'Select', 'size' => 12)
						)
					)
				)
			);
			foreach($searchFields as $section => $groups){
				foreach($groups as $group){
					include ROOT_PATH . '/app/views/home/templates/formGroup.php';
				}
			}
			?>
			</form>
		</div>
	</div>
</div>
