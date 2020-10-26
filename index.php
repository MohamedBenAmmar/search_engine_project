<?php
session_start();
require_once 'utils/Db.php';
require_once 'entities/User.php';
require_once 'entities/Client.php';
require_once 'entities/Admin.php';
require_once 'entities/Category.php';
require_once  'entities/SearchQuery.php';
require_once 'core/interfaces/IUser.php';
require_once  'core/interfaces/ISearchQuery.php';
require_once 'core/implementations/UserCore.php';
require_once  'core/interfaces/ICategory.php';
require_once  'core/implementations/CategoryImplementation.php';
require_once  'core/implementations/SearchQueryImplementation.php';
if (isset($_GET['controller'])) {
    switch ($_GET['controller']) {
        case '':
            require 'controllers/IndexController.php';
            break;
        case 'login':
            require 'controllers/LoginController.php';
            break;
        case 'admin-user':
            break;
        case 'post' :
            break;
        case 'admin-queries':
            break;
        default :
            break;

    }
}


function casttoclass($class, $object)
{
    return unserialize(preg_replace('/^O:\d+:"[^"]++"/', 'O:' . strlen($class) . ':"' . $class . '"', serialize($object)));
}