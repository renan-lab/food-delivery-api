<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Restaurant;

use App\Models\Restaurant;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Email;
use Illuminate\Validation\Rules\Password;
use LaravelLegends\PtBrValidator\Rules\Cnpj;

class StoreRestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'trade_name' => ['required', 'string', 'max:150'],
            'company_name' => ['required', 'string', 'max:150'],
            'cnpj' => ['required', 'string', 'size:14', new Cnpj, Rule::unique(Restaurant::class, 'cnpj')],
            'email' => ['required', Email::default(), 'indisposable:mx', 'max:255', Rule::unique(Restaurant::class, 'email')],
            'password' => ['required', Password::defaults()],
            'phone' => ['required', 'string', 'max:20'],
            'postal_code' => ['required', 'string', 'size:8'],
            'street' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:20'],
            'complement' => ['nullable', 'string', 'max:150'],
            'district' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'size:2'],
        ];
    }
}
