<?php

namespace Catering\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest implements ValidationInterface
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
        if ($this->method() == 'POST') {
            return $this->validateOnSave();
        } else {
            return $this->validateOnUpdate();
        }
    }

    public function validateOnSave()
    {
       return [
            'name' => 'required|string',
            'route_name' => 'required|string',
            'parent_id' => 'exists:menus,id',
            'order' => 'required|integer',
            'enabled' => 'required|boolean'
       ];
    }

    public function validateOnUpdate()
    {
        return $this->validateOnSave();
    }
}
