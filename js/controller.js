function manageLogin(){

    $('#login-btn').on('click', function(e) {
      login = $("#login").val();
      password = $("#password").val();

      if (formChecking(login, password)) {

          var data = {action:'user_check', login:login, password : password};

          request = $.ajax({
             url:'controller.php',
             type: "POST",
             data: data
          });

          request.done(function (response){
            data = jQuery.parseJSON(response);
            if (data.status === 'success'){
                //window.location.href  = "index.php";
                console.log(data.response);
            }else {
                showError(data.response);
            }

          });

          request.fail(function (status, thrown){
              console.error(
                  "Erreur d'execution de la requéte: "+
                  status, thrown
              );
          });
      }

    });

      
    $(".form-control").on('input',function(){
      console.log("hide error");
      hideError();
    });


}





function manageRegistration (){

    //Quand on clique sur le bouton du formulaire
    $('#registration').on('click', function(e) {

      login = $("#login").val();
      password = $("#password").val();

        if (formChecking(login, password)) {
          
          var data = {action:'user_registration', login:login, password:password};

          request = $.ajax({
             url:'controller.php',
             type: "POST",
             data: data
          });

          request.done(function (response){
            data = jQuery.parseJSON(response);
            if (data.status === 'success'){
                window.location.href = "login.php";
            }else {
                showError(response);
            }

          });

          request.fail(function (status, thrown){
              console.error(
                  "Erreur d'execution de la requéte: "+
                  status, thrown
              );
          });

        }  

      });


      

    $(".form-control").on('input',function(){
      console.log("hide error");
      hideError();
    });

}

function showError (message){
  var err = '<div class="alert alert-danger">'+message+'</div>';
  $('#errorDiv').html(err);
}

function hideError (){
  $('#errorDiv').html("");

}

function formChecking (login, password){

  if(login == "")
  {
    showError("Le champ login est obligatoire");
    return false;
  }
  else
  {
    if(password == "")
    {
     showError("Vous devez entrer un mot de passe");  
     return false; 
    }
    else
    {
      return true;
    }
  }  

}
