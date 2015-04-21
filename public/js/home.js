var urlBuilder = {};
(function(){
	urlBuilder.admin = function(){
		this.init();
	}
	urlBuilder.admin.prototype = {
		init: function(){
			this.events()
			this.loadTable()
		},

		events: function(){
			$('#urlTable').delegate('tr.item.collapsed','click',this.clickRow)
		},

		elemConstants: function(options){
			var elems = {
				// nothing yet
			}
			return elems[options]
		},

		pageMessages: function(options){
			var messages = {
				'error': { 'text': 'Exception Error: /placeholder/' ,'type': 'fail' }
			};
			if (typeof messages[options] === 'object')
				return messages[options]
			else
				return {'text': 'Invalid API Response Code: ' + options + '. Please contact GMTI Services & Support if problems persist.', 'type': 'fail'}
		},
		
		loadTable: function(){
			var elem = "#urlTable";
			$(elem).empty()
			this.applyTemplate('#urlTableTemplate', urlBuilderConfig.data, elem, 0)
		},
		
		clickRow: function(){
			if(!$(this).next().hasClass('collapsing')){
				$(this).toggleClass('open')
			}
		},
		
		applyTemplate: function(template,data,element, arg){
			if (arg === 0)
				$(template).tmpl(data).appendTo(element);
			else
				$(template).tmpl(data).insertAfter(element);
		},

		ajaxCall: function(options){
			// nothing yet
		}
	}
})();
