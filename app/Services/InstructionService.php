<?php

namespace App\Services;

use App\Models\Instruction;
use App\Repositories\InstructionRepository;
use Illuminate\Support\Facades\Storage;

class InstructionService
{
    private InstructionRepository $instructionRepository;

    public function __construct(InstructionRepository $instructionRepository)
    {
        $this->instructionRepository = $instructionRepository;
    }

    public function storeInstruction($instruction, $attachments)
    {
        $instruction['no'] = $this->generateNo($instruction['type']);

        $instruction = $this->bindInstructionCosts($instruction);

        $instruction =  $this->instructionRepository->storeInstruction($instruction);

        if ($attachments) {
            $attachments = $this->storeAttachments($instruction, $attachments);
            $instruction = $this->instructionRepository->updateInstructionAttachments($instruction, $attachments);
        }

        return $instruction;
    }

    public function bindInstructionCosts($instruction)
    {
        foreach ($instruction['costs'] as $key => $cost) {
            $instruction['costs'][$key]['qty'] = (int) $cost['qty'];
            $instruction['costs'][$key]['discount'] = (int) $cost['discount'];
            $instruction['costs'][$key]['vat'] = (int) $cost['vat'];
            $instruction['costs'][$key]['unit_price'] = round((int)$cost['unit_price'], 2);
            $instruction['costs'][$key]['sub_total'] = (float) $cost['sub_total'];
            $instruction['costs'][$key]['total'] = (float) $cost['total'];
        }

        return $instruction;
    }

    public function storeAttachments(Instruction $instruction, $files)
    {
        $attachments = [];

        foreach ($files as $file) {
            $attachments[] = $file->store('files/instructions/' . $instruction->id);
        }

        return $attachments;
    }

    public function updateAttachments(Instruction $instruction, $deleted_attachments, $attachments)
    {
        // prepare container to save new attachments for instruction
        $attachments_container = [];

        /**
         * check if instruction have attachments
         * if instruction don't have attachments, continue to store new attachments
         *
         */
        if ($instruction->attachments) {
            /**
             * if instruction have attachments
             * check if deleted attachments contain array
             */
            if ($deleted_attachments) {
                /**
                 * if deleted attachments contain array
                 * loop instruction attachments to check which files are same with deleted attachments
                 * 
                 */
                foreach ($instruction->attachments as $attachment) {
                    // state to determine whether the file is still stored in database or not 
                    $keepAttachment = false;
                    foreach ($deleted_attachments as $deleted_attachment) {
                        // check which files are same with deleted attachments
                        if ($deleted_attachment === $attachment) {
                            /**
                             * if same, delete the files
                             * set state to true to prevent file not store in database
                             * break the program to stop loop
                             */
                            Storage::delete($attachment);
                            $keepAttachment = false;
                            break;
                        }
                        $keepAttachment = true;
                    }

                    /**
                     * check if state true
                     * save the keep attachment store in database
                     */
                    if ($keepAttachment) {
                        $attachments_container[] = $attachment;
                    }
                }
            } else {
                /**
                 * if deleted attachments contains empty array
                 * fill the attachments container with old attachments
                 */
                $attachments_container = $instruction->attachments;
            }
        }

        // check if any attachments are uploaded
        if ($attachments) {
            // store attachments
            $newAttachments = $this->storeAttachments($instruction, $attachments);
            $attachments_container = array_merge($attachments_container, $newAttachments);
        }

        return $attachments_container;
    }

    public function updateInstruction(Instruction $instruction, $newInstruction)
    {
        $newInstruction['no'] = $this->generateNoRev($instruction->no);
        $newInstruction = $this->bindInstructionCosts($newInstruction);

        $instruction = $this->instructionRepository->updateInstruction($instruction, $newInstruction);

        return $instruction;
    }

    public function generateNoRev($no)
    {
        $revCount = 1;
        $items = explode("R", $no);
        if (count($items) > 1) {
            $revCount = (int)$items[1] + 1;
            $items[0] = rtrim($items[0]);
        }
        return "{$items[0]} R" . str_pad($revCount, 2, '0', STR_PAD_LEFT);
    }

    public function generateNo($type)
    {
        if ($type === 'LI') {
            $total = $this->instructionRepository->countForLogisticInstruction();
        } else {
            $total = $this->instructionRepository->countForServiceInstruction();
        }

        return "$type-" . date('Y') . '-' . str_pad($total + 1, 4, '0', STR_PAD_LEFT);
    }

    public function terminateInstruction(array $data, Instruction $instruction)
    {
        $data['attachments'] = isset($data['attachments']) ? $data['attachments'] : [];

        $paths = [];

        if ($data['attachments']) {
            foreach ($data['attachments'] as $attachment) {
                $path = Storage::putFile('files/instructions/' . $instruction->id . '/terminate', $attachment);
                $paths[] = $path;
            }
            $data['attachments'] = $paths;
        }

        $vendor = $this->instructionRepository->terminateInstruction($data, $instruction);

        return $vendor;
    }

    public function filterInstruction(array $data)
    {
        $search = $data['search'] ?? null;

        $data['tab'] = $data['tab'] ?? null;
        if ($data['tab'] == "open" || !$data['tab']) {
            $instruction = $this->instructionRepository->getInstructionsOpen($search);
        } else if ($data['tab'] == "completed") {
            $instruction = $this->instructionRepository->getInstructionsCompleted($search);
        }

        return $instruction;
    }

    public function receiveInstruction(Instruction $instruction)
    {
        $instruction = $this->instructionRepository->updateStatusCompleted($instruction);

        return $instruction;
    }
}
