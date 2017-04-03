<?php

class Section {
    
    public static function getTitle($id){
        global $db;
        
        $title = $db->query("SELECT `name` FROM `categories` WHERE `id` = '{$id}';")->fetch_assoc();
        
        return $title["name"];
    }

    public static function getSubCategoriesAsArray($parentId)
    {
        global $db;

        $result = array();

        $cat = $db->query("SELECT `id`, `name` FROM `categories` WHERE `parent` = '{$parentId}';");
        while ($row = $cat->fetch_assoc()) {

            $result[] = $row;
        }

        return $result;
    }

    public static function getSubCategoriesAsHtml($parentId)
    {
        global $template;
        
        $subCats = Section::getSubCategoriesAsArray($parentId);
        
        var_dump($subCats);
        
        if(empty($subCats)) return "";

        $_html = "";
        foreach ($subCats as $cat) {
            $cat_html = $template->getTextFromFile("/section/sub_category.tpl");

            $cat_html = str_replace("{_ID}", $cat["id"], $cat_html);
            $cat_html = str_replace("{_NAME}", $cat["name"], $cat_html);


            $_html .= $cat_html;
        }

        return $_html;
    }

    public static function getTopicsAsArray($parentId)
    {
        global $db;

        $result = array();

        $cat = $db->query("SELECT `id`, `title` FROM `topics` WHERE `parent` = '{$parentId}';");
        while ($row = $cat->fetch_assoc()) {
            $result[] = $row;
        }

        return $result;
    }

    public static function getTopicsAsHtml($parentId)
    {
        global $template;

        $_html = "";
        foreach (Section::getTopicsAsArray($parentId) as $cat) {
            $cat_html = $template->getTextFromFile("/section/sub_topics.tpl");

            $cat_html = str_replace("{_ID}", $cat["id"], $cat_html);
            $cat_html = str_replace("{_NAME}", $cat["title"], $cat_html);


            $_html .= $cat_html;
        }

        return $_html;
    }
}