<?php

namespace Interfaces;

use Entities\SearchQuery;
use ArrayObject;

interface ISearchQuery
{
    public static function createSearchCriteria(SearchQuery $query): void;


    public static function fetchSearchQueries(): ArrayObject;


    public static function getPublicationByCriterias(SearchQuery $query): ArrayObject;

}