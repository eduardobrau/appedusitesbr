window.fbAsyncInit = function() {

  FB.init({
    appId      : '207203676483866',
    xfbml      : true,
    version    : 'v2.10'
  });

	///Definições de logon
	//Verifica se o usuário está logado essa é uma função da API
  //https://developers.facebook.com/docs/facebook-login/web
	FB.getLoginStatus(function(response) {

	  if (response.status === 'connected') {
	  	var uid = response.authResponse.userID;
	  	accessToken = response.authResponse.accessToken;
	  	$('#logon').hide();
    	$('#bemvindo').show();
    	informaUsuario();
	  } else if (response.status === 'not_authorized') {
	    //O usuário está logado no Facebook, mas não no app.
	    console.log("Você está logado no Facebook, mas não no App.");
	    $('#logon').show();
    	$('#bemVindo').hide();
	  } else {
	    // Usuário não está logado no Facebook.
	    //window.top.location = 'https://www.facebook.com/';
	  }

	});

};
/*Método não recomendado de efetuar login via janela poupap
mas muitos navegadores bloqueiam poupaps então o mais
indicado é usar a função logar() por esse motivo essa função
só vai estar ai para debug via console*/
function login() {
  FB.login(function(response) {
  }, {scope: 'public_profile,email,friendlists' });
}

// Usa o OAuth Dialog https://developers.facebook.com/docs/reference/dialogs/oauth/
function logar() {
  var oauth_url = 'https://www.facebook.com/dialog/oauth/';
  oauth_url += '?client_id=207203676483866'; //App ID
  oauth_url += '&redirect_uri=' + 'http://localhost/appedusitesbr/'; //Endereço URL app
  oauth_url += '&scope=public_profile,email,friendlists';
  window.top.location = oauth_url;
}

//Informações do Usuário
function informaUsuario(uid) {
  FB.api("me/?fields=id,name,email,friendlists", function(info) {
    console.log(info);
  });
}

//Inicializa o aplicativo
function iniciaAPP() {

  FB.api('/me/?fields=first_name', function(info) {
    $('#boasVindas').html("<h1>" + "Olá,  "  + info.first_name  + "</h1>");
  }); //Fecha FB.api /me

} //Fecha iniciaAPP()

// Carrega o JavaScript SDK
(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/pt_BR/sdk.js ";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));