<?php

class Topic
{

    public static function getTitle($id)
    {
        global $db;

        $title = $db->query("SELECT `title` FROM `topics` WHERE `id` = '{$id}';")->fetch_assoc();

        return $title["title"];
    }

    public static function getUserMessagesAsArray($id)
    {
        global $db;

        $result = array();
        $messages = $db->query("SELECT `messages`.`id`, `messages`.`uid`, `messages`.`message`, `messages`.`date`, `users`.`login` FROM `messages` INNER JOIN `users` ON `messages`.`uid` = `users`.`id` WHERE `messages`.`tid` = '{$id}';");
        while ($row = $messages->fetch_assoc()) {
            $result[] = $row;
        }

        $test = count($result);

        return $result;
    }

    public static function getCounterViewTopic($id)
    {
        global $db;

        $view_topic = $db->query("SELECT `counter_view` FROM `topics` WHERE `id` = '{$id}';")->fetch_assoc();
        $db->query("UPDATE `topics` SET `counter_view` = `counter_view` + 1 WHERE `id` = '{$id}';");

        return $view_topic['counter_view'] + 1;
    }

    public static function getUserMessagesAsHtml($id)
    {
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

    public static function sendAnswer($tid, $uid, $text)
    {
        global $db;

        if ($text == "") {
            return "Заполните поле сообщение.";
        } else if ($uid <= 0) {
            return "Авторизуйтесь!";
        } else if ($db->query("SELECT `id` FROM `topics` WHERE `id` = '{$tid}';")->num_rows <= 0) {
            return "Неверный id темы.";
        }

        $parent = $db->query("SELECT `parent` FROM `topics` WHERE `id` = '{$tid}';")->fetch_assoc();
        $text = $db->real_escape_string($text);
        $tid = $db->real_escape_string($tid);
        $uid = $db->real_escape_string($uid);

        if ($db->query("INSERT INTO `messages` VALUES (null, '{$uid}', '{$tid}', '{$text}', NOW());")) {
            //Кол-во сообщений +1
            $db->query("UPDATE `topics` SET `counter_messages` = `counter_messages` + 1 WHERE id = '{$tid}';");
            $db->query("UPDATE `categories` SET `categories_counter_messages` = `categories_counter_messages` + 1 WHERE `id` = '{$parent["parent"]}';");

            Topic::addCounterCategoriesViewMessages($parent["parent"]);

            return "Ваше сообщение отправлено!";
        } else {
            return "Произошло ошибка, сообщите системноу администратору.";
        }
    }

    public static function addCounterCategoriesViewMessages($id){
        global $db;

        $parent_section = $db->query("SELECT `parent` FROM `categories` WHERE `id` = '{$id}';")->fetch_assoc();

        if ($parent_section["parent"] != NULL) {
                Topic::addCounterCategoriesViewMessages($parent_section["parent"]);
        }

        $db->query("UPDATE `categories` SET `categories_counter_messages` = `categories_counter_messages` + 1 WHERE `id` = '{$id}';");
    }

    public static function addCounterCategoriesViewTopics($id){
        global $db;

        $parent_section = $db->query("SELECT `parent` FROM `categories` WHERE `id` = '{$id}';")->fetch_assoc();

        if ($parent_section["parent"] != NULL) {
            Topic::addCounterCategoriesViewTopics($parent_section["parent"]);
        }

        $db->query("UPDATE `categories` SET `categories_counter_topics` = `categories_counter_topics` + 1 WHERE `id` = '{$id}';");
    }

    public static function createTopic($title, $text, $uid, $parent)
    {
        global $db;

        if ($title == "") {
            return "Заполните заголовок топика.";
        } else if ($text == "") {
            return "Заполните содержимое топика.";
        } else if ($uid <= 0) {
            return "Авторизуйтесь!";
        } else if ($db->query("SELECT `id` FROM `categories` WHERE `id` = '{$parent}';")->num_rows <= 0) {
            return "Люк, кто твой отец?";
        }

        $title = $db->real_escape_string($title);
        $text = $db->real_escape_string($text);
        $uid = $db->real_escape_string($uid);

        //Кол-во тем +1
        $db->query("UPDATE `categories` SET `categories_counter_topics` = `categories_counter_topics` + 1 WHERE `id` = '{$parent}';");
        $db->query("UPDATE `categories` SET `categories_counter_messages` = `categories_counter_messages` + 1 WHERE `id` = '{$parent}';");

        Topic::addCounterCategoriesViewTopics($parent["parent"]);

        if ($db->query("INSERT INTO `topics` VALUES (null, '{$title}', '{$parent}', '1', '0', '0');")) {
            $tid = $db->insert_id;
            ob_start();
            header("Location: /topic.id=" . $tid);
            ob_end_flush();
            $db->query("INSERT INTO `messages` VALUES (null, '{$uid}', '{$tid}', '{$text}', NOW());");

            return true;
        } else {
            return "Произошло ошибка, сообщите системноу администратору.";
        }
    }
}