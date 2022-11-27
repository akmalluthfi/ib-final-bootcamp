<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRecipientRequest;
use Illuminate\Http\Request;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
