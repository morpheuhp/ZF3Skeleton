<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pessoa\Model;

use Zend\Db\TableGateway\TableGatewayInterface;
use RuntimeException;

/**
 * Description of PessoaTable
 *
 * @author fernando
 */
class PessoaTable {

    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function getAll() {
        return $this->tableGateway->select();
    }

    public function getPessoa($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (!$row) {
            throw new RuntimeException(sprintf('Id não encontrado - id %d', $id));
        }
        return $row;
    }

    public function salvarPessoa(\Pessoa $pessoa) {
        /*
         * private $id;
          private $nome;
          private $sobrenome;
          private $email;
          private $situacao;
         */

        $data = [
            'nome' => $pessoa->getNome(),
            'sobrenome' => $pessoa->setSobrenome(),
            'email' => $pessoa->setEmail(),
            'situacao' => $pessoa->setSituacao(),
        ];

        $id = (int) $pessoa->getId();
        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }
        $this->tableGateway->update($data,['id'=>$id]);
    }
    
    public function deletarPessoa($id){
        $this->tableGateway->delete(['id'=>(int)$id]);
    }

}
