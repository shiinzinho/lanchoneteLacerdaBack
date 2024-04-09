<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome'=>'required|max:200|min:10',
            'preco'=>'required|decimal:10,2',
            'ingredientes'=>'required|max:500|min:10',
            'imagem'=>'required'
        ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'status' => false,
            'error' => $validator->errors()
        ]));
    }
    public function messages(){
        return [
            'nome.required' => 'Nome obrigatório',
            'nome.max' => 'Nome deve conter no máximo 200 caracteres',
            'nome.min' => 'Nome deve conter no mínimo 10 caracteres',
            'preco.required' => 'Preço obrigatório',
            'preco.max' => 'Preço deve conter no máximo 10 caracteres',
            'preco.decimal' => 'Preço deve ser escrito em decimal',
            'ingredientes.required' => 'Ingredientes obrigatório',
            'ingredientes.max' => 'ingredientes deve conter no máximo 500 caracteres',
            'ingredientes.min' => 'Ingredientes deve conter no mínimo 10 caracteres',
            'imagem.required' => 'Foto obrigatória',
        ];
    }
}
