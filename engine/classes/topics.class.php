<?php

class Topics
{
    public static function getTopicsAsArray()
    {
        global $db;

        $result = array();

        $cat = $db->query("SELECT `id`, `name` FROM `topics` WHERE `parent` IS NULL;");
        while ($row = $cat->fetch_array(MYSQLI_ASSOC)) {
            $subcat = $db->query("SELECT `id`, `name` FROM `topics` WHERE `parent` = '" . $row["id"] . "';");
            while ($subrow = $subcat->fetch_array(MYSQLI_ASSOC)) {
                $row["subs"][] = $subrow;
            }
            $result[] = $row;
        }

        return $result;
    }

    public static function getTopicsAsHtml()
    {
        global $template;

        $_html = "";
        foreach (Topics::getTopicsAsArray() as $cat) {
            $cat_html = $template->getTextFromFile("/section/topics/topics.tpl");

            $cat_html = str_replace("{_ID}", $cat["id"], $cat_html);
            $cat_html = str_replace("{_NAME}", $cat["name"], $cat_html);

            $sub_html = "";
            foreach ($cat["subs"] as $sub) {
                $sub_html_t = $template->getTextFromFile("/section/topics/sub_topics.tpl");
                $sub_html_t = str_replace("{_NAME}", $sub["name"], $sub_html_t);
                $sub_html .= $sub_html_t;
            }

            $cat_html = str_replace("{sub_topics}", $sub_html, $cat_html);
            $_html .= $cat_html;
        }

        return $_html;
    }
}