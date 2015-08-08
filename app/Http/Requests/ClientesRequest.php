<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ClientesRequest extends Request {


	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
            'nome' => 'required|alpha',
            'telefone' => 'required',
            'email' => 'required|email',
            'categorias_id' => 'required',
            'pacotes_id' => 'required',
            'situacoes_id' => 'required',

		];
	}


}
