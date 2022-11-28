<?php

namespace App\Classes;

use App\Models\User;
use App\Models\Document;
use Illuminate\Support\Str;
use App\Models\DocumentExpireTimeStamp;
use Carbon\Carbon;

class DocumentsTools
{


    public function getAllDocuments()
    {
        $documents = Document::orderBy('created_at', 'desc')->get();
        return $documents;
    }


    public function getUnfinishedDocuments()
    {
        $documents = Document::where('finished' , 0)->orderBy('created_at', 'desc')->get();
        return $documents;
    }


    public function getNotAllocatedDocuments()
    {
        $freeDocuments = Document::where('user_id', null)->where('finished' , 0)->orderBy('created_at', 'desc')->get();
        return $freeDocuments;
    }


    public function allocateDocumentToUser(User $user, Document $document)
    {
        //allocate document to user
        $document->user_id = $user->id;
        $document->update();

        //allocate expire timestamp to document 
        $data['document_id'] = $document->id;
        $data['expire_timestamp'] = Carbon::now()->addMinutes(10);
        $expire_timestamp = DocumentExpireTimeStamp::create($data);

        //todo add return or not
        return true;

    }

    public function finishDocument(Document $document)
    {
        if($document->finished == 1)
        {
            return false;
        }

        $document->finished = 1;
        $document->update();

        $documentExpireTimestamp = DocumentExpireTimeStamp::where('document_id', $document->id)->first();
        $result = $documentExpireTimestamp->delete();

        return $result;
    }


    public function cancelDocument(Document $document)
    {
        if($document->finished == 1)
        {
            return false;
        }
        $document->user_id = null;
        $firstResult = $document->update();
        
        $documentExpireTimestamp = DocumentExpireTimeStamp::where('document_id', $document->id)->first();
        $SecondResult = $documentExpireTimestamp->delete();
        return true;
        
    }


    public function backToBasicState()
    {

        $documents = Document::where('finished', 0)->where('user_id','!=' , null)->get(); 

        foreach($documents as $document)
        {

            if($document->expire && strtotime( $document->expire->expire_timestamp) < time())
            {
                $outDatedDocument = Document::find($document->id);
                $outDatedDocument->user_id = null;
                $outDatedDocument->update();
                $document->expire->delete();
            }
        }

    }

    public function documentBody()
    {
        $bodyName = 'document'. Str::random(5) . random_int(0,100);
        return $bodyName;
    }









}