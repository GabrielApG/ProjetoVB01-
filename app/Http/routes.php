<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Rota acessivel somente pela Administração*/
Route::group(['prefix'=>'admin', 'middleware'=>'auth','where'=>['id'=>'[0-9]+']], function() {

    Route::group(['prefix'=>'clientes', 'where'=>['id'=>'[0-9]+']], function() { // os parametros [0-9] valida o ID
        Route::get('',['as'=>'clientes', 'uses'=>'ClientesController@index']);
        Route::get('create',['as'=>'clientes.create', 'uses'=>'ClientesController@create']);
        Route::post('store',['as'=>'clientes.store', 'uses'=>'ClientesController@store']);
        Route::get('{id}/destroy',['as'=>'clientes.destroy', 'uses'=>'ClientesController@destroy']);
        Route::get('{id}/edit',['as'=>'clientes.edit', 'uses'=>'ClientesController@edit']);
        Route::put('{id}/update',['as'=>'clientes.update', 'uses'=>'ClientesController@update']);
        Route::get('{nome}/pesquisar',['as'=>'clientes.pesquisar', 'uses'=>'ClientesController@pesquisar']);

        Route::get('pedidosOrcamento',['as'=>'clientes.pedidosOrcamento', 'uses'=>'ClientesController@pedidosOrcamento']);
        Route::get('compraConfirmada',['as'=>'clientes.compraConfirmada', 'uses'=>'ClientesController@compraConfirmada']);
        Route::get('emViajem',['as'=>'clientes.emViajem', 'uses'=>'ClientesController@emViajem']);

        Route::get('{id}/detalhes',['as'=>'clientes.detalhes', 'uses'=>'ClientesController@detalhes']);
        Route::get('{id}/detalhesClientes',['as'=>'clientes.detalhesClientes', 'uses'=>'ClientesController@detalhesClientes']);
        Route::get('{id}/situacaoCliente',['as'=>'clientes.situacaoCliente', 'uses'=>'ClientesController@editSituacao']);
        Route::put('{id}/update',['as'=>'clientes.updateSituacao', 'uses'=>'ClientesController@updateSituacao']);
        Route::get('{id}/categoriaCliente',['as'=>'clientes.categoriaCliente', 'uses'=>'ClientesController@editCategoria']);
        Route::put('{id}/update',['as'=>'clientes.updateCategoria', 'uses'=>'ClientesController@updateCategoria']);
        Route::get('{id}/pacoteCliente',['as'=>'clientes.pacoteCliente', 'uses'=>'ClientesController@editPacote']);
        Route::put('{id}/update',['as'=>'clientes.updatePacote', 'uses'=>'ClientesController@updatePacote']);
        Route::put('{id}/update',['as'=>'clientes.updateLembrete', 'uses'=>'ClientesController@updateLembrete']);

        Route::get('{id}/orcamento',['as'=>'clientes.orcamento', 'uses'=>'ClientesController@orcamento']);

        /*Rotas de Orçamentos*/
        Route::group(['prefix'=>'orcamentos', 'where'=>['id'=>'[0-9]+']], function() { // os parametros [0-9] valida o ID
            Route::get('',['as'=>'orcamentos', 'uses'=>'OrcamentosController@index']);
            /* Route::get('create',['as'=>'produtos.create', 'uses'=>'OrcamentosController@create']);
             Route::post('store',['as'=>'produtos.store', 'uses'=>'OrcamentosController@store']);
             Route::get('{id}/destroy',['as'=>'produtos.destroy', 'uses'=>'OrcamentosController@destroy']);
             Route::get('{id}/edit',['as'=>'produtos.edit', 'uses'=>'OrcamentosController@edit']);
             Route::put('{id}/update',['as'=>'produtos.update', 'uses'=>'OrcamentosController@update']);*/
        });
    });

    Route::group(['prefix'=>'observacao', 'where'=>['id'=>'[0-9]+']], function() {
        Route::get('', ['as' => 'observacao', 'uses' => 'ObservacoesController@index']);
        Route::get('create',['as'=>'observacao.create', 'uses'=>'ObservacoesController@create']);
        Route::post('store', ['as' => 'observacao.store', 'uses' => 'ObservacoesController@store']);
        Route::get('{id}/destroy', ['as' => 'observacao.destroy', 'uses' => 'ObservacoesController@destroy']);
        Route::get('{id}/edit', ['as' => 'observacao.edit', 'uses' => 'ObservacoesController@edit']);
        Route::put('{id}/update', ['as' => 'observacao.update', 'uses' => 'ObservacoesController@update']);
        Route::get('{id}/detalhes', ['as' => 'observacao.detalhes', 'uses' => 'ObservacoesController@detalhes']);

    });

    Route::group(['prefix'=>'situacao', 'where'=>['id'=>'[0-9]+']], function() { // os parametros [0-9] valida o ID
        Route::get('',['as'=>'situacao', 'uses'=>'SituacaoController@index']);
        Route::get('create',['as'=>'situacao.create', 'uses'=>'SituacaoController@create']);
        Route::post('store',['as'=>'situacao.store', 'uses'=>'SituacaoController@store']);
        Route::get('{id}/destroy',['as'=>'situacao.destroy', 'uses'=>'SituacaoController@destroy']);
        Route::get('{id}/edit',['as'=>'situacao.edit', 'uses'=>'SituacaoController@edit']);
        Route::put('{id}/update',['as'=>'situacao.update', 'uses'=>'SituacaoController@update']);
    });

    Route::group(['prefix'=>'categorias', 'where'=>['id'=>'[0-9]+']], function() { // os parametros [0-9] valida o ID
        Route::get('',['as'=>'categorias', 'uses'=>'CategoriasController@index']);
        Route::get('create',['as'=>'categoria.create', 'uses'=>'CategoriasController@create']);
        Route::post('store',['as'=>'categoria.store', 'uses'=>'CategoriasController@store']);
        Route::get('{id}/destroy',['as'=>'categoria.destroy', 'uses'=>'CategoriasController@destroy']);
        Route::get('{id}/edit',['as'=>'categoria.edit', 'uses'=>'CategoriasController@edit']);
        Route::put('{id}/update',['as'=>'categoria.update', 'uses'=>'CategoriasController@update']);
    });

    Route::group(['prefix'=>'pacotes', 'where'=>['id'=>'[0-9]+']], function() { // os parametros [0-9] valida o ID
        Route::get('',['as'=>'pacotes', 'uses'=>'PacotesController@index']);
        Route::get('create',['as'=>'pacotes.create', 'uses'=>'PacotesController@create']);
        Route::post('store',['as'=>'pacotes.store', 'uses'=>'PacotesController@store']);
        Route::get('{id}/destroy',['as'=>'pacotes.destroy', 'uses'=>'PacotesController@destroy']);
        Route::get('{id}/edit',['as'=>'pacotes.edit', 'uses'=>'PacotesController@edit']);
        Route::put('{id}/update',['as'=>'pacotes.update', 'uses'=>'PacotesController@update']);
        Route::get('{id}/listaClientes',['as'=>'pacotes.listaClientes', 'uses'=>'PacotesController@listaClientes']);
    });

    Route::group(['prefix'=>'dependentes', 'where'=>['id'=>'[0-9]+']], function() {
        Route::get('',['as'=>'dependentes', 'uses'=>'DependentesController@index']);
        Route::post('store',['as'=>'dependentes.store', 'uses'=>'DependentesController@store']);
        Route::get('{id}/destroy',['as'=>'dependentes.destroy', 'uses'=>'DependentesController@destroy']);
        Route::get('{id}/edit',['as'=>'dependentes.edit', 'uses'=>'DependentesController@edit']);
        Route::put('{id}/update',['as'=>'dependentes.update', 'uses'=>'DependentesController@update']);
        Route::get('{id}/detalhes',['as'=>'dependentes.detalhes', 'uses'=>'DependentesController@detalhes']);
        Route::get('{id}/createDependentesCliente',['as'=>'dependentes.createDependentesCliente', 'uses'=>'DependentesController@createDependentesCliente']);
        /*
        Route::post('storeAttach',['as'=>'dependentes.storeAttach', 'uses'=>'DependentesController@storeAttach']);
        Route::get('{id}/storeDetach',['as'=>'dependentes.storeDetach', 'uses'=>'DependentesController@storeDetach']);

        Route::post('storeAttachOrcamento',['as'=>'dependentes.storeAttachOrcamento', 'uses'=>'dependentesController@storeAttachOrcamento']);
        Route::get('{id}/storeDetachOrcamento',['as'=>'dependentes.storeDetachOrcamento', 'uses'=>'dependentesController@storeDetachOrcamento']);
        */
    });

    Route::group(['prefix'=>'hoteis', 'where'=>['id'=>'[0-9]+']], function() {
        Route::get('',['as'=>'hoteis', 'uses'=>'HoteisController@index']);
        Route::get('create',['as'=>'hoteis.create', 'uses'=>'HoteisController@create']);
        Route::post('store',['as'=>'hoteis.store', 'uses'=>'HoteisController@store']);
        Route::get('{id}/destroy',['as'=>'hoteis.destroy', 'uses'=>'HoteisController@destroy']);
        Route::get('{id}/edit',['as'=>'hoteis.edit', 'uses'=>'HoteisController@edit']);
        Route::put('{id}/update',['as'=>'hoteis.update', 'uses'=>'HoteisController@update']);
        Route::put('{id}/updateHotel',['as'=>'hoteis.updateHotel', 'uses'=>'HoteisController@updateHotel']);
        Route::get('{id}/detalhes',['as'=>'hoteis.detalhes', 'uses'=>'HoteisController@detalhes']);
        Route::get('{id}/createHotelCliente',['as'=>'hoteis.createHotelCliente', 'uses'=>'HoteisController@createHotelCliente']);
        Route::get('{id}/{idCliente}/editHotelCliente/', ['as' => 'hoteis.editHotelCliente', 'uses' => 'HoteisController@editHotelCliente']);
        Route::get('{id}/{idCliente}/editHotelOrcamento/', ['as' => 'hoteis.editHotelOrcamento', 'uses' => 'HoteisController@editHotelOrcamento']);
        Route::put('{id}/update',['as'=>'hoteis.updateOrcamento', 'uses'=>'HoteisController@updateOrcamento']);

        Route::post('storeAttach',['as'=>'hoteis.storeAttach', 'uses'=>'HoteisController@storeAttach']);
        Route::get('{id}/storeDetach',['as'=>'hoteis.storeDetach', 'uses'=>'HoteisController@storeDetach']);

        Route::post('storeAttachOrcamento',['as'=>'hoteis.storeAttachOrcamento', 'uses'=>'HoteisController@storeAttachOrcamento']);
        Route::get('{id}/storeDetachOrcamento',['as'=>'hoteis.storeDetachOrcamento', 'uses'=>'HoteisController@storeDetachOrcamento']);

    });

    Route::group(['prefix'=>'passeios', 'where'=>['id'=>'[0-9]+']], function() {
        Route::get('',['as'=>'passeios', 'uses'=>'PasseiosController@index']);
        Route::get('create',['as'=>'passeios.create', 'uses'=>'PasseiosController@create']);
        Route::post('store',['as'=>'passeios.store', 'uses'=>'PasseiosController@store']);
        Route::get('{id}/destroy',['as'=>'passeios.destroy', 'uses'=>'PasseiosController@destroy']);
        Route::get('{id}/edit',['as'=>'passeios.edit', 'uses'=>'PasseiosController@edit']);
        Route::put('{id}/update',['as'=>'passeios.update', 'uses'=>'PasseiosController@update']);
        Route::put('{id}/updatePasseios',['as'=>'passeios.updatePasseios', 'uses'=>'PasseiosController@updatePasseios']);
        Route::get('{id}/detalhes',['as'=>'passeios.detalhes', 'uses'=>'PasseiosController@detalhes']);
        Route::get('{id}/createPasseioCliente',['as'=>'passeios.createPasseioCliente', 'uses'=>'PasseiosController@createPasseioCliente']);
        Route::get('{id}/{idCliente}/editPasseiosCliente/', ['as' => 'passeios.editPasseiosCliente', 'uses' => 'PasseiosController@editPasseiosCliente']);
        Route::get('{id}/{idCliente}/editPasseiosOrcamento/', ['as' => 'passeios.editPasseiosOrcamento', 'uses' => 'PasseiosController@editPasseioOrcamento']);
        Route::put('{id}/update',['as'=>'passeios.updateOrcamento', 'uses'=>'PasseiosController@updateOrcamento']);

        Route::post('storeAttach',['as'=>'passeios.storeAttach', 'uses'=>'PasseiosController@storeAttach']);
        Route::get('{id}/storeDetach',['as'=>'passeios.storeDetach', 'uses'=>'PasseiosController@storeDetach']);

        Route::post('storeAttachOrcamento',['as'=>'passeios.storeAttachOrcamento', 'uses'=>'PasseiosController@storeAttachOrcamento']);
        Route::get('{id}/storeDetachOrcamento',['as'=>'passeios.storeDetachOrcamento', 'uses'=>'PasseiosController@storeDetachOrcamento']);
    });

    Route::group(['prefix'=>'transfers', 'where'=>['id'=>'[0-9]+']], function() {
        Route::get('', ['as' => 'transfers', 'uses' => 'TransferController@index']);
        Route::get('create', ['as' => 'transfers.create', 'uses' => 'TransferController@create']);
        Route::post('store', ['as' => 'transfers.store', 'uses' => 'TransferController@store']);
        Route::get('{id}/destroy', ['as' => 'transfers.destroy', 'uses' => 'TransferController@destroy']);
        Route::get('{id}/edit', ['as' => 'transfers.edit', 'uses' => 'TransferController@edit']);
        Route::put('{id}/update', ['as' => 'transfers.update', 'uses' => 'TransferController@update']);
        Route::put('{id}/updateTransfer', ['as' => 'transfers.updateTransfer', 'uses' => 'TransferController@updateTransfer']);
        Route::get('{id}/detalhes', ['as' => 'transfers.detalhes', 'uses' => 'TransferController@detalhes']);
        Route::get('{id}/createTransferCliente', ['as' => 'transfers.createTransferCliente', 'uses' => 'TransferController@createTransferCliente']);
        Route::get('{id}/{idCliente}/editTransferCliente/', ['as' => 'transfers.editTransferCliente', 'uses' => 'TransferController@editTransferCliente']);
        Route::get('{id}/{idCliente}/editTransferOrcamento/', ['as' => 'transfers.editTransferOrcamento', 'uses' => 'TransferController@editTransferOrcamento']);
        Route::put('{id}/updateOrcamento', ['as' => 'transfers.updateOrcamento', 'uses' => 'TransferController@updateOrcamento']);

        Route::post('storeAttach', ['as' => 'transfers.storeAttach', 'uses' => 'TransferController@storeAttach']);
        Route::get('{id}/storeDetach', ['as' => 'transfers.storeDetach', 'uses' => 'TransferController@storeDetach']);

        Route::post('storeAttachOrcamento', ['as' => 'transfers.storeAttachOrcamento', 'uses' => 'TransferController@storeAttachOrcamento']);
        Route::get('{id}/storeDetachOrcamento', ['as' => 'transfers.storeDetachOrcamento', 'uses' => 'TransferController@storeDetachOrcamento']);
    });

    Route::group(['prefix'=>'extras', 'where'=>['id'=>'[0-9]+']], function() {
        Route::get('', ['as' => 'extras', 'uses' => 'ExtrasController@index']);
        Route::get('create', ['as' => 'extras.create', 'uses' => 'ExtrasController@create']);
        Route::post('store', ['as' => 'extras.store', 'uses' => 'ExtrasController@store']);
        Route::get('{id}/destroy', ['as' => 'extras.destroy', 'uses' => 'ExtrasController@destroy']);
        Route::get('{id}/edit', ['as' => 'extras.edit', 'uses' => 'ExtrasController@edit']);
        Route::put('{id}/update', ['as' => 'extras.update', 'uses' => 'ExtrasController@update']);
        Route::put('{id}/updateExtra', ['as' => 'extras.updateExtra', 'uses' => 'ExtrasController@updateExtra']);
        Route::get('{id}/detalhes', ['as' => 'extras.detalhes', 'uses' => 'ExtrasController@detalhes']);
        Route::get('{id}/createExtrasCliente', ['as' => 'extras.createExtrasCliente', 'uses' => 'ExtrasController@createExtrasCliente']);
        Route::get('{id}/{idCliente}/editExtraCliente/', ['as' => 'extras.editExtraCliente', 'uses' => 'ExtrasController@editExtraCliente']);
        Route::get('{id}/{idCliente}/editExtraOrcamento/', ['as' => 'extras.editExtraOrcamento', 'uses' => 'ExtrasController@editExtraOrcamento']);
        Route::put('{id}/updateOrcamento', ['as' => 'extras.updateOrcamento', 'uses' => 'ExtrasController@updateOrcamento']);

        Route::post('storeAttach', ['as' => 'extras.storeAttach', 'uses' => 'ExtrasController@storeAttach']);
        Route::get('{id}/storeDetach', ['as' => 'extras.storeDetach', 'uses' => 'ExtrasController@storeDetach']);

        Route::post('storeAttachOrcamento', ['as' => 'extras.storeAttachOrcamento', 'uses' => 'ExtrasController@storeAttachOrcamento']);
        Route::get('{id}/storeDetachOrcamento', ['as' => 'extras.storeDetachOrcamento', 'uses' => 'ExtrasController@storeDetachOrcamento']);
    });

    Route::group(['prefix'=>'voos', 'where'=>['id'=>'[0-9]+']], function() {
        Route::get('', ['as' => 'voos', 'uses' => 'VoosController@index']);
        Route::get('create', ['as' => 'voos.create', 'uses' => 'VoosController@create']);
        Route::post('store', ['as' => 'voos.store', 'uses' => 'VoosController@store']);
        Route::get('{id}/destroy', ['as' => 'voos.destroy', 'uses' => 'VoosController@destroy']);
        Route::get('{id}/edit', ['as' => 'voos.edit', 'uses' => 'VoosController@edit']);
        Route::put('{id}/update', ['as' => 'voos.update', 'uses' => 'VoosController@update']);
        Route::put('{id}/updateVoo', ['as' => 'voos.updateVoo', 'uses' => 'VoosController@updateVoo']);
        Route::get('{id}/detalhes', ['as' => 'voos.detalhes', 'uses' => 'VoosController@detalhes']);
        Route::get('{id}/createVooCliente', ['as' => 'voos.createVooCliente', 'uses' => 'VoosController@createVooCliente']);
        Route::get('{id}/{idCliente}/editVooCliente/', ['as' => 'voos.editVooCliente', 'uses' => 'VoosController@editVooCliente']);
        Route::get('{id}/{idCliente}/editVooOrcamento/', ['as' => 'voos.editVooOrcamento', 'uses' => 'VoosController@editVooOrcamento']);
        Route::put('{id}/updateOrcamento', ['as' => 'voos.updateOrcamento', 'uses' => 'VoosController@updateOrcamento']);

        Route::post('storeAttach', ['as' => 'voos.storeAttach', 'uses' => 'VoosController@storeAttach']);
        Route::get('{id}/storeDetach', ['as' => 'voos.storeDetach', 'uses' => 'VoosController@storeDetach']);

        Route::post('storeAttachOrcamento', ['as' => 'voos.storeAttachOrcamento', 'uses' => 'VoosController@storeAttachOrcamento']);
        Route::get('{id}/storeDetachOrcamento', ['as' => 'voos.storeDetachOrcamento', 'uses' => 'VoosController@storeDetachOrcamento']);
    });

    Route::group(['prefix'=>'trens', 'where'=>['id'=>'[0-9]+']], function() {
        Route::get('',['as'=>'trens', 'uses'=>'TrensController@index']);
        Route::get('create',['as'=>'trens.create', 'uses'=>'TrensController@create']);
        Route::post('store',['as'=>'trens.store', 'uses'=>'TrensController@store']);
        Route::get('{id}/destroy',['as'=>'trens.destroy', 'uses'=>'TrensController@destroy']);
        Route::get('{id}/edit',['as'=>'trens.edit', 'uses'=>'TrensController@edit']);
        Route::put('{id}/update',['as'=>'trens.update', 'uses'=>'TrensController@update']);
        Route::put('{id}/updateTrem',['as'=>'trens.updateTrem', 'uses'=>'TrensController@updateTrem']);
        Route::get('{id}/detalhes',['as'=>'trens.detalhes', 'uses'=>'TrensController@detalhes']);
        Route::get('{id}/createTremCliente',['as'=>'trens.createTremCliente', 'uses'=>'TrensController@createTremCliente']);
        Route::get('{id}/{idCliente}/editTremCliente/', ['as' => 'trens.editTremCliente', 'uses' => 'TrensController@editTremCliente']);
        Route::get('{id}/{idCliente}/editTremOrcamento/', ['as' => 'trens.editTremOrcamento', 'uses' => 'TrensController@editTremOrcamento']);
        Route::put('{id}/updateOrcamento', ['as' => 'trens.updateOrcamento', 'uses' => 'TrensController@updateOrcamento']);

        Route::post('storeAttach',['as'=>'trens.storeAttach', 'uses'=>'TrensController@storeAttach']);
        Route::get('{id}/storeDetach',['as'=>'trens.storeDetach', 'uses'=>'TrensController@storeDetach']);

        Route::post('storeAttachOrcamento',['as'=>'trens.storeAttachOrcamento', 'uses'=>'TrensController@storeAttachOrcamento']);
        Route::get('{id}/storeDetachOrcamento',['as'=>'trens.storeDetachOrcamento', 'uses'=>'TrensController@storeDetachOrcamento']);

    });
    // Em desenvolvimento
    Route::group(['prefix'=>'manutencoes','where'=>['id'=>'[0-9]+']], function() {
        Route::get('',['as'=>'manutencoes', 'uses'=>'AdminController@index']);
    });

    Route::group(['prefix'=>'lembretes','where'=>['id'=>'[0-9]+']], function() {
        Route::get('',['as'=>'lembretes', 'uses'=>'LembretesController@index']);
        Route::get('create',['as'=>'lembretes.create', 'uses'=>'LembretesController@create']);
        Route::post('store',['as'=>'lembretes.store', 'uses'=>'LembretesController@store']);
        Route::get('{id}/destroy',['as'=>'lembretes.destroy', 'uses'=>'LembretesController@destroy']);
        Route::get('{id}/edit',['as'=>'lembretes.edit', 'uses'=>'LembretesController@edit']);
        Route::put('{id}/update',['as'=>'lembretes.update', 'uses'=>'LembretesController@update']);
    });

    Route::group(['prefix'=>'roteiros', 'where'=>['id'=>'[0-9]+']], function() {
        Route::get('', ['as' => 'roteiros', 'uses' => 'RoteirosController@index']);
          Route::get('create', ['as' => 'roteiros.create', 'uses' => 'RoteirosController@create']);
          Route::post('store',['as'=>'roteiros.store', 'uses'=>'RoteirosController@store']);
        Route::get('{id}/destroy',['as'=>'roteiros.destroy', 'uses'=>'RoteirosController@destroy']);
        Route::get('{id}/edit',['as'=>'roteiros.edit', 'uses'=>'RoteirosController@edit']);
        Route::put('{id}/update',['as'=>'roteiros.update', 'uses'=>'RoteirosController@update']);
        Route::put('{id}/updateRoteiro',['as'=>'roteiros.updateRoteiro', 'uses'=>'RoteirosController@updateRoteiro']);

        Route::get('{id}/detalhes',['as'=>'roteiros.detalhes', 'uses'=>'RoteirosController@detalhes']);
        Route::get('{id}/createRoteiroCliente',['as'=>'roteiros.createRoteirosCliente', 'uses'=>'RoteirosController@createRoteiroCliente']);

        Route::post('storeAttach',['as'=>'roteiros.storeAttach', 'uses'=>'RoteirosController@storeAttach']);
        Route::get('{id}/storeDetach',['as'=>'roteiros.storeDetach', 'uses'=>'RoteirosController@storeDetach']);

        Route::post('storeAttachOrcamento',['as'=>'roteiros.storeAttachOrcamento', 'uses'=>'RoteirosController@storeAttachOrcamento']);
        Route::get('{id}/storeDetachOrcamento',['as'=>'roteiros.storeDetachOrcamento', 'uses'=>'RoteirosController@storeDetachOrcamento']);
    });

    Route::group(['prefix'=>'relatorios', 'where'=>['id'=>'[0-9]+']], function() {
        Route::get('{id}/relatorios', ['as' => 'relatorios', 'uses' => 'RelatoriosController@relatorios']);
        Route::get('{id}/compra', ['as' => 'compra', 'uses' => 'RelatoriosController@compra']);
        Route::get('{id}/orcamento', ['as' => 'orcamento', 'uses' => 'RelatoriosController@orcamento']);
        Route::get('{id}/checklist', ['as' => 'checklist', 'uses' => 'RelatoriosController@checklist']);
        Route::get('{id}/pdfCompra', ['as' => 'pdfCompra', 'uses' => 'RelatoriosController@pdfCompra']);
        Route::get('{id}/pdfOrcamento', ['as' => 'pdfOrcamento', 'uses' => 'RelatoriosController@pdfOrcamento']);

        Route::get('{id}/roteiro', ['as' => 'roteiro', 'uses' => 'RelatoriosController@roteiro']);
    });


    Route::get('populaCidades','PopulaCidadesController@popula');

});// Fim grupo de Rotas ADMIN


