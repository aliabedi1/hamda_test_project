<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Classes\DocumentsTools;
use App\Http\Controllers\Controller;

class DoneController extends Controller
{
    public function do(User $user , Document $document)
    {
        if($document->user->id != $user->id)
        {
            return ['status' => 'error' , 'message' => 'not allowed for this user to do changes on this document!'];
        }

        $documentsTools = new DocumentsTools;
        $result = $documentsTools->finishDocument($document);

        if($result)
        {
            return ['status' => 'success' , 'message' => 'document finished successfully!'];

        }

        return ['status' => 'failed' , 'message' => 'finishing document failed! job already finished!'];

    }
}
