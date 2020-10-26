<?php


namespace Core;


use ArrayObject;
use Database\Db;
use Entities\Category;

class CategoryImplementation implements \ICategory
{

    public static function fetchCategories(): ArrayObject
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM CATEGORY";
        $query = $db->query($sql);
        $finalResult = new ArrayObject();
        $results = $query->fetchAll();
        foreach ($results as $item){
            $category = new Category();
            $category->setId($item['id']);
            $category->setLabel($item['label']);
            $finalResult->append($category);
        }
        return $finalResult;
    }
}