/*Rotas para AJAX*/
Route::get('get-trensOrcamento', 'TrensController@getTrensOrcamento');
Route::get('get-valor/{idTrem}', 'TrensController@getValor');

Route::get('get-voosOrcamento', 'VoosController@getVoosOrcamento');
Route::get('get-voo/{idVoo}', 'VoosController@getVoos');

Route::get('get-transferOrcamento', 'TransferController@getTransferOrcamento');
Route::get('get-transf/{idTransfer}', 'TransferController@getTransf');

Route::get('get-passeioOrcamento', 'PasseiosController@getPasseioOrcamento');
Route::get('get-pass/{idPasseio}', 'PasseiosController@getPass');

Route::get('get-hotelOrcamento', 'HoteisController@getHoteisOrcamento');
Route::get('get-hot/{idHotel}', 'HoteisController@getHot');

Route::get('home-cidade', ['as' => 'home', 'uses' => 'CidadesController@index'] );
Route::get('get-cidades/{idEstado}', 'CidadesController@getCidades');

Route::get('get-extraOrcamento', 'ExtrasController@getExtraOrcamento');
Route::get('get-extra/{idExtra}', 'ExtrasController@getExtra');

Route::get('get-pacotes/{idCategoria}', 'PacotesController@getPacotes');

Route::get('get-roteiroOrcamento', 'RoteirosController@getRoteiroOrcamento');
Route::get('get-roteiro/{idRoteiro}', 'RoteirosController@getRoteiro');

Route::get('/', 'AdminController@index');

Route::get('home', 'HomeController@index');


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);





/* Exemplos  - Rotas simples*//*
Route::get('produtos','ProdutosController@index');
Route::get('produtos/create','ProdutosController@create');
Route::post('produtos/store','ProdutosController@store'); // Utilizando o metodo POST
Route::get('produtos/{id}/destroy','ProdutosController@destroy'); // Para Deletar Produto
Route::get('produtos/{id}/edit','ProdutosController@edit');
Route::put('produtos/{id}/update','ProdutosController@update');*/





