<html lang="en">
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/css/main.css" >
		<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" >
		<script type="text/javascript" src="/js/main.js"></script>
		<meta id="myViewport" name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes"/>
		<!--<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>-->
		<script>
			config = {
				'appData': {},
				'timer': ''
			};
			$(document).ready(function(){
				//google.load('visualization', '1', {packages: ['corechart']});
				SMGinit = new SMG.admin();
			});
			window.onload = function () {
				if (document.documentElement.clientWidth < 451){
					$('meta#myViewPort').attr('content','width=450')
				}
			}
		</script>
	</head>
	<body>
		<div class="menu">
			<div class="menu-overlay">
				<div class="top-bar">
					<i class="fa fa-th-list"></i>
					<span class="app-name">SMG Application Stack</span>
				</div>
			</div>
			<div class="menu-items">
				<div class="item">
					<li class="item-header">Application Stack</li>
					<li>
						<select class="application-name">
							<option value="SMG">SMG</option>
						</select>
					</li>
				</div>
				<div class="item">
					<li class="item-header">Refresh Interval</li>
					<li>
						<select class="refresh-interval">
							<option value="default">none</option>
							<option value="1">1 minute</option>
							<option value="5">5 minutes</option>
							<option value="10">10 minutes</option>
							<option value="15">15 minutes</option>
							<option value="30">30 minutes</option>
						</select>
					</li>
				</div>
			</div>
		</div>
		<div class="main-container">
			<!--<div class="last-updated">
				<div class="header">Last Updated</div>
				<div class="time"></div>
			</div>-->
			<div class="center-image"></div>
			<div class="center-image-overlay">
				<div class="success-num"></div>
				<div class="warning-num"></div>
				<div class="error-num"></div>
			</div>
			<div class="components">
				<div class="components-header">
					<span class="title">Components</span>
					<span class="time"></span>
				</div>
				<div class="components-list"></div>
			</div>
		</div>
	</body>
<html>
