/**
 * Object with values that is used for all aplication
 * 
 * Dependencias: Jquery, JqueryMobile
 */

var TextController = {
		module:Values.server,
		listener:Values.listener,
		
init:function(){
	
TextController.getText();
	
$(".signout").click(function(){
		
		$.ajax({
			type:"POST",
			dataType:"json",
			url:TextController.module+"/"+TextController.listener,
			data:"opt=LOGOUT", 
			success: function(response) {
				window.location = "index.html";
			}
		});
});
	
$(".gettext").click(function(){
		
	TextController.getText();
	
});
$(".updatetext").click(function(){
		
	TextController.updateText();
	
	});
$( "#target" ).submit(function( event ) {
		event.preventDefault();
		});

},//fim init
		
checkLogin:function(){
	$.ajax({
				type:"POST",
				dataType:"json",
				url:TextController.module+"/"+TextController.listener,
				data:"opt=CHECK_LOGIN", 
				success: function(response) {
					if(response.error!=0  && response.error!=undefined){
						alert(response.msgError);
						window.location = "index.html";
						
					}
					
				}
		});
},
		
getText:function(){
	$.ajax({
				type:"POST",
				dataType:"json",
				url:TextController.module+"/"+TextController.listener,
				data:"opt=GET_TEXT", 
				success: function(response) {
					
					if(response.error!=0  && response.error!=undefined){
						alert(response.msgError);
						window.location = "index.html";
						
					}else{
						$("#text").val(response.text);
						$("#id").val(response.id);
						
					}
				}
			});
},
		
updateText:function(){
		$.ajax({
				type:"POST",
				dataType:"json",
				url:TextController.module+"/"+TextController.listener,
				data:$('#target').serialize(), 
				success: function(response) {
					
					if(response.error!=0  && response.error!=undefined){
						alert(response.msgError);
					}else{
						alert(response.msg);
					}
				}
			});
		}
};


$(function(){
	TextController.init();
});