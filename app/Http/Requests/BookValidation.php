<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
use FormRequest;

class BookValidation extends Request
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
            'isbn'=>'numeric',
            'title'=>'required',
            'author'=>'required',
            'publisher'=>'required'
        ];
    }
}
