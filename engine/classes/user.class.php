<?php

class User {
    public static function login($login, $pass){
        //Используем переменную БД.
        global $db;
        
        // Проверки на корректность данных.
        if(!preg_match("/[0-9a-z_A-Z]+/i", $login)){
            return "Логин должен состоять из английских букв и цифр 0-9.";
        } else if(!preg_match("/^[0-9a-z_A-Za-яA-ЯёЁ]+$/i", $pass)) {
            return "Пароль должен состоять из цифр и русских и английских букв.";
        } else if($db->query("SELECT `login` FROM `users` WHERE `login` = '".$login."'")->num_rows == 0){
            return "Пользователя с логином <b>".$login."</b> не существует.";
        }
        
        //Процесс авторизации
        $user_data = $db->query("SELECT * FROM `users` WHERE `login` = '{$login}'")->fetch_assoc();
        if(md5($pass) == $user_data["password"]) {
            $_SESSION["auth"] = true;
            $_SESSION["id"] = $user_data["id"];
            $_SESSION["login"] = $user_data["login"];
            $_SESSION["email"] = $user_data["email"];
            header("Location: /");
        } else {
            return "Неверный пароль. Проверьте раскладку, и не нажат ли <b>Caps Lock</b>";
        }
    }
    
    public static function register($login, $pass, $repass, $email){
        //Используем переменную БД.
        global $db;
        
        // Проверки на корректность данных.
        if(!preg_match("/[0-9a-z_A-Z]+/i", $login)){
            return "Логин должен состоять из английских букв и цифр 0-9.";
        } else if(!preg_match("/^[0-9a-z_A-Za-яA-ЯёЁ]+$/i", $pass)) {
            return "Пароль должен состоять из цифр и русских и английских букв.";
        } else if(!preg_match("/[0-9a-z_]+@[0-9a-z_^\.-]+\.[a-z]{2,3}/i", $email)) {
            return "E-mail должно быть в формате: josh@doe.com.";
        } else if($db->query("SELECT `login` FROM `users` WHERE `login` = '".$login."'")->num_rows > 0 ){
            return "Кто-то уже зарегестрирован с логином <b>".$login."</b>.";
        } else if($db->query("SELECT `email` FROM `users` WHERE `email` = '".$email."'")->num_rows > 0 ) {
            return "Кто-то уже зарегестрирован с адресом <b>".$email."</b>.";
        } else if($pass != $repass){
            return "Пароли не совпадают.";
        }
            
        //Процесс регистрации
        $md5pass = md5($pass);
        if($db->query("INSERT INTO `users` (login, password, email) VALUES ('{$login}', '{$md5pass}', '{$email}');")) {
            User::login($login, $pass);
        } else {
            return "Ошибка базы данных. Пожалуйста, покажите ошибку нашему системному администратору. Код ошибки:" . mysql_error();
        }
    }
    
    public static function changePassword($uid, $pass, $repass){
        //Используем переменную БД.
        global $db;
        
        // Проверки на корректность данных.
        if(!preg_match("/^[0-9a-z_A-Za-яA-ЯёЁ]+$/i", $pass)) {
            return "Пароль должен состоять из цифр и русских и английских букв.";
        } else if($pass != $repass){
            return "Пароли не совпадают.";
        }
            
        //Процесс регистрации
        $md5pass = md5($pass);
        if($db->query("UPDATE `users` SET `password` = '{$md5pass}' WHERE `id` = '{$uid}';")) {
            return "Пароль успешно изменён";
        } else {
            return "Ошибка базы данных. Пожалуйста, покажите ошибку нашему системному администратору. Код ошибки:" . mysql_error();
        }
    }
    
    public static function uploadAvatar($uid, $file){
        $img_size = getimagesize($file["tmp_name"]);
        
        var_dump($file);
        
        if($file["size"] > 1024 * 1024){
            return "Максимальный размер файла: 1мб.";
        } else if($file["type"] != "image/bmp" &&
                  $file["type"] != "image/jpeg" &&
                  $file["type"] != "image/jpg" &&
                  $file["type"] != "image/png" ){
            return "Допустимые форматы: bmp, jpeg, jpg, png";
        } else if($img_size[0] > 500 || $img_size[1] > 500){
            return "Максимальное разрешение: 500х500.";
        }
        
        if(move_uploaded_file($file["tmp_name"], USER_AVATARS_PATH.$uid)) {
            return "Аватар успешно загружен";
        } else {
            return "Произошла ошибка при загрузки аватара.";
        }
    }
    
    public static function logout(){
        $_SESSION["auth"] = false;
        session_destroy();
        header("Location: /");
    }
}