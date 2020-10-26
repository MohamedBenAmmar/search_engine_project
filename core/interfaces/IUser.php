<?php
namespace Interfaces;

interface IUser{
    public static function login(string $username,string $password):bool;
    public static function subscribeAsClient(\Entities\Client $client);
    public static function subscribeAsAdmin(\Entities\Admin $admin);
}