<?php namespace App\Http\Requests;

use App\Http\Requests\Request;


class PacotesRequest extends Request {


	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
            'nome' => 'required',
            'categorias_id' => 'required',
		];
	}

}
