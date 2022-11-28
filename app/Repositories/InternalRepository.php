<?php

namespace App\Repositories;

class InternalRepository
{
    public function update($data, $internal)
    {
        $internal->update($data);

        return $internal;
    }
}
