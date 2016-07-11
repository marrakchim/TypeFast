function adminNewGame()
{
  var label = $('#inputLabelAdmin').val();
  var texte = $('#inputTextAdmin').val();
  var selection = $("#diff").find(":selected").data("id");

  var data = {action : 'game_new_game', texte:texte, label:label,difficulty:selection};

  request = $.ajax({
     url:'controller.php',
     type: "POST",
     data: data,
  });

  request.done(function (data){
    if (data.status === 'success'){
       console.log(data.status);
      }
    else if(data.status === 'error'){
        console.log(data.response);
    }

  });

  request.fail(function (status, thrown){
      console.error(
          "Erreur d'execution de la requête: "+
          status, thrown
      );
  });
}

/***********************************************************************************************/

function compareText()
{
  // Max 100 points
  // -0.5 par faute = texte pas pareil ou mot manquant
  var data = {action:'game_get_text'};

  request = $.ajax({
     url:'controller.php',
     type: "GET",
     data: data,
  });

  request.done(function (data){
    if (data.status === 'success'){
       console.log(data.response);
       var textInput = $("#textInput").val();
       //verifier que l'input n'est pas vide
       if(textInput == "")
       {
         showError("Veuillez entrer du texte");
         $("#textInput").on('input',function(){
           hideError();
         });
       }
       else
       {
         var score = calculateScore(countDifferences(textInput,data.response.text," "));
         console.log(score);
         updateMatchInfo(score);
         //afficher le score sur la page
         $("#score").html(score);

       }
    }
    else if(data.status === 'error'){
        console.log(data.status);
    }

  });

  request.fail(function (status, thrown){
      console.error(
          "Erreur d'execution de la requête: "+
          status, thrown
      );
  });
}



function calculateScore(nbDifferences)
{
  var score=100 - nbDifferences*0.5;
  if(score<0) score=0;
  return score;
}

function countDifferences(a,b, separator)
{
  a = a.replace(/\s+/g, " ");
  var arrayA = a.split(separator);
  var arrayB = b.split(separator);

  var count;
  var nbDifferences = 0;
  if(arrayA.length <= arrayB.length)
  {
    count = arrayA.length;
    nbDifferences = arrayB.length-arrayA.length;
  }
  else
  {
    count = arrayB.length;
    nbDifferences = arrayA.length-arrayB.length;
  }

  for (var i=0; i < count; i++)
  {
    if(arrayA[i] != arrayB[i])
    {
      nbDifferences ++;
    }
  }
  return nbDifferences;
}

/***********************************************************************************************/

function updateMatchInfo(score) {
  var timeEnd = timeNow();
  var timePlayed = 300 - $("#timer").data('seconds');
  var data = {action:'match_update_info',time_played:timePlayed,score:score};
  console.log(data);

  request = $.ajax({
     url:'controller.php',
     type: "POST",
     data: data
  });

  request.done(function (data){
    if (data.status === 'success'){
    }else if(data.status === 'error'){
    }

  });

  request.fail(function (xhr, ajaxOptions, thrownError){
    alert("Request fail : " + xhr.statusText + xhr.responseText +xhr.status + "thrown error : " + thrownError);
  });

}


/***********************************************************************************************/

function handleTimer() {

  $("#timer").timer({
        duration:   '5m',   // The time to countdown from. `seconds` and `duration` are mutually exclusive
        callback:   function() {  // This will execute after the duration has elapsed
          alert('Time up!');
          $("#timer").html("");
          $("#timer").append("Temps écoulé.");
          document.location.href="userHome.php"
        },                        // If duration is set, this function is called after `duration` has elapsed
        countdown: true,
        repeat:     false,     // If duration is set, `callback` will be called repeatedly
        format:    '%M:%S'    // Format to show time in
      });
}

/***********************************************************************************************/

function getGameList()
{
  var data = {action:'game_get_list'};

  request = $.ajax({
     url:'controller.php',
     type: "GET",
     data: data,
  });

  request.done(function (data){
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
          "Erreur d'execution de la requête: "+
          status, thrown
      );
  });
}

function startGame()
{
      var selection = $("#choixJeu").find(":selected").data("uuid");
      var data = {action:'game_start_game', gameID:selection};
      $("#temps").show();

      request = $.ajax({
         url:'controller.php',
         type: "POST",
         data: data
      });

      request.done(function (data){
        //data = jQuery.parseJSON(response);
        if (data.status === 'success'){
              convert('jeu', data.response.text);
              var input = '<textarea id="textInput" rows="7" cols="50" class="mt-2x"></textarea>';
              var but = '<button id="buttonCheck" class="btn btn-success mt-2x">Verifier</button'
              $("#jeu").append(input);
              $("#jeu").append(but);
              refresh_button_event($("#buttonCheck"));
        }
        else if(data.status === 'error'){
            $("#container-jeu").html("");
            $('#container-jeu').append(data.response);
        }



      });

      request.fail(function (xhr, ajaxOptions, thrownError){
        alert(xhr.statusText);
        alert(xhr.responseText);
        alert(xhr.status);
        alert(thrownError);
      });


}

function refresh_button_event(element)
{
    element.on('click', function(){
      compareText();
      $("#popup-score").addClass("showMe");
      $("#container-jeu").hide();
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

          request.done(function (data){
            if (data.status === 'success'){
                window.location.href  = "index.php";
                console.log(data.response);
            }else {
                showError(data.response);
            }

          });

          request.fail(function (status, thrown){
              console.error(
                  "Erreur d'execution de la requête: "+
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

          request.done(function (data){
            if (data.status === 'success'){
                window.location.href = "login.php";
            }else {
                showError(response);
            }

          });

          request.fail(function (status, thrown){
              console.error(
                  "Erreur d'execution de la requête: "+
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
      fontFamily: "roboto light",
      fontSize: 16,
      fill: '#000000',
      align: 'left',
      padding: 10,
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

  function timeNow(){
      var now= new Date(),
      ampm= 'am',
      h= now.getHours(),
      m= now.getMinutes(),
      s= now.getSeconds();
      if(h>= 12){
          if(h>12) h -= 12;
          ampm= 'pm';
      }

      if(m<10) m= '0'+m;
      if(s<10) s= '0'+s;
      return (now.toLocaleDateString()+ ' ' + h + ':' + m + ':' + s + ' ' + ampm);
  }
