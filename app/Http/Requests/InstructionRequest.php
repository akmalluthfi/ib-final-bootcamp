<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class InstructionRequest extends FormRequest
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
            'type' => [
                'required',
                Rule::in(['LI', 'SI'])
            ],
            'assigned_vendor' => 'required',
            'attention_of' => 'required',
            'quotation_no' => 'nullable|numeric|min:0',
            'vendor_address' => 'required',
            'invoice_to' => 'required',
            'customer' => 'required',
            'customer_po_no' => 'nullable|numeric|min:0',

            'costs' => 'required|array|min:1',
            'costs.*.description' => 'required',
            'costs.*.qty' => 'required|numeric|min:0',
            'costs.*.uom' => [
                'required',
                Rule::in(['SHP', 'BILL', 'HRS', 'MEN', 'PCS', 'TRIP', 'MT'])
            ],
            'costs.*.unit_price' => 'required|numeric|min:0',
            'costs.*.discount' => 'required|numeric|min:0',
            'costs.*.vat' => 'required|numeric|min:0',
            'costs.*.sub_total' => 'required|numeric|min:0',
            'costs.*.total' => 'required|numeric|min:0',
            'costs.*.charge_to' => 'required',

            'attachments' => 'array|nullable',
            'attachments.*' => 'file|mimes:docx,pdf',
            'note' => 'nullable',
            'link_to' => 'nullable'
        ];
    }
}
