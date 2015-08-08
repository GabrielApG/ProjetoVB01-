<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class VoosOrcamentoRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
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
