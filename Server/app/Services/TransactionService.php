<?php
namespace App\Services;

use App;
use App\ContaCorrente;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

Class TransactionService 
{
    protected $ContaCorrenteModel;
    protected $responseTextType = 'text/json';

    public function __construct(ContaCorrente $contaCorrenteModel)
    {
        $this->ContaCorrenteModel = $contaCorrenteModel;
    }
    
    public function listarContas(){
        $contas = $this->ContaCorrenteModel::join('agencia','agencia.id','=','conta_corrente.id_agencia')
        ->join('users', 'users.id' ,'=' ,'conta_corrente.id_cliente')
        ->join('banco','banco.id' ,'=', 'agencia.id_banco')
        ->select(
                'conta_corrente.id',
                'conta_corrente.saldo',
                'agencia.desc_agencia',
                'users.name',
                'banco.nome_banco'
                )
        ->get();

        return response($contas, 200)->header('Content-Type', $this->responseTextType);
    }

    public function mostrarSaldo($idConta){
        $conta = $this->ContaCorrenteModel::findOrFail($idConta);
        return response($conta->saldo, 200)->header('Content-Type', $this->responseTextType); 
    }

    public function depositar($idConta, $valorDeposito){
        $conta = $this->ContaCorrenteModel::findOrFail($idConta);
        $conta->saldo += $valorDeposito;
        $conta->updated_at = Carbon::now();

        if($conta->save()){
            return response('Deposito efetuado com sucesso.', 200)->header('Content-Type', $this->responseTextType);
        }

        return response('Erro ao ao efetuar o deposito, tente novamente mais tarde ou contate o administrador.', 422)
        ->header('Content-Type', $this->responseTextType);   
    }

    public function saque($idConta, $valorSaque){

        $conta = $this->ContaCorrenteModel::findOrFail($idConta);
        
        if($valorSaque > $conta->saldo){
            return response('Você não possui saldo para efetuar essa transação.', 422)
                ->header('Content-Type', $this->responseTextType);  
        }
        $conta->saldo -= $valorSaque;
        $conta->updated_at = Carbon::now();
        
        if($conta->save()){
            return response('Saque efetuado com sucesso.', 200)->header('Content-Type', $this->responseTextType);
        }           
    }
}