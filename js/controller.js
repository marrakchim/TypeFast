/******************************************************************************/

function deleteLastMatch()
{
  var data = {action : 'match_delete_last'};

  request = $.ajax({
     url:'controller.php',
     type: "POST",
     data: data,
  });

  request.done(function (data){
    if (data.status === 'success'){
       console.log(data.response);
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

/******************************************************************************/
function loadState()
{
  if(localStorage.getItem('timer')<=0) endGame();
  else {
    // setup game
    setupGame(localStorage.getItem('texte'),localStorage.getItem('timer'));
    // relaod last text
    $('#textInput').val(localStorage.getItem('textInput'));
  }

}

function saveState()
{
  localStorage.setItem('timer',$('#timer').data('seconds'));
  localStorage.setItem('textInput',$('#textInput').val());
}


function resetLocalStorage()
{
    localStorage.setItem('gameStarted',0);
    localStorage.setItem('textInput', '');
    localStorage.setItem('texte', '');
    localStorage.setItem('timer',300);
}

function timerStartRefresh()
{
  $(".hidden-timer").timer({
            duration:   '1s',   // The time to countdown from. `seconds` and `duration` are mutually exclusive
            callback:   function() {  // This will execute after the duration has elapsed
              saveState();
            },                        // If duration is set, this function is called after `duration` has elapsed
            countdown: false,
            repeat:     true,     // If duration is set, `callback` will be called repeatedly
            format:    '%M:%S'    // Format to show time in
        });
}

/******************************************************************************/
function getUsersHighScores()
{
  var data = {action : 'user_match_get_all_score'};

  request = $.ajax({
     url:'controller.php',
     type: "GET",
     data: data,
  });

  request.done(function (data){
    if (data.status === 'success'){
       var users=[];
       for(i=0;i<data.response.length; i++){
         var user ={
           score : data.response[i].score,
           login : data.response[i].login,
         };
         users.push(user);
       }
       createHighScoreChart(users);
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

function createUserScoreChart(userID)
{
  var data = {action : 'user_match_get_score',userID:userID};

  request = $.ajax({
     url:'controller.php',
     type: "GET",
     data: data,
  });

  request.done(function (data){
    if (data.status === 'success'){
      var scores = data.response;

      var dps = [];
      for(i=0;i<scores.length;i++)
      {
          var info ={
            x : i+1,
            y : parseInt(scores[i]),
          };
          dps.push(info);
      }

      //Better to construct options first and then pass it as a parameter
    	var options = {
    		title: {
    			text: "Spline Chart using jQuery Plugin"
    		},
                    animationEnabled: true,
    		data: [
    		{
    			type: "column", //change it to line, area, column, pie, etc
    			dataPoints: dps
    		}
    		]
    	};

      // $("#scoreContainer").CanvasJSChart(options);

      var chart = new CanvasJS.Chart("scoreContainer",{
        theme: "theme2",
        title:{
          text: "Scores"
        },
        axisY: {
          title: "Score"
        },
        legend:{
          verticalAlign: "top",
          horizontalAlign: "centre",
          fontSize: 18

        },
        data : [{
          type: "column",
          showInLegend: true,
          legendMarkerType: "none",
          legendText: "Par partie",
          indexLabel: "{y}",
          dataPoints: dps
        }]
      });
      // renders initial chart
      chart.render();

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

function createHighScoreChart(users)
{
  var login = [];
  var highScore = [];
  for(i=0;i<users.length;i++)
  {
    var currentUser = users[i];
    var maxScore = 0;
    for(j=0;j<currentUser.score.length;j++)
    {
      maxScore = Math.max(maxScore,currentUser.score[j]);
    }
    highScore.push(maxScore);
    login.push(currentUser.login);
  }

  var dps = [];
  for(i=0;i<users.length;i++)
  {
    if(login[i]!="admin")
    {
      var info ={
        label : login[i],
        y : highScore[i],
      };
      dps.push(info);

    }
  }

  var totalPlayers = "Nombre total de joueurs: " + (users.length-1);

  var chart = new CanvasJS.Chart("highScoreChartContainer",{
    theme: "theme2",
    title:{
      text: "Meilleurs scores"
    },
    axisY: {
      title: "Score"
    },
    legend:{
      verticalAlign: "top",
      horizontalAlign: "centre",
      fontSize: 18

    },
    data : [{
      type: "column",
      showInLegend: true,
      legendMarkerType: "none",
      legendText: totalPlayers,
      indexLabel: "{y}",
      dataPoints: dps
    }]
  });

  // renders initial chart
  chart.render();


  };

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
       window.location.href  = "adminHome.php";

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
       var textInput = $("#textInput").val();
       //verifier que l'input n'est pas vide
       if(textInput == "")
       {
         showError("Veuillez entrer du texte");
         $("#textInput").on('input',function(){
         hideError();
         updateMatchInfo(0);
         $("#score").html(0);
         });
       }
       else
       {
         var score = calculateScore(textInput,data.response.text," ");
         updateMatchInfo(score);
         //afficher le score sur la page
         $("#score").html(score);
         $("#popup-score").addClass("showMe");
         $("#container_jeu").hide();
         $('#title').hide();
         $('#popup-view').hide();
         localStorage.setItem('gameStarted',0);

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


function calculateScore(a,b, separator)
{
  //a : text input
  //b : texte initial
  //Transformer un string en chaine de caracteres
  a = a.replace(/\s+/g, " ");
  var arrayA = a.split(separator);
  var arrayB = b.split(separator);

  var count;
  var nbDifferences = 0;
  //Quelle chaine de caracteres est la plus longue
  if(arrayA.length <= arrayB.length)
  {
    count = arrayA.length;
    //on chope le nombre de differences dans la taille des 2 strings deja
    nbDifferences = arrayB.length-arrayA.length;
  }
  else
  {
    count = arrayB.length;
    nbDifferences = arrayA.length-arrayB.length;
  }

  //On compte le nombre de differences
  for (var i=0; i < count; i++)
  {
    if(arrayA[i] != arrayB[i])
    {
      nbDifferences ++;
    }
  }
  console.log('->nb '+nbDifferences);
  console.log('->text '+arrayA);
  console.log('->a '+arrayA.length);
  console.log('->b '+arrayB.length);

  //arrayA.length -> nombre de mots pas nombre de caracteres
  if(arrayA.length <= arrayB.length/2){
    var score=50 - nbDifferences*0.5;
    if(score<0) score=0;
    return score;
  }
  else if(arrayA.length ==0) return 0;
  else {
    var score=100 - nbDifferences*0.5;
    if(score<0) score=0;
    return score;
  }
}

/***********************************************************************************************/

function updateMatchInfo(score) {
  var timeEnd = timeNow();
  var timePlayed = 300 - $("#timer").data('seconds');
  var data = {action:'match_update_info',time_played:timePlayed,score:score};

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
    console.log("Request fail : " + xhr.statusText + xhr.responseText +xhr.status + "thrown error : " + thrownError);
  });

}

/***********************************************************************************************/

function handleTimer(duration) {

  $("#timer").timer({
        duration:   duration,   // The time to countdown from. `seconds` and `duration` are mutually exclusive
        callback:   function() {  // This will execute after the duration has elapsed
            $("#timer").html("");
            $("#partieTerminee").append("</br>Temps écoulé.");
            compareText();
            $("#popup-score").addClass("showMe");
            $("#container_jeu").hide();
            $('#title').hide();

        },                        // If duration is set, this function is called after `duration` has elapsed
        countdown: true,
        repeat:     true,     // If duration is set, `callback` will be called repeatedly
        format:    '%M:%S'    // Format to show time in
      });
}

function pauseTimer()
{
  $("#timer").timer('pause');
}

function playTimer()
{
  $("#timer").timer('resume');
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

function setupGame(jeu,duration)
{
  resetAll();

  close_popup();
  handleTimer(duration);
  /****/
  localStorage.setItem('gameStarted',1);
  /****/
  convert('jeu',jeu);
  localStorage.setItem('texte',jeu);
  $("#container_jeu").show();
  $('#title').show();
  refresh_button_event($("#buttonCheck"));
}

function startGame()
{
      var selection = $("#choixJeu").find(":selected").data("uuid");
      var data = {action:'game_start_game', gameID:selection};

      request = $.ajax({
         url:'controller.php',
         type: "POST",
         data: data
      });

      request.done(function (data){
        //data = jQuery.parseJSON(response);
        if (data.status === 'success'){
          setupGame(data.response.text,'5m');
          localStorage.setItem('timer',300);
          timerStartRefresh();
        }
        else if(data.status === 'error'){

            // REM : .html(data) :: efface tout et insere le code data
            //        .append(data) :: Ajoute

            /*$('#essais').html("");
            $('#essais').append(data.response);*/

            htmlCodeError = "<div class='alert alert-dismissible alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-remove'></i></button>"+data.response+"</div>";
            $('#essais').html(htmlCodeError);
            $("#essais").show();
        }

      });

      request.fail(function (xhr, ajaxOptions, thrownError){
        console.log("Request fail : " + xhr.statusText + xhr.responseText +xhr.status + "thrown error : " + thrownError);

      });

      $("#choixPartie").on('change',function(){
        $('#essais').hide();
      });

}

function endGame()
{
  compareText();
  getGameList();
  resetLocalStorage();
}

function refresh_button_event(element)
{
    element.on('click', function(){
      endGame();
    });
}


function resetAll()
{
    $("#timer").timer('remove');
    $("#textInput").val("");

    resetLocalStorage();
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
      hideError();
    });

    // Add event listener e
    event_keypress(13, $("#password"),$('#login-btn'));
    //event_keypress(13, $("body"),$('#login-btn'));
}

function event_keypress(keycode, input, element)
{
  input.keypress(function (e) {
    var key = e.which;
    if(key == keycode)  // the enter key code
    {
      element.click();
      return false;
    }
  });
}

/*******/

function manageRegistration (admin){

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
                switch(admin)
                {
                  case 0 :
                    window.location.href = "login.php";
                    break;
                  case 1 :
                    window.location.href = "adminHome.php"
                    break;
                }
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

    ratio  = getScreenRatio();

    var screenWidth  = $('.canvas-block').width();
    mainBlockWidth = Math.floor((screen.width/100)*screenWidth);
    screenWidth =Math.floor((mainBlockWidth/100)*ratio);

    console.log(mainBlockWidth+"---"+screenWidth);
    //screenWidth = 400;

    var size=text.length;
    var textOnCanvas = new Kinetic.Text({
      x: 0,
      y: 0,
      fill: '#000000',
      width:screenWidth,
      fontFamily: "roboto-light",
      fontSize: 16,
      fill: '#000000',
      align: 'center',
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



  /**/


  function getScreenRatio()
  {
     //  if mobile
     if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
      // some code..
      return 75;
    }else {
      // if other screen
      return 30;
    }

  }
