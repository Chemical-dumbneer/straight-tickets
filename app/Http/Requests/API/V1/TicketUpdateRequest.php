<?php

namespace App\Http\Requests\API\V1;

use App\Models\Ticket;
use Illuminate\Foundation\Http\FormRequest;

class TicketUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('update', Ticket::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string','max:255'],
            'description' => ['sometimes', 'string','min:10'],
            'status' => ['sometimes', 'in:Open,Pending,Closed'],
            'tech_id' => ['sometimes', 'exists:users,id'],
        ];
    }
}
