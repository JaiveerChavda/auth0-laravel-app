<?php 

interface FirestoreDatabase
{
    public function create($docRef, array $attributes = []);
}