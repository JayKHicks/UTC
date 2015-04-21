<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once ROOT_PATH . '/app/views/home/header.php' ?>
	</head>
	<body>
		<div class="body-content">
			<?php include_once ROOT_PATH . '/app/views/home/nav.php' ?>
			<div class="container-wrapper middle">
				<div class="center-panel">
					<!-- Page Content -->
					<?php include_once ROOT_PATH . '/app/views/home/searchFilters.php' ?>
					<?php include_once ROOT_PATH . '/app/views/home/createUrl.php' ?>
					<?php include_once ROOT_PATH . '/app/views/home/urlTable.php' ?>
				</div>
			</div>
			<?php include_once ROOT_PATH . '/app/views/home/footer.php' ?>
		</div>
	</body>
</html>
