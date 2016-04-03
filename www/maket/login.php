<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <link rel="shortcut icon" href="/images/favicon.ico">

    <title>Just CHAT</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <div id="pop"></div>
    <div class="container">

      <form class="form-signin" role="form">
        <h2 class="form-signin-heading">Войдите пожалуйста!</h2>
        <input type="login" class="form-control" placeholder="Логин" required autofocus>
        <input type="password" class="form-control" placeholder="Пароль" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти!</button>
        <a href="#regModal" role="button" class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target="#regModal">Зарегистрироваться!</a>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <div class="modal fade" id="regModal" tabindex="-1" role="dialog" aria-labelledby="regModalLabel" aria-hidden="true" style="z-index:2001;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="form-signin-heading" id="myModalLabel"><center>Регистрация нового пользователя</center></h4>
                </div>
                <div class="modal-body">
                    <div class="centered">
                        <div id="cont"></div>
                        <div class="input-field col-lg-12">
                            <i class="fa fa-user prefix"></i>
                            <input name="login" id="login" type="login" placeholder="Логин" class="form-control" autofocus required>
                        </div>
                        <div class="input-field col-lg-12">
                            <i class="fa fa-key prefix"></i>
                            <input name="pass" id="pass" type="password" placeholder="Пароль" class="form-control" required>
                        </div>  
                        <div class="input-field col-lg-12">
                            <i class="fa fa-key prefix"></i>
                            <input name="pass_confirm" id="pass_confirm" type="password" placeholder="Подтверждение пароля" class="form-control" required>
                        </div> 
                        <div class="input-field col-lg-12">
                            <i class="fa fa-text-width prefix"></i>
                            <input name="fio" id="fio" type="text" placeholder="ФИО" class="form-control" required>
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="centered">
                        <button id="done_reg" type="submit" class="btn btn-lg btn-primary btn-block">ЗАРЕГИСТРИРОВАТЬСЯ</button>
                    </div>
                </div>
            </div>  
        </div>
    </div>
  </body>
</html>
<script type="text/javascript">
        $("document").ready(function(){
            $('#modal').modal();
        });
        //клик регистрации
    $('#done_reg').on('click',function(){
        $("#cont").empty();
        login = $("#login").val().replace(/(<.*?>)/g, "");
        pass = $("#pass").val().replace(/(<.*?>)/g, "");
        conf_pass = $("#pass_confirm").val().replace(/(<.*?>)/g, "");
        fio = $("#fio").val().replace(/(<.*?>)/g, "");

        var bValid=true;                         //Тут проверка начинается регистрации
    //Проверка логина
      var iLog=$("#login");
      var reLog = /^[a-zA-z0-9_]{1,10}$/;
      if(!reLog.test(login)) {
            var a = $('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Warning!</strong> Логин не верен!</div>');
                        $("#cont").append(a);
          iLog.css("border-color", "red");
          bValid=false;

      }
      else{
          iLog.css("border-color","#ccc");
        
      }
      var iFIO=$("#fio");
    var re1FIO = /^[-_a-zA-Zа-яА-Я ]+$/;
        if(!re1FIO.test(fio))
        {
        var a1 = $('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Warning!</strong> Имя не верное!</div>');
                        $("#cont").append(a1);
        iFIO.css("border-color", "red");
        bValid=false;
    }
    else
    {
        iFIO.css("border-color","#ccc");
    }
    
    //Проверка пароля. У пароля и логина совпадают регулярные выражения
    var iPas=$("#pass");
    if(!reLog.test(pass)) {
        var a2 = $('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Warning!</strong> Ошибка в пароле!</div>');
                        $("#cont").append(a2);
        iPas.css("border-color", "red");
        bValid=false;
    }
    else
    {
        iPas.css("border-color","#ccc");
    }
        

    //Проверка подтверждения пароля
    var iConfPas=$("#pass_confirm");
    if(conf_pass!=pass) {
                var a3 = $('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Warning!</strong> Пароли не совпадают!</div>');
                        $("#cont").append(a3);
        iConfPas.css("border-color", "red");
        bValid=false;
    }
    else
    {
        iConfPas.css("border-color","#ccc");
    }
          
    if (bValid==true)
    {
        checkUser();
    }

    $("#cont").append(a3);
    }); 
    //регистрация
        var regUser = function() {
        var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if (xhttp.readyState==4 && xhttp.status==200) {
                    var response = xhttp.responseText;
                    if(response) {
                        var b = $('<div id="alert-warning" class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center>Успешная регистрация</center></div>');
                        $('#login').val('');
                        $('#pass').val('');
                        $('#pass_confirm').val('');
                        $('#fio').val('');
                        setTimeout(timeoutFunc,3000);
        $("#pop").append(b);
                        $('#regModal').modal('toggle');
                    } else {
                        var b = $('<div id="alert-warning" class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center>Ошибка регистрации</center></div>');
                        setTimeout(timeoutFunc,3000);
        $("#pop").append(b);
                    }
                    
                }
            };
            if(true) {
                obj = JSON.stringify({action:"reg",log:login,pas:pass,cp:conf_pass,fio:fio});
                xhttp.open("POST", '../inc/ajax.php', true);
                xhttp.setRequestHeader("Content-Type","application/json");
                xhttp.send(obj);
            } else {
                //alert("Ошибка!");
            }
    }
    
    //проверка
    var checkUser = function() {
        var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if (xhttp.readyState==4 && xhttp.status==200) {
                    var response = $.parseJSON(xhttp.responseText);
                    if(response==null || response.length<5) {
                        regUser();
                    } else {
                        var a6 = $('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Warning!</strong> Такой логин уже существует!</div>');
        $("#cont").append(a6);
                    }
                    
                }
            };
            if(true) {
                obj = JSON.stringify({action:"check",log:login});
                xhttp.open("POST", '../inc/ajax.php', true);
                xhttp.setRequestHeader("Content-Type","application/json");
                xhttp.send(obj);
            } else {

            }
    }
    function timeoutFunc(){
        $("#alert-warning").remove();
        if (prs){
            prs = false;
            location.reload();
        }
    }
    $(document).ready(function(){   
    $('#login').keyup( function() {
        var $this = $(this);
        if($this.val().length > 10)
            $this.val($this.val().substr(0, 10));           
    });
     });
    </script>