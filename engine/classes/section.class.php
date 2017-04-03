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
        $subCategories = $db->query("SELECT `id`, `name` FROM `categories` WHERE `parent` = '{$parentId}';");
        while ($row = $subCategories->fetch_assoc()) {
            $result[] = $row;
        }

        return $result;
    }

    public static function getSubCategoriesAsHtml($parentId)
    {
        global $template;
        
        $subCats = Section::getSubCategoriesAsArray($parentId);
        if(empty($subCats)) return "";

        $returnHtml = $template->getTextFromFile("/section/categories_placer.tpl");
        $categoriesHtml = "";
        foreach ($subCats as $cat) {
            $categoryHtml = $template->getTextFromFile("/section/category.tpl");

            $categoryHtml = str_replace("{cat_id}", $cat["id"], $categoryHtml);
            $categoryHtml = str_replace("{cat_name}", $cat["name"], $categoryHtml);

            $categoriesHtml .= $categoryHtml;
        }
        
        $returnHtml = str_replace("{categories}", $categoriesHtml, $returnHtml);

        return $returnHtml;
    }

    public static function getTopicsAsArray($parentId)
    {
        global $db;

        $result = array();

        $topics = $db->query("SELECT `id`, `title` FROM `topics` WHERE `parent` = '{$parentId}';");
        while ($row = $topics->fetch_assoc()) {
            $result[] = $row;
        }

        return $result;
    }

    public static function getTopicsAsHtml($parentId)
    {
        global $template;
        
        $topics = Section::getTopicsAsArray($parentId);
        if(empty($topics)) return "";

        $returnHtml = $template->getTextFromFile("/section/topics_placer.tpl");
        $topicsHtml = "";
        foreach ($topics as $topic) {
            $topicHtml = $template->getTextFromFile("/section/topic.tpl");

            $topicHtml = str_replace("{topic_id}", $topic["id"], $topicHtml);
            $topicHtml = str_replace("{topic_name}", $topic["title"], $topicHtml);

            $topicsHtml .= $topicHtml;
        }
        
        $returnHtml = str_replace("{topics}", $topicsHtml, $returnHtml);

        return $returnHtml;
    }
}