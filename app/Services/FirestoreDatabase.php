<?php

namespace App\Services;

use Google\Cloud\Firestore\FirestoreClient;

class FirestoreDatabase
{
    public function __construct(
        public $project_id,
        public $database = null
        )
    {
        $this->database = new FirestoreClient(['projectId' => $project_id]);
    }

    /**
     * create new document for the collection
     * @param mixed $docRef give the document instance.
     * @param array $attributes attributes to insert in the new doc.
     * @return void
     */
    public function createDoc($docRef, array $attributes = []):void{
        $docRef->set($attributes);
    }
}
