<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\UnauthorizedException;

class JsonRequest extends FormRequest
{
    protected function validationData()
    {
        return $this->json()->all();
    }

    // public function response(array $errors)
    // {
    //     return response()->api($errors, 422);
    // }

    // public function forbiddenResponse()
    // {
    //     throw new UnauthorizedException('This action is unauthorized.');
    // }
}
