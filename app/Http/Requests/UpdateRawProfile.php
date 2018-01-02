<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRawProfile extends FormRequest
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
            'name' => 'required',
        ];
    }

//    protected function getValidatorInstance()
//    {
//        $params = $this->all();
//        $params['specialization'] = 'sdfsdf';
//        $this->getInputSource()->replace($params);
//        return parent::getValidatorInstance();
//    }
}
