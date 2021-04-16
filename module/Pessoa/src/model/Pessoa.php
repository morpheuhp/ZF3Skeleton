<?php

namespace Pessoa\Model;

class Pessoa implements \Zend\Stdlib\ArraySerializableInterface {

    private $id;
    private $nome;
    private $sobrenome;
    private $email;
    private $situacao;

    public function exchangeArray(array $data) {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->nome = !empty($data['nome']) ? $data['nome'] : null;
        $this->sobrenome = !empty($data['sobrenome']) ? $data['sobrenome'] : null;
        $this->email = !empty($data['email']) ? $data['email'] : null;
        $this->situacao = !empty($data['situacao']) ? $data['situacao'] : null;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getSobrenome() {
        return $this->sobrenome;
    }

    function getEmail() {
        return $this->email;
    }

    function getSituacao() {
        return $this->situacao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    public function getArrayCopy(): array {
        return [
        'id' => $this->id,
        'nome' => $this->nome,
        'sobrenome' => $this->sobrenome,
        'email' => $this->email,
        'situacao' => $this->situacao
        ];
    }

}
