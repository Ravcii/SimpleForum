<?php

class Categories
{
    public static function getCategoriesAsArray()
    {
        global $db;

        $result = array();

        $cat = $db->query("SELECT `id`, `name` FROM `categories` WHERE `parent` IS NULL;");
        while ($row = $cat->fetch_array(MYSQLI_ASSOC)) {
            $subcat = $db->query("SELECT `id`, `name` FROM `categories` WHERE `parent` = '" . $row["id"] . "';");
            while ($subrow = $subcat->fetch_array(MYSQLI_ASSOC)) {
                $row["subs"][] = $subrow;
            }
            $result[] = $row;
        }

        return $result;
    }

    public static function getCategoriesAsHtml()
    {
        global $template;

        $_html = "";
        foreach (Categories::getCategoriesAsArray() as $cat) {
            $cat_html = $template->getTextFromFile("category.tpl");

            $cat_html = str_replace("{_ID}", $cat["id"], $cat_html);
            $cat_html = str_replace("{_NAME}", $cat["name"], $cat_html);

            $sub_html = "";
            foreach ($cat["subs"] as $sub) {
                $sub_html_t = $template->getTextFromFile("subcategory.tpl");
                $sub_html_t = str_replace("{_NAME}", $sub["name"], $sub_html_t);
                $sub_html .= $sub_html_t;
            }

            $cat_html = str_replace("{sub_categories}", $sub_html, $cat_html);
            $_html .= $cat_html;
        }

        return $_html;
    }


    public static function getMessagesAsHtml()
    {
        global $template;
        $_html = "";
        $_html .= $template->getTextFromFile("open_topic.tpl");

        return $_html;
    }

    public static function getFormMessagesAsHtml()
    {
        global $template;
        $_html = "";
        $_html .= $template->getTextFromFile("form_messages.tpl");

        return $_html;
    }

    public static function getMessagesUsersAsHtml()
    {
        global $template;
        $_html = "";
        $_html .= $template->getTextFromFile("users_messages.tpl");

        return $_html;
    }
}