<?php

namespace App\Http\Controllers;

use App\Models\Instruction;
use App\Services\InternalService;
use App\Http\Requests\StoreInternalAttachmentRequest;
use App\Http\Requests\DeleteInternalAttachmentRequest;
use App\Http\Resources\InternalResource;

class InternalController extends Controller
{
    private InternalService $internalService;

    public function __construct(InternalService $internalService)
    {
        $this->internalService = $internalService;
    }

    public function store(StoreInternalAttachmentRequest $request, Instruction $instruction)
    {
        $data = $request->validated();

        if(!$instruction->internal){
            $internal = $this->internalService->storeInternal($data, $instruction);
            $code = 201;
        } else {
            $internal = $this->internalService->addAttachment($data, $instruction, $instruction->internal);
            $code = 200;
        }

        return (new InternalResource($internal, "Successfully added internal attachment"))->response()->setStatusCode($code);
    }

    public function destroy(DeleteInternalAttachmentRequest $request, Instruction $instruction)
    {
        $data = $request->validated();

        $internal = $this->internalService->deleteAttachment($data, $instruction->internal);

        return new InternalResource($internal, "Successfully deleted internal attachment");
    }
}
