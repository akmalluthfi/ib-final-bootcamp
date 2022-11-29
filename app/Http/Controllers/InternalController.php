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

        $internal = $this->internalService->addAttachment($data, $instruction, $instruction->internal);

        return new InternalResource($internal, "Successfully added internal attachment");
    }

    public function destroy(DeleteInternalAttachmentRequest $request, Instruction $instruction)
    {
        $data = $request->validated();

        $internal = $this->internalService->deleteAttachment($data, $instruction->internal);

        return new InternalResource($internal, "Successfully deleted internal attachment");
    }
}
