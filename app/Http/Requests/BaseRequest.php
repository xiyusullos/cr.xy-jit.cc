<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function validate()
    {
        $this->prepareForValidation();

        $instance = $this->getValidatorInstance();

        // let validation first
        if (! $instance->passes()) {
            $this->failedValidation($instance);
        }

        if (! $this->passesAuthorization()) {
            $this->failedAuthorization();
        }
    }
}
