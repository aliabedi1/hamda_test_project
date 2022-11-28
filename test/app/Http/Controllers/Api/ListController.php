<?php

namespace App\Http\Controllers\Api;

use App\Classes\UsersTools;
use Illuminate\Http\Request;
use App\Classes\DocumentsTools;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function documents()
    {
        
        $documentsTools = new DocumentsTools;
        $documents = $documentsTools->getAllDocuments();
        $allDocumentsAsArray = [];

        
        foreach ($documents as $document)
        {
            $allocatedTo = $document->user ? $document->user->id : null;
            $expireTimestamp = $document->expire ? $document->expire->expire_timestamp : null;
            $fields = [
                'id'                => $document->id,
                'body'              => $document->body,
                'finished'          => $document->finished,
                'allocated_to'      => $allocatedTo,
                'expire_timestamp'  => $expireTimestamp,
                'created_at'        => $document->created_at,
                'status'            => $document->status,
            ];

            array_push($allDocumentsAsArray , $fields);
        } 
        return $allDocumentsAsArray;
    }


    public function users()
    {
        $userTools = new UsersTools;
        $users = $userTools->getAllUsers();
        $allUsersAsArray = [];

        foreach ($users as $user)
        {
            $userType = $user->type == 1 ? 'reviewer' : 'registrar';
            $allocatedDocumentID = $user->document ? $user->document->id : null;
            $allocatedDocumentBody = $user->document ? $user->document->body : null;
            $fields = [
                'id'                            => $user->id,
                'name'                          => $user->name,
                'email'                         => $user->email,
                'password'                      => $user->password,
                'type'                          => $userType,
                'allocated_document_id'         => $allocatedDocumentID,
                'allocated_document_body'       => $allocatedDocumentBody,
            ];

            array_push($allUsersAsArray , $fields);
        } 

        return $allUsersAsArray;
    }
}
