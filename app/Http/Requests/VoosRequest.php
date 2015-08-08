<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class VoosRequest extends Request {

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
        return [
            'nome_voo' => 'required',
            'cidades_id' => 'required',
        ];
	}

}
