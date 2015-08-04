<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Lembretes;
use App\Http\Requests\LembretesRequest;


class LembretesController extends Controller {


	public function index()
	{
        $lembretes = Lembretes::all();
		return view('lembretes.index', compact('lembretes'));
	}

	public function create()
	{
		return view('lembretes.create');
	}

    public function store(LembretesRequest $request)
    {
        $input = $request->all();
        Lembretes::create($input);
        return redirect()->route('lembretes');
    }

    public function edit($id)
    {
        $lembretes = Lembretes::find($id);
        return view('lembretes.edit', compact('lembretes'));
    }

    public function update(LembretesRequest $request, $id)
    {
        $lembretes = Lembretes::find($id)->update($request->all());
        return redirect()->route('lembretes');
    }

    public function destroy($id)
    {
        $lembretes = Lembretes::find($id)->delete();
        return redirect()->route('lembretes');
    }

}
