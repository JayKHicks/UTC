<div class="container-wrapper bottom">
	<div class="container">
		<div class="content">
			<div class="footer-left">
				<div class="footer-image"></div>
				<span>Marketing URL Builder</span>
			</div>
			<div class="footer-right">
				<span>2015 Gannett Media Technologies International</span>
			</div>
		</div>	
	</div>
</div>
<!-- /.container -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="3rdParty/jquery/jquery-1.11.2.min.js"><\/script>')</script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="/js/jquery.tmpl.min.js"></script>
<script src="/js/home.js"></script>

<?php include_once ROOT_PATH . '/app/views/home/templates/jqueryTemplates.php' ?>

<script type="text/javascript">
	var urlBuilderConfig = {
		data: {
			columns: [
				"",
				""
			],
			data: [
				{	
					siteCode: 'PIND',
					urls: [
						{
							url: "https://www.indystar.com/landing1?test1=num1&test2=num2&test3=num3&test4=num4&test5=num5",
							id: "1"
						},
						{
							url: "https://www.indystar.com/landing2?test1=num1&test2=num2&test3=num3&test4=num4&test5=num5",
							id: "2"
						}
					]
				},
				{	
					siteCode: 'PROC',
					urls: [
						{
							url: "https://www.democratandchronicle.com/landing1?test1=num1&test2=num2&test3=num3&test4=num4&test5=num5",
							id: "3"
						},
						{
							url: "https://www.democratandchronicle.com/landing2?test1=num1&test2=num2&test3=num3&test4=num4&test5=num5",
							id: "4"
						}
					]
				}
			]
		},
		markets: ['PIND'],
		editFields:  {
			'URL': [
				[
					{label:'Tracking URL',classname:'tracking',type:'text',size:'11',attr:'readonly'}
				],
				[
					{label:'Market',classname:'market',type:'select',size:'5'},
					{label:'Host',classname:'host',type:'select',size:'3'},
					{label:'Path',classname:'path',type:'select',size:'3'}
				]
			],
			'Campaign Tracking Codes': [
				[
					{label:'Medium',classname:'utml_medium',type:'select',size:'3'},
					{label:'Source',classname:'utml_source',type:'select',size:'3'},
					{label:'Name',classname:'utml_name',type:'select',size:'3'}
				],
				[
					{label:'Term',classname:'utml_term',type:'select',size:'3'},
					{label:'Content',classname:'utml_content',type:'select',size:'3'},
					{label:'GPS Source',classname:'gps_source',type:'select',size:'3'}
				]
			]
		}
	}
	$(document).ready(function(){
		var testData = [{}]
		initUrlBuilder = new urlBuilder.admin()
	});
</script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<!--<script src="js/ie10-viewport-bug-workaround.js"></script>-->