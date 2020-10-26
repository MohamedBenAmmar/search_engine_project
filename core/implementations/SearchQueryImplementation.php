<?php


namespace Core;

use ArrayObject;
use Entities\SearchQuery;
use Interfaces\ISearchQuery;
use Database\Db;
use Entities\Client;

class SearchQueryImplementation implements ISearchQuery
{

    public static function createSearchCriteria(SearchQuery $query): void
    {

        $content = $query->getContent();
        if ($_SESSION['user']) {
            $db = Db::getInstance();
            $sql = " INSERT INTO searchquery (content,id_user,criterias) VALUES (:content,:user,:criterias) ";
            $q = $db->prepare($sql);
            $obj = $_SESSION['user'];
            $user = casttoclass(Client::class, $obj);
            $id = $user->getId();
            $criterias = $query->getCriterias();
            $result = json_encode($criterias, JSON_FORCE_OBJECT);
            $q->bindParam(':content', $content);
            $q->bindParam(':user', $id);
            $q->bindParam(':criterias',$result);
            $q->execute();
        } else {
            echo 'not an instance of user ...';
        }
    }

    public static function fetchSearchQueries(): ArrayObject
    {
        $db = Db::getInstance();
        $sql = " SELECT * FROM searchquery";
        $finalResult = new ArrayObject();
        $query = $db->query($sql);
        $result = $query->fetchAll();
        foreach ($result as $item) {
            $searchQuery = new SearchQuery();
            $searchQuery->setId($item['id']);
            $searchQuery->setContent($item['content']);
            $searchQuery->setCriterias($item['criterias']);
            $finalResult->append($searchQuery);
        }
        return $finalResult;
    }

    public static function getPublicationByCriterias(SearchQuery $query): ArrayObject
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM post WHERE content LIKE CONCAT('%', :search_content, '%')";
        foreach ($query->getCriterias() as $key=>$value){
            switch ($key){
                case 'post_category':
                    $sql.= " AND id_category = :$key";
                    break;
                case 'creation_date':
                    $sql.= " AND YEAR(createdAt) = YEAR(:$key) AND MONTH(createdAt) = MONTH(:$key) ";
                    break;
                case 'update_date':
                    $sql.= "AND YEAR(updatedAt) = YEAR(:$key) AND MONTH(updatedAt) = MONTH(:$key) ";
                    break;
            }
        }
        echo $sql;
        $qq = $db->prepare($sql);
        var_dump($qq);
        var_dump($query->getCriterias());
        $content = $query->getCriterias()['search_content'];
        foreach ($query->getCriterias() as $key=>$value){
                echo "binded key : $key with the value $value <br>";
                $qq->bindValue(":$key",$value);
        }
        $qq->execute();
        $result = $qq->fetchAll();
        var_dump($result);

        return new ArrayObject();
    }
}