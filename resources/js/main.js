//Reset Form
(function($) {	
	$.fn.reset = function () {
	  $(this).each (function() { this.reset(); });
	};
})(jQuery);

//Serialize Form
(function($) {
	$.fn.serializeFormJSON = function() {
	   var o = {};
	   var a = this.serializeArray();
	   $.each(a, function() {
		   if (o[this.name]) {
			   if (!o[this.name].push) {
				   o[this.name] = [o[this.name]];
			   }
			   o[this.name].push(this.value || '');
		   } else {
			   o[this.name] = this.value || '';
		   }
		});
		return o;
	};
})(jQuery);

function showMessage(text, tipo){

   	alert = '<div class="alert alert-'+tipo+'" role="alert">'+text+'</div>';
    $("#main-alert").html(alert).show();
    
    setTimeout(function(){
    	$("#main-alert").html("").hide();
    },5000);
	
}