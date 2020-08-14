<?php

namespace App\Http\Controllers;

use App;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransacaoController extends Controller
{
    
    protected $conta;

    public function __construct(TransactionService $transacao)
    {
        $this->conta = $transacao;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->conta->listarContas();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->conta->depositar($request->idConta, $request->valorDeposito);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContaCorrente  $contaCorrente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->conta->mostrarSaldo($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContaCorrente  $contaCorrente
     * @return \Illuminate\Http\Response
     */
    public function edit(ContaCorrente $contaCorrente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id ,Request $request)
    {
        return $this->conta->saque($id, $request->valorSaque);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContaCorrente  $contaCorrente
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContaCorrente $contaCorrente)
    {
        //
    }
}
