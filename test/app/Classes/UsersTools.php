<?php 

namespace App\Classes;

use App\Models\User;
use Illuminate\Support\Str;

class UsersTools
{

    public function getFreeUsers()
    {
        $allUsers = User::all();
        $freeUsers = [];
        foreach($allUsers as $user)
        {
            if($user->document == null)
            {
                array_push($freeUsers , $user);
            }
        }
        return $freeUsers;
    }

    public function getAllUsers()
    {
        $allUsers = User::all();
        return $allUsers;
    }


    public function userInformations()
    {
        $names = ['ali', 'reza', 'hassan' , 'hosein' ,'hamind' , 'ahmad' , 'sina' , 'mohammad'];
        $userName = $names[random_int(0,7)] . Str::random(5) . random_int(0,100);

        $emails = ['@gmail.com','@yahoo.com','@hotmail.com'];
        $userEmail = $userName . $emails[random_int(0,2)];

        $informations = ['name' => $userName ,'email' => $userEmail];


        return $informations;
    }

    
}