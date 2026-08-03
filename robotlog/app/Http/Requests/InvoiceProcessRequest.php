<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceProcessRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'index_baris' => 'required|integer',
            'Invoice' => 'required|string',
            'Company' => 'required|string',
            'Invoice account' => 'required|string',
            'Name' => 'required|string',
            'Purchase order' => 'required|string',
            'Invoice received date' => 'required|date_format:n/j/Y',
            'Imported invoice amount' => 'required|numeric',
            'Last match status' => 'required|string',
            'Variance approved' => 'nullable|string',
            'Product receipt' => 'required|string',
            '(C) Status' => 'required|string',
            '(C) CA/CSA number' => 'nullable|string',
            '(C) Pool' => 'required|string',
            '(C) Intercompany sales invoice' => 'nullable|string',
            '(C) Tax invoice number' => 'required|string',
            '(C) is total updated' => 'nullable|string',
            '(C) is split invoice' => 'nullable|string',
            '(C) is split invoice return' => 'nullable|string',
            'Created date and time' => 'required|date_format:n/j/Y g:i:s A',
            '(C) Ready to Post Created DateTime' => 'required|date_format:n/j/Y g:i:s A',
        ];
    }
}
