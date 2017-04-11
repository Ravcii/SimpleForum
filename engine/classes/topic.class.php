<?php
class Topic {

    public static function getTitle($id){
        global $db;

        $title = $db->query("SELECT `title` FROM `topics` WHERE `id` = '{$id}';")->fetch_assoc();

        return $title["title"];
    }

    public static function getUserMessagesAsArray($id) {
        global $db;

        $result = array();
        $messages = $db->query("SELECT `messages`.`id`, `messages`.`uid`, `messages`.`message`, `messages`.`date`, `users`.`login` FROM `messages` INNER JOIN `users` ON `messages`.`uid` = `users`.`id` WHERE `messages`.`tid` = '{$id}';");
        while ($row = $messages->fetch_assoc()) {
            $result[] = $row;
        }

        $test = count($result);

        return $result;
    }

    public static function  getCounterViewTopic($id){
        global $db;

        $view_topic = $db->query("SELECT `counter_view` FROM `topics` WHERE `id` = '{$id}';")->fetch_assoc();

        $view_topic['counter_view'] = $view_topic['counter_view'] + 1;

        $db->query("UPDATE topics SET counter_view = '{$view_topic['counter_view']}' WHERE id = '{$id}';");

        return  $view_topic['counter_view'];
    }

    public static function getUserMessagesAsHtml($id) {
        global $template;
        $_html = "";

        foreach (Topic::getUserMessagesAsArray($id) as $message) {
            $message_html = $template->getTextFromFile("/topic/user_message.tpl");
            $message_html = str_replace("{message_id}", $message["id"], $message_html);
            $message_html = str_replace("{user_id}", $message["uid"], $message_html);
            $message_html = str_replace("{user_login}", $message["login"], $message_html);
            $message_html = str_replace("{message_date}", $message["date"], $message_html);
            $message_html = str_replace("{message_text}", $message["message"], $message_html);

            $_html .= $message_html;
        }

        return $_html;
    }
    
    public static function sendAnswer($tid, $uid, $text){
        global $db;

        if($text == "") {
            return "Заполните поле сообщение.";
        } else if($uid <= 0) {
            return "Авторизуйтесь!";
        } else if($db->query("SELECT COUNT(*) FROM `topics` WHERE `id` = '{$tid}';")->num_rows() == 0){
            return "Неверный id темы.";
        }

        $text = $db->real_escape_string($text);
        $tid = $db->real_escape_string($tid);
        $uid = $db->real_escape_string($uid);
        
        if($db->query("INSERT INTO `messages` VALUES (null, '{$uid}', '{$tid}', '{$text}', NOW());")){
            return "Ваше сообщение отправлено!";
        } else {
            return "Произошло ошибка, сообщите системноу администратору.";
        }
    }
    
    public static function createTopic($title, $text, $uid, $parent){
        global $db;
        
        if($title == "") {
            return "Заполните заголовок топика.";
        } else if($text == "") {
            return "Заполните содержимое топика.";
        } else if($uid <= 0) {
            return "Авторизуйтесь!";
        } else if($db->query("SELECT `id` FROM `categories` WHERE `id` = '{$parent}';")->num_rows <= 0){
            return "Люк, кто твой отец?";
        }

        $title = $db->real_escape_string($title);
        $text = $db->real_escape_string($text);
        $uid = $db->real_escape_string($uid);
        
        if($db->query("INSERT INTO `topics` VALUES (null, '{$title}', '{$parent}', '1', '0', '0');")){
            $tid = $db->insert_id;
            header("/topic.id={$tid}");
            if($db->query("INSERT INTO `messages` VALUES (null, '{$uid}', '{$tid}', '{$text}', NOW());")){
                header("/topic.id={$tid}");
            }
            return "Хедер, заработай, плиз :с. Тема создалась короче, не ссы";
        } else {
            return "Произошло ошибка, сообщите системноу администратору.";
        }
    }
}