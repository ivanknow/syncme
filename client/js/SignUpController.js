/**
 * Object with values that is used for all aplication
 * 
 * Dependencias: Jquery, JqueryMobile
 */

var SignUpController = {
		module:Values.server,
		listener:Values.listener,
		
init:function(){

$( "#target" ).submit(function( event ) {
		
	var test = $("#target").valid();

	if(test){
			$.ajax({
				type:"POST",
				dataType:"json",
				url:SignUpController.module+"/"+SignUpController.listener,
				data:$('#target').serialize(), 
				success: function(response) {
				
					if(response.error!=0  && response.error!=undefined){
						alert(response.msgError);
					
					}else{
					alert(response.msg);
					window.location = "index.html";
			        }
			}
		});
		}
		
		event.preventDefault();
		});

		}
};

$(function(){
SignUpController.init();
})





	