<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRecipientRequest;
use App\Services\RecipientService;
use App\Http\Requests\StoreRecipientRequest;
use App\Http\Resources\RecipientResource;
use App\Exceptions\SearchNotFoundException;
use App\Http\Resources\RecipientCollection;

class RecipientController extends Controller
{
    private RecipientService $recipientService;

    public function __construct(RecipientService $recipientService)
    {
        $this->recipientService = $recipientService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SearchRecipientRequest $request)
    {
        $recipient = $this->recipientService->searchRecipient($request->validated());

        if ($recipient->count() <= 0) throw new SearchNotFoundException('Recipient not found');

        return new RecipientCollection($recipient);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecipientRequest $request)
    {
        $recipient = $this->recipientService->storeRecipient($request->validated());

        return (new RecipientResource($recipient, 'Created recipient successfully'))
            ->response()->setStatusCode(201);
    }
}
