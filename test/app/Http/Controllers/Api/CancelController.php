<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Classes\DocumentsTools;
use App\Http\Controllers\Controller;

class CancelController extends Controller
{
    

    
    public function cancel(User $user , Document $document)
    {

        if($document->user_id != $user->id)
        {
            return ['status' => 'error' , 'message' => 'not allowed for this user to do changes on this document!'];
        }

        $documentsTools = new DocumentsTools;
        $result = $documentsTools->cancelDocument($document);

        if($result)
        {
            return ['status' => 'success' , 'message' => 'document canceled successfully!'];

        }

        return ['status' => 'failed' , 'message' => 'canceling document failed!'];

    }
}
