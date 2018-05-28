<?php
/**
 * Created by PhpStorm.
 * User: JCamelo
 * Date: 27/05/2018
 * Time: 23:12
 */

namespace app\Repositories;

use App\Sistema;

class SistemaRepositoryEloquent implements SistemaRepositoryInterface
{
    private $model;

    public function __construct(Sistema $model)
    {
        $this->model = $model;
    }


    /**
     * Inclusão de Novo Sistema - Repository
     * @access public
     * @param $data
     * @return Sistema
     */
    public function inserir($data = []){
        return $this->model->create($data);
    }
}