function login() {
  FB.login(function(response) {
  }, {scope: 'public_profile,email,user_friends' });
}

// Usa o OAuth Dialog https://developers.facebook.com/docs/reference/dialogs/oauth/
function logar() {
  var oauth_url = 'https://www.facebook.com/dialog/oauth/';
  oauth_url += '?client_id=207203676483866'; //App ID
  oauth_url += '&redirect_uri=' + 'http://localhost/appedusitesbr/'; //Endereço URL app
  oauth_url += '&scope=public_profile,email,user_friends';
  window.top.location = oauth_url;
}

$(document).ready(function(){

	$(".btn-danger.delete").on('click', function(){
		var id = $(this).attr('data-id');
		var title = $(this).attr('data-title');
		console.log(id);
		$("p#modalShowId").html('ID: ' + id);
		$("p#modalShowTitle").html('TÍTULO: ' + title);
		$("a#modalDeleteData").attr("href","/appedusitesbr/enquete/delete.php?id="+id);
		$("#myModal").modal('show');
	});
	
	

	//https://developers.facebook.com/docs/javascript/howto/jquery/v2.10
	//$.ajaxSetup({ cache: true });	
  //$.getScript('//connect.facebook.net/en_US/sdk.js', function(){
  //   FB.init({
  //     appId: '{your-app-id}',
  //     version: 'v2.7' // or v2.1, v2.2, v2.3, ...
  //   });     
  //   $('#loginbutton,#feedbutton').removeAttr('disabled');
  //   FB.getLoginStatus(updateStatusCallback);
  // });
	
	//http://www.nivas.hr/blog/2016/10/29/proper-way-include-facebook-sdk-javascript-jquery/
	$.ajax({

		url: '//connect.facebook.net/pt_BR/sdk.js',
		dataType: 'script',
		cache: 'true',
		success:function(script,textStatus,jqXHR){

			FB.init({
		    appId      : '207203676483866',
		    xfbml      : true,
		    version    : 'v2.10'
		  });
			//console.log(textStatus);

			FB.getLoginStatus(function(response) {

				statusConexao = response.status;
				
				console.log(statusConexao);
				
				if (statusConexao === 'not_authorized') {

					if(localStorage.appEdusitesBRuserAdd){
						localStorage.removeItem("appEdusitesBRuserAdd");
					} 

				}

			});

			console.log(localStorage.appEdusitesBRuserAdd);

		}


	});//End ajax

	

	$('#btnResponse').on('click', function(){

		var enqueteResponse = $("input[name='AppEnquete[value]']:checked").val();
		
		if(statusConexao === 'connected'){
			//var uid = response.authResponse.userID;
	  	//accessToken = response.authResponse.accessToken;
	  	FB.api("me/?fields=id,name,email", function(info) {
		    console.log(info);
		    
		    $.ajax({

					url: "user/create.php",
					dataType: 'json',
					type: 'GET',
					data:{
						'id' : info.id,
						'name' : info.name,
						'email' : info.email,
						'enqueteResponse' : enqueteResponse
					},
					success:function(data){
					// Store
					if(!localStorage.appEdusitesBRuserAdd){
						localStorage.appEdusitesBRuserAdd = data.appEdusitesBRuserAdd;
					} 
					// Retrieve
					//console.log(localStorage.appEdusitesBRuserAdd);
					//The syntax for removing the "appEdusitesBRuserAdd" localStorage item is as follows:
					//localStorage.removeItem("appEdusitesBRuserAdd");
					}

				});//End ajax

		  });
			$('#logon').hide();
    	$('#bemvindo').show();

		}else if (statusConexao === 'not_authorized') {
			//O usuário está logado no Facebook, mas não no app.
	    console.log("Você está logado no Facebook, mas não no App.");
	    $('#logon').show();
    	$('#bemVindo').hide();
		}else{
			logar();
		}

	});

	$('#login').on('click', function(){
		logar();
	});



});

	

	