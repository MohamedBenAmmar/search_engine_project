<?php
if (isset($_SESSION['user']) && isset($_SESSION['role'])){
    if ($_SESSION['role'] == 'client') {
        if (isset($_POST['search-content']) && isset($_POST['post-category']) && isset($_POST['creation-date']) &&
        isset($_POST['update-date'])){
            $criterias = array();
            $searchQuery = new \Entities\SearchQuery();
            $criterias['search_content'] = $_POST['search-content'];
            if ($_POST['post-category'] >0){
                $criterias['post_category'] = $_POST['post-category'];
            }
            if ($_POST['creation-date'] != '')
            {
                $criterias['creation_date'] = $_POST['creation-date'];
            }
            if ($_POST['update-date'] != ''){
                $criterias['update_date'] = $_POST['update-date'];
            }
            $searchQuery->setCriterias($criterias);
            $searchQuery->setContent($_POST['search-content']);
            var_dump($criterias);
            \Core\SearchQueryImplementation::createSearchCriteria($searchQuery);
            \Core\SearchQueryImplementation::getPublicationByCriterias($searchQuery);
        } else {
            echo 'params not satisfied !!!';
            $categories = \Core\CategoryImplementation::fetchCategories();
            require 'views/ClientHome.php';
        }
        // Logic to be implemented soon ...
    }
    else if ($_SESSION['role'] == 'admin') {
        // Redirecting to the admin controller ...
        require 'views/AdminHome.php';
    }
}
else {
    header('Location: index.php?controller=login');
}