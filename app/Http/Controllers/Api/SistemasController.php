<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use app\Services\SistemaService;
use Illuminate\Http\Request;
use Validator;

class SistemasController extends Controller
{

    protected $sistemaService;


    public function __construct(SistemaService $sistemaService){
        $this->sistemaService = $sistemaService;
    }

    /**
     * Inclusão de Novo Sistema
     * @access public
     * @param
     * @return Sistemas
     */
    public function incluir(){
        $dados = request()->all();

        $this->sistemaService->inserir($dados);
    }
}