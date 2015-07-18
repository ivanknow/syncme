/**
 * Object with values that is used for all aplication
 * 
 * Dependencias: Jquery, JqueryMobile
 */


var LoginController = {
		module:Values.server,
		listener:Values.listener,
		
		init:function(){
	
			$( "#target" ).submit(function( event ) {
		
		var test = $("#target").valid();

		if(test){
		$.ajax({
			type:"POST",
			dataType:"json",
			url:LoginController.module+"/"+LoginController.listener,
			data:$('#target').serialize(), 
			success: function(response) {
				
				if(response.error!=0  && response.error!=undefined){
					alert(response.msgError);
					
				}else{
					window.location = "text.html";
			    }
			}
		});
		}
		
		event.preventDefault();
		});

		}
};



$(function(){
	LoginController.init();
});