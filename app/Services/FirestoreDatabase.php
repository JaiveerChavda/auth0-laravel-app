<?php

namespace App\Services;

use Google\Cloud\Firestore\FirestoreClient;

class FirestoreDatabase
{
    public function __construct(
        public $project_id,
        public $database = null
    ) {
        $this->database = new FirestoreClient(['projectId' => $project_id]);
    }

    /**
     * create new document for the collection
     *
     * @param  mixed  $collection  give the collection instance.
     * @param  string  $documentName  name the of document to create ex: john,jane.
     * @param  array  $attributes  attributes to insert in the new document.
     */
    public function createDoc($collection, string $documentName, array $attributes = []): void
    {
        $collection->document($documentName)->set($attributes);
    }
}
