<?php

namespace App\Services;

use App\Repositories\RecipientRepository;

class RecipientService
{
    protected $recipientRepository;

    public function __construct(RecipientRepository $recipientRepository)
    {
        $this->recipientRepository = $recipientRepository;
    }

    public function storeRecipient(array $data)
    {
        return $this->recipientRepository->createRecipient($data);
    }
}
