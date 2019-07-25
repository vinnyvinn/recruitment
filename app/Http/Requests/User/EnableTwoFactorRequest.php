<?php

namespace Boaz\Http\Requests\User;

use Boaz\Http\Requests\Request;
use Boaz\User;

class EnableTwoFactorRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country_code' => 'required|numeric|integer',
            'phone_number' => 'required|numeric',
        ];
    }
}
