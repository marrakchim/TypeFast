

function handleTimer() {

  $("#timer").timer({
        duration:   '5m',   // The time to countdown from. `seconds` and `duration` are mutually exclusive
        callback:   function() {  // This will execute after the duration has elapsed
        console.log('Time up!');
        },                        // If duration is set, this function is called after `duration` has elapsed
        repeat:     true,     // If duration is set, `callback` will be called repeatedly
        format:    '%M:%S'    // Format to show time in
      });
      $("#div-id").timer('pause');
      $("#div-id").timer('resume');

      console.log($('#timer').data('state') );


}



/***********************************************************************************************/

function getGameList()
{
  var data = {action:'game_get_list'};

  request = $.ajax({
     url:'controller.php',
     type: "GET",
     data: data
  });

  request.done(function (response){
    data=response;
    //data = jQuery.parseJSON(response);
    if (data.status === 'success'){
       $('#choixJeu').html("");
        for(i=0;i<data.response.length; i++){
          var opt = '<option data-uuid="'+data.response[i].id+'">'+data.response[i].label+'</option>';
          $('#choixJeu').append(opt);
        }
    }else if(data.status === 'error'){
        $('#choixPartie').html("");
        $('#choixPartie').append("Pas encore de jeux dans la base de données");
    }

  });

  request.fail(function (status, thrown){
      console.error(
          "Erreur d'execution de la requète: "+
          status, thrown
      );
  });
}

function startGame(userID)
{
      var selection = $("#choixJeu").find(":selected").data("uuid");
      var data = {action:'game_start_game', userID:userID, matchID:selection};

      request = $.ajax({
         url:'controller.php',
         type: "POST",
         data: data
      });

      request.done(function (data){
        if (data.status === 'success'){
              convert('jeu', data.response.text);
              var input = '<textarea></textarea>';
              $("#jeu").append(input);

        }else if(data.status === 'error'){
            $("#jeu").html("");
            $('#jeu').append("Error : couldn't retrieve information");
        }

      });

      request.fail(function (status, thrown){
          console.error(
              "Erreur d'execution de la requète: "+
              status, thrown
          );
      });
}

/***********************************************************************************************/

function manageLogin(){

    $('#login-btn').on('click', function(e) {
      login = $("#login").val();
      password = $("#password").val();

      if (loginFormChecking(login, password)) {

          var data = {action:'user_check', login:login, password : password};

          request = $.ajax({
             url:'controller.php',
             type: "POST",
             data: data
          });

          request.done(function (response){
              console.log(response);
            data = jQuery.parseJSON(response);
            if (data.status === 'success'){
                window.location.href  = "index.php";
                console.log(data.response);
            }else {
                showError(data.response);
            }

          });

          request.fail(function (status, thrown){
              console.error(
                  "Erreur d'execution de la requète: "+
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
      password_check = $("#password-check").val();
      nom = $("#nom").val();
      prenom = $("#prenom").val();
      mail = $("#mail").val();

      if (registrationFormChecking(login, password,password_check,nom, prenom, mail)) {
          var data = {action:'user_registration', login:login, password:password,nom:nom,prenom:prenom,mail:mail,admin:0};

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
      hideError();
    });

}

/***********************************************************************************************/


function checkPassword(pass1,pass2){

  if (pass1!=pass2)  //Test les deux mdp
  {
      return false;
  }
  else if (pass1==pass2)
  {
      return true;
  }
}

function isValidEmailAddress(emailAddress) {
    var regex = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return regex.test(emailAddress);
};

function loginFormChecking(login,password)
{
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
    else{
      return true;
    }
  }

}

function registrationFormChecking (login, password, password_check,nom, prenom, mail){

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
    else{
      if(!checkPassword(password,password_check))
      {
        showError("Verifiez votre mot de passe");
      }
      else
      {
        if(nom == "")
        {
          showError("Entrez votre nom");
        }
        else{
          if(prenom=="")
          {
            showError("Entrez votre prénom");
          }
          else{
            if(!isValidEmailAddress(mail))
            {
              showError("Adresse e-mail invalide");
            }
            else{
              return true;
              }
            }
          }
        }
      }
    }
  }

  /***********************************************************************************************/


  function showError (message){
    var err = '<div class="alert alert-danger">'+message+'</div>';
    $('#errorDiv').html(err);
  }

  function hideError (){
    $('#errorDiv').html("");
  }

  function convert(element, text)
  {
    var size=text.length;
    var textOnCanvas = new Kinetic.Text({
      x: 0,
      y: 0,
      fill: '#000000',
      width:400,
      fontFamily: "Arial",
      fontSize: 14,
      fill: '#000000',
      align: 'left',
      padding: 5,
      text: text
    });

    var twidth = textOnCanvas.getWidth();
    var theight = textOnCanvas.getHeight();

    var stage = new Kinetic.Stage({
        container: element,
        width:twidth,
        height:theight,
      });
    var layer = new Kinetic.Layer();

    layer.add(textOnCanvas);
    stage.add(layer);

    layer.draw();

  }
