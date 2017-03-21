<?php

class Topic
{
    public static function getMessagesAsHtml()
    {
        global $template;
        $_html = "";
        $_html .= $template->getTextFromFile("/topic/open_topic.tpl");

        return $_html;
    }

    public static function getFormMessagesAsHtml()
    {
        global $template;
        $_html = "";
        $_html .= $template->getTextFromFile("/topic/form_messages.tpl");
        return $_html;
    }

    public static function getMessagesUsersAsHtml()
    {
        global $template;
        $_html = "";
        $_html .= $template->getTextFromFile("/topic/users_messages.tpl");
        return $_html;
    }

}