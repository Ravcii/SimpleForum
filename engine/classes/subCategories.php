<?php

class SubCategories
{
    public static function getSubCategoriesAsArray()
    {
        global $db;

        $result = array();

        $cat = $db->query("SELECT `id`, `name` FROM `subcategories` WHERE `parent` IS NULL;");
        while ($row = $cat->fetch_assoc()) {
            $subcat = $db->query("SELECT `id`, `name` FROM `subcategories` WHERE `parent` = '" . $row["id"] . "';");
            while ($subrow = $subcat->fetch_assoc()) {
                $row["subs"][] = $subrow;
            }
            $result[] = $row;
        }

        return $result;
    }

    public static function getCategoriesCounterMessages($id){

        global $db;

        $counter_messages =  $db->query("SELECT `sub_counter_messages` FROM `subcategories` WHERE id='{$id}';")->fetch_assoc();

        $messages_topics = $db->query("SELECT `counter_messages` FROM `topics` WHERE id='{$id}';")->fetch_assoc();

        $counter_messages['sub_counter_messages'] = $counter_messages['sub_counter_messages'] + $messages_topics['counter_messages'];

        $db->query("UPDATE `subcategories` SET `sub_counter_messages` = '{$counter_messages['sub_counter_messages']}' WHERE `id` = '{$id}';");

        return $counter_messages['sub_counter_messages'];
    }

    public static function getSubCategoriesAsHtml()
    {
        global $template;

        $_html = "";
        foreach (SubCategories::getSubCategoriesAsArray() as $cat) {
            $cat_html = $template->getTextFromFile("/section/section.tpl");

            $cat_html = str_replace("{_ID}", $cat["id"], $cat_html);
            $cat_html = str_replace("{_NAME}", $cat["name"], $cat_html);

            $sub_html = "";
            foreach ($cat["subs"] as $sub) {
                $sub_html_t = $template->getTextFromFile("/section/sub_section.tpl");
                $sub_html_t = str_replace("{_NAME}", $sub["name"], $sub_html_t);
                $sub_html_t = str_replace("{sub_counter_view}", $sub["sub_counter_messages"], $sub_html_t);
                $sub_html .= $sub_html_t;
            }

            $cat_html = str_replace("{sub_sections}", $sub_html, $cat_html);
            $_html .= $cat_html;
        }

        return $_html;
    }
}