<?php

if (isset($_POST['userName'])) {

	$userName = htmlspecialchars(stripslashes($_POST['userName']));
    
    //вошли как зарегистрированный пользователь
	if (!empty($_POST['login'])&&(!empty($_POST['password']))) {
        $login = htmlspecialchars(stripslashes($_POST['login']));
        $password = htmlspecialchars(stripslashes($_POST['password']));
        $role = getUserRole($userName, $login, $password);
    } else {
    	//вошли как гость, гостей не сохраняем в json
    	$role = 'guest';
    }

    sessionStart($userName, $role);

} else {
	die("<p><a href='login.php'>Войти снова</a></p>");
}

	
function getUserRole($userName, $login, $password){
	//шифруем пароль пользователя
    $salt1 = '#3@as';
    $salt2 = 'fdy!@';
    $password = hash('ripemd128', "$salt1$password$salt2");

    $user_data = file_get_contents('./user/data.json');
    $data = json_decode($user_data,true);

    //ищем пользователя среди зарегистрированных
    foreach ($data as $value) {
    	
    	if ((($value['userName'] == $userName) && ($value['login'] == $login) && ($value['password'] === $password))) {
    		return $role = 'admin';
    		
    	} else {
    		continue;
     	}
    }
    return $role ='User not found';
}

function sessionStart($userName, $role) {
    if ($role !='User not found') {
       	
       	session_start();
        $_SESSION['userName'] = $userName;
        $_SESSION['role'] = $role;
        
        if ($role == 'guest') {
            header('Location: list.php');
            exit;
        } else {
        	header('Location: admin.php');
            exit;
        }
    } else {
        die("$role <p><a href='login.php'>Войти снова</a></p>");
    } 
}

?>
