<?php

namespace Core;

use Database\Db;
use DateTime;
use Entities\User;
use Entities\Client;
use Entities\Admin;
class UserCore implements \Interfaces\IUser
{

    public static function login(string $username, string $password): bool
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM user WHERE username = :username AND password = :password";
        $query = $db->prepare($sql);
        $query->bindParam(':username',$username);
        $query->bindParam(':password',$password);
        $query->execute();
        $result = $query->fetchAll();
        if (count($result) == 1){
            switch ($result[0]['role']){
                case 'client' :
                    $_SESSION['role'] = 'client';
                    $client = new \Entities\Client();
                    $client->setId($result[0]['id']);
                    $client->setFullname($result[0]['fullName']);
                    $client->setLogin($result[0]['username']);
                    $client->setPassword($result[0]['password']);
                    $client->setIsActive($result[0]['isActive']);
                    $client->setBirthdate(new DateTime($result[0]['birthDate']));
                    $client->setLastConnection(new DateTime('now'));
                    $client->setRole($result[0]['role']);
                    $query->closeCursor();
                    $sql = "SELECT * FROM client WHERE id_user = :client";
                    $query = $db->prepare($sql);
                    $id = $client->getId();
                    $query->bindParam(':client',$id);
                    $query->execute();
                    $result2 = $query->fetch();
                    $client->setNbQueries($result2['nbQuery']);
                    $_SESSION['user'] = $client;
                    return true ;
                case 'admin' :
                    $_SESSION['role'] = 'admin';
                    $admin = new \Entities\Admin();
                    $admin->setId($result[0]['id']);
                    $admin->setFullname($result[0]['fullName']);
                    $admin->setLogin($result[0]['username']);
                    $admin->setPassword($result[0]['password']);
                    $admin->setIsActive($result[0]['isActive']);
                    $admin->setBirthdate(new DateTime($result[0]['birthDate']));
                    $admin->setLastConnection(new DateTime('now'));
                    $admin->setRole($result[0]['role']);
                    $_SESSION['user'] = $admin;
                    return true ;
                    break;
                default :
                    return false;
            }
        }

    }

    public static function subscribeAsClient(\Entities\Client $client)
    {
        // TODO: Implement subscribeAsClient() method.
    }

    public static function subscribeAsAdmin(\Entities\Admin $admin)
    {
        // TODO: Implement subscribeAsAdmin() method.
    }
}