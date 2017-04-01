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

        return $result;
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
}