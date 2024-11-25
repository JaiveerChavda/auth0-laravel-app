<?php

namespace App\Firestore;

use App\Services\FirestoreDatabase;

class UserCollection extends FirestoreDatabase
{
    public function __construct(FirestoreDatabase $database)
    {
        parent::__construct(config('services.firebase.project_id'));
    }

    public function createUser(string $documentName, array $attributes = [])
    {
        $this->collection()->document($documentName)->set($attributes);
    }

    public function collection(string $collectionName = 'users')
    {
        return $this->database->collection($collectionName);
    }

    public function findOrFail(string|int $documentName): array|bool
    {
        $docSnapshot = $this->collection()->document($documentName)->snapshot();

        if ($docSnapshot->exists()) {
            return $docSnapshot->data();
        }

        return false;
    }

    public function updateUser(string $documentName,array $attributes = []){
        $this->collection()->document($documentName)->set($attributes,['merge' => true]);
    }
}
