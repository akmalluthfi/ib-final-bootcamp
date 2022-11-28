<?php

namespace App\Repositories;

class InternalRepository
{
    public function create($data, $instruction)
    {
        $dataSaved = [
            'attachments' => [$data['attachment']]
        ];

        $internal = $instruction->internal()->create($dataSaved);

        return $internal;
    }

    public function update($data, $internal)
    {
        $internal->update($data);

        return $internal;
    }
}
