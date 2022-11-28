<?php

namespace App\Services;

use App\Models\Instruction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Repositories\InternalRepository;

class InternalService
{
    private InternalRepository $internalRepository;

    public function __construct(InternalRepository $internalRepository)
    {
        $this->internalRepository = $internalRepository;
    }

    public function addAttachment($data, Instruction $instruction, $internal)
    {
        $attachment = $this->storeFile($data['attachment'], $instruction->id);

        $data['attachments'] = $instruction->internal->attachments;
        array_push($data['attachments'], $attachment);

        $internal = $this->internalRepository->update($data, $internal);

        return $internal;
    }

    public function deleteAttachment($data, $internal)
    {
        // to make sure deleted attachment didn't delete another instruction internal attachment
        if(in_array($data['deleted_attachment'], $internal->attachments)){
            $this->deleteFile($data['deleted_attachment']);
            $data['attachments'] = array_diff($internal->attachments, [$data['deleted_attachment']]);
        }

        $internal = $this->internalRepository->update($data, $internal);

        return $internal;
    }

    public function storeFile(UploadedFile $file, $instructionId)
    {
        $path = $file->store('files/instructions/' . $instructionId . '/internal');

        return $path;
    }

    public function deleteFile($data)
    {
        if($data){
            return Storage::delete($data);
        }

        return false;
    }
}
