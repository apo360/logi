<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function passwordRules(): array
    {
        $rules = ['required', 'string', new Password, 'confirmed', 'min:8'];

        // Adicionar regra para pelo menos um número e uma letra maiúscula
        $rules[] = 'regex:/^(?=.*[A-Z])(?=.*[0-9])/';

        return $rules;
    }
}
