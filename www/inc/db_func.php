<?php
function connect_db($db_param)
{
    $conn = mysqli_connect($db_param["server"], $db_param["user"], $db_param["pass"], $db_param["base"]);
    if ($conn)
      mysqli_set_charset($conn, "utf8");
    return $conn;
}


//Проверяем логин-парль пользователя по MySQLбазе
function checkLogInfo($log, $pas)
{

    global $db_param;
    $status = array();
    if (!checkRegExp($log, "login") || !checkRegExp($pas, "pass")) {
        $status["logStatus"] = false;
        $status["status_string"] = "Некорректные логин или пароль";
        return $status;
    }
    $conn = connect_db($db_param);
    if ($conn != null) {
        if(!($stmt=$conn->prepare("select id from users where login=? and pass=?"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
        if(!$stmt->bind_param('ss',$l,$a)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        $l=$log;
        $a = sha1($pas);
        if(!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
            $status["logStatus"] = false;
            $status["status_string"] = "Неверный пароль";
        }
        if(!($res=$stmt->get_result())) {
            echo "Не удалось получить результат: (" . $stmt->errno . ") " . $stmt->error;
            $status["logStatus"] = false;
            $status["status_string"] = "Неверный пароль";
        } else {
            if($res>0){
                $status["logStatus"] = true;
            } else {
                $status["logStatus"] = false;
                $status["status_string"] = "Неверный пароль";
            }
        }
        $stmt->close();
        return $status;
    }
}



//Извлекаем данные о пользловател с указанным логином. Теперь из MySQL-базы
function getUserInfo($logUser)
{
    global $db_param;

    $conn = connect_db($db_param);
    $query = "select id_graduate, studentname, year, id_faculty, learn_form, learn_type, namedirection, workplace, contacts, comments from users where login=\"$logUser\"";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0)
     {  $userInfo= mysqli_fetch_assoc($result);
        if($userInfo["img"]==null)

                $userInfo["img"]="noname.jpg";
            }
    else {
      $userInfo=null;
    }

    mysqli_free_result($result);
    mysqli_close($conn);
    return $userInfo;

}

class myClass {

        function connect_db($db_param)
    {
        $conn = mysqli_connect($db_param["server"], $db_param["user"], $db_param["pass"], $db_param["base"]);
        if ($conn)
          mysqli_set_charset($conn, "utf8");
        return $conn;
    }


    //Сохранить информацию о новости в БД
function saveUser($json)
{
    global $db_param;

    $conn = connect_db($db_param);
	$hash = substr(sha1($json->pas),0,32);
    if ($conn != null) {
		if(!($stmt=$conn->prepare("INSERT INTO users(login, password, username, status) VALUES (?,?,?,1)"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
		if(!$stmt->bind_param('sss',$a,$b,$c)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
		$a=$json->log;
		$b=$hash;
		$c=$json->fio;		
       	$res = 	$stmt->execute();		
		$stmt->close();
		return $res;
    }
    return false;

}

function logUser($json)
{
    global $db_param;
    $conn = connect_db($db_param);
	$hash = substr(sha1($json->pas),0,32);
    if ($conn != null) {
		if(!($stmt=$conn->prepare("SELECT id_graduate FROM graduates where login=? and password=?"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
		if(!$stmt->bind_param('ss',$l,$p)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
		$l=$json->log;
        $p = $hash;
		if(!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
		if(!($res=$stmt->get_result())) {
            echo "Не удалось получить результат: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            if($res>0){
                $gradInfo=array();
				while($bi=mysqli_fetch_array($res))
					$gradInfo[]=$bi;
				
            } else {
                return null;
            }
        }
		$stmt->close();
		return json_encode($gradInfo);
}
}


function checkUser($json)
{
    global $db_param;
    $conn = connect_db($db_param);

    if ($conn != null) {
		if(!($stmt=$conn->prepare("SELECT id_user FROM users where login=?"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
		if(!$stmt->bind_param('s',$l)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
		$l=$json->log;
		if(!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
		if(!($res=$stmt->get_result())) {
            echo "Не удалось получить результат: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            if($res>0){
                $gradInfo=array();
				while($bi=mysqli_fetch_array($res))
					$gradInfo[]=$bi;				
            } else {
                return null;
            }
        }
		$stmt->close();
		return json_encode($gradInfo);
    }

}
}


