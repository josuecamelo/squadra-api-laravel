<?php
/**
 * Created by PhpStorm.
 * User: JCamelo
 * Date: 27/05/2018
 * Time: 23:15
 */

namespace app\Services;

use app\Repositories\SistemaRepositoryEloquent;

class SistemaService implements BaseService
{

    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * Construtor da Classe Usuario Controller
     * param SistemaRepository $repository
     * @access public
     * @return null
     */
    public function __construct(SistemaRepositoryEloquent $repository){
        $this->repository = $repository;
    }

    /**
     * Recebe os dado enviados via Post - Inclusão de Novo Sistema - Service
     * @access public
     * @param $data
     * @return Sistema
     */
    public function inserir($data = [])
    {
        return $this->repository->inserir($data);
    }
}