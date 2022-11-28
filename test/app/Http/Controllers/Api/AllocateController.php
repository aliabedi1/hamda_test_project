<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Classes\UsersTools;
use App\Classes\DocumentsTools;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;

class AllocateController extends Controller
{
    
    public function all()
    {
        $userTools = new UsersTools;
        $users = $userTools->getFreeUsers();
        $documentsTools = new DocumentsTools;
        $documents = $documentsTools->getNotAllocatedDocuments();
        
        if(sizeof($users) >= sizeof($documents))
        {
            $index = 0;
            foreach($documents as $document)
            {
                $documentsTools->allocateDocumentToUser($users[$index],$document);
                $index++;
            }

            return ['status' => 'success' , 'message' => 'Allocated successfully!'];
        }
        else if(sizeof($users) < sizeof($documents))
        {
            $index = 0;
            foreach($users as $key => $user)
            {
                $documentsTools->allocateDocumentToUser($user,$documents[$index]);
                $index++;
            }
            return ['status' => 'success' , 'message' => 'Allocated successfully!'];

        }
        else
        {
            return ['status' => 'failed' , 'message' => 'Allocation failed!'];

        }

    }





    public function exclusive(User $user , Document $document)
    {
        $documentsTools = new DocumentsTools;
        $result = $documentsTools->allocateDocumentToUser($user,$document);
        
        if($result)
        {
            return ['status' => 'success' , 'message' => 'Allocated successfully!'];
        }
        
        return ['status' => 'failed' , 'message' => 'Allocation failed!'];
    }


}
