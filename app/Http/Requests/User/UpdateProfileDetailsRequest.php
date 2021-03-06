<?php

namespace Boaz\Http\Requests\User;

use Boaz\Http\Requests\Request;
use Boaz\User;

class UpdateProfileDetailsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'birthday' => 'nullable|date',
        ];
    }
}
