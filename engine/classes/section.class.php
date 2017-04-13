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
        $subCategories = $db->query("SELECT `id`, `name`, `categories_counter_topics`, `categories_counter_messages` FROM `categories` WHERE `parent` = '{$parentId}';");
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
            $categoryHtml = str_replace("{categories_counter_topics}", $cat["categories_counter_topics"], $categoryHtml);
            $categoryHtml = str_replace("{categories_counter_messages}", $cat["categories_counter_messages"], $categoryHtml);

            $categoriesHtml .= $categoryHtml;
        }
        
        $returnHtml = str_replace("{categories}", $categoriesHtml, $returnHtml);

        return $returnHtml;
    }

    public static function getTopicsAsArray($parentId)
    {
        global $db;

        $result = array();

        $topics = $db->query("SELECT `id`, `title`, `counter_messages` ,`counter_view` FROM `topics` WHERE `parent` = '{$parentId}';");
        while ($row = $topics->fetch_assoc()) {
            $result[] = $row;
        }

        return $result;
    }

    public static function  getLastMessagesUser($id){
        global $db;

        $all_messages = $db->query("SELECT `id`, `uid` FROM `messages` WHERE `tid` = '{$id}';");

        while ($row = $all_messages->fetch_assoc()) {
            $result[] = $row;
        }
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
            $topicHtml = str_replace("{counter_view}", $topic["counter_view"], $topicHtml);
            $topicHtml = str_replace("{counter_messages}", $topic["counter_messages"], $topicHtml);
            $topicHtml = str_replace("{counter_messages}", $topic["counter_messages"], $topicHtml);

            $topicsHtml .= $topicHtml;
        }
        
        $returnHtml = str_replace("{topics}", $topicsHtml, $returnHtml);

        return $returnHtml;
    }
}
