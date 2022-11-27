<?php

namespace App\Repositories;

use App\Models\Recipient;

class RecipientRepository
{
    public function createRecipient(array $data)
    {
        $recipient = Recipient::create([
            'email' => $data['email']
        ]);

        return $recipient;
    }

    public function getRecipient($search)
    {
        return Recipient::latest()->search($search)->paginate(10);
    }

    public function getAll()
    {
        return Recipient::latest()->paginate(10);
    }
}
