<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class VendorInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'no' => [Rule::requiredIf($this->routeIs('vendor-invoices.index')) , 'string'],
            'attachment' => [Rule::requiredIf($this->routeIs('vendor-invoices.index')) ,'file'],
            'supporting_documents' => ['array'],
            'supporting_documents.*' => ['file']
        ];
    }
}
