<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class User extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    public function all($keys = null)
    {
        return $this->validateFields(parent::all());
    }

    public function validateFields(array $inputs)
    {
        $inputs['cpf'] = str_replace(['.', '-'], '', $this->request->all()['cpf']);
        return $inputs;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'Type' => 'required|array',
            'name' => 'required|min:3|max:191',
            'nasc' => 'required|date_format:d/m/Y',
            'genero' => 'required|in:masculino,feminino',
            'estado_civil' => 'required|in:casado,separado,solteiro,divorciado,viuvo',
            'cpf' => (!empty($this->request->all()['id']) ? 'required|min:11|max:14|unique:users,cpf,' . $this->request->all()['id'] : 'required|min:11|max:14|unique:users,cpf'),
                        
            // Access
            'email' => (!empty($this->request->all()['id']) ? 'required|email|unique:users,email,' . $this->request->all()['id'] : 'required|email|unique:users,email'),
            'password' => (empty($this->request->all()['id']) ? 'required' : ''),
            
            // Contact
            'celular' => 'required',                        
           
        ];
    }
}
