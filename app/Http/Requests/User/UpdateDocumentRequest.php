<?php

namespace Boaz\Http\Requests\User;
use Illuminate\Validation\Rule;
use Boaz\Http\Requests\Request;
use Boaz\Support\Enum\UserStatus;
use Boaz\User;

class UpdateDocumentRequest extends Request
{
    /**
     * Get authenticated user.
     *
     * @return mixed
     */
    
    public function rules()
    {
       

        return [
            'resume' => 'required|file|max:1024',
            'coverletter' => 'required',
            'certs' => 'required'
        ];
    }
}
