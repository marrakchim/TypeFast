function manageRegistration (){

    $('#registration').on('click', function(e) {

      login = $("#pseudo").val();
      password = $("#password").val();

      formChecking(login, password);

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

  if(login == "") showError("Le champ login est obligatoire");
  if(password == "") showError("Vous devez entrer un mot de passe");

}
