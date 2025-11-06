<?php

namespace App\Actions\Fortify;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\LoginResponse;

class AuthenticateUser
{
    public function __invoke(array $input)
    {
        $request = new LoginRequest();

        $validator = \Validator::make(
            $input,
            $request->rules(),
            $request->messages()
        );
        $validator->validate();
    }
}
