<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Document;
use App\Classes\UsersTools;
use Illuminate\Http\Request;
use App\Classes\DocumentsTools;
use App\Http\Controllers\Controller;

class MakeController extends Controller
{
    public function document()
    {
        $documentsTools = new DocumentsTools;
        $data = [
            'body' => $documentsTools->documentBody(),
        ];

        $result = Document::create($data);
        
        if($result)
        {
            return ['status' => 'success' , 'message' => 'document generated successfully!'];


        }
        return ['status' => 'failed' , 'message' => 'generating document failed!'];

    }


    public function registrar()
    {
        $userTools = new UsersTools;
        $informations = $userTools->userInformations();
        $data = [
            'name'   => $informations['name'],
            'email'  => $informations['email'],
            'password'  => '123',
            'type'  => 0,

        ];

        $result = User::create($data);
        
        if($result)
        {
            return ['status' => 'success' , 'message' => 'registrar user generated successfully!'];


        }
        return ['status' => 'failed' , 'message' => 'generating registrar user failed!'];

    }


    public function reviewer()
    {
        
        $userTools = new UsersTools;
        $informations = $userTools->userInformations();
        $data = [
            'name'   => $informations['name'],
            'email'  => $informations['email'],
            'password'  => '123',
            'type'  => 1,

        ];

        $result = User::create($data);
        
        if($result)
        {
            return ['status' => 'success' , 'message' => 'reviewer user generated successfully!'];


        }
        return ['status' => 'failed' , 'message' => 'generating reviewer user failed!'];

    
    }
}
