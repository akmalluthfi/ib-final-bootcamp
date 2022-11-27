<?php

namespace App\Repositories;

use App\Models\Recipient;

class RecipientRepository
{
    public function createRecipient(array $data)
    {
        $recipient = Recipient::create([
            'name' => $data['name'],
            'email' => $data['email']
        ]);

        return $recipient;
    }
}
