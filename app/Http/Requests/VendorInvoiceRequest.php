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
        $rules = [
            'no' => ['string'],
            'attachment' => ['file'],
            'supporting_documents' => ['array'],
            'supporting_documents.*' => ['file', 'mimes:docx,pdf'],
            
        ];

        if($this->routeIs('instructions.vendor-invoices.store')){
            $rules['no'][] = 'required';
            $rules['attachment'][] = 'required';
        }

        if($this->routeIs('instructions.vendor-invoices.update')){
            $rules['deleted_files'] = ['array'];
            $rules['deleted_files.*'] = ['string', 'nullable'];
        }

        return $rules;
    }
}
