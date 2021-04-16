<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pessoa\Controller;

use Pessoa\Form\PessoaForm;
use Pessoa\Model\Pessoa;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PessoaController extends AbstractActionController {

    private $table;

    public function __construct($table) {
        $this->table = $table;
    }

    public function indexAction() {
        return new ViewModel(['pessoas' => $this->table->getAll()]);
    }

    public function adicionarAction() {
        $form = new PessoaForm();
        $form->get('submit')->setValue('Adicionar');
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return new ViewModel(['form' => $form]);
        } else {
            $pessoa = new Pessoa();
            $form->setData($request->getPost());
            if (!$form->isValid()) {
                return new ViewModel(['form' => $form]);
            }

            $pessoa->exchangeArray($form->getData());
            $this->table->salvarPessoa($pessoa);
            return $this->redirect()->toRoute('pessoa');
        }
    }

    public function editarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (0 === $id) {
            return $this->redirect()->toRoute('pessoa', ['action' => 'adicionar']);
        }

        try {
            $pessoa = $this->table->getPessoa($id);
        } catch (Exception $exc) {
            return $this->redirect()->toRoute('pessoa', ['action' => 'index']);
        }

        $form = new PessoaForm();
        $form->bind($pessoa);
        $form->get('submit')->setValue('Salvar');
        $request = $this->getRequest();

        $viewData = ['id' => $id, 'form' => $form];

        if (!$request->isPost()) {
            return $viewData;
        }

        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return $viewData;
        }

        $this->table->salvarPessoa($pessoa);
        return $this->redirect()->toRoute('pessoa', ['action' => 'editar', 'id' => $id]);
    }

    public function removerAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (0 === $id) {
            return $this->redirect()->toRoute('pessoa', ['action' => 'pessoa']);
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            try {
                $del = $request->getPost('del', 'Não');
                if ($del == 'Sim') {
                    $id = (int) $request->getPost('id');
                    $this->table->deletarPessoa($id);
                }
                return $this->redirect()->toRoute('pessoa');
                
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }
        
        return ['id' => $id, 'pessoa' => $this->table->getPessoa($id)];
    }

    public function confirmacaoAction() {
        return new ViewModel();
    }

    /**
     * meusite.com.br/pessoa -> index
     * /pessoa/adicionar -> adicionarAction
     * /pessoa/salvar -> salvarAction
     * /pessoa/editar/1 -> editarAction
     * /pessoa/remover/1 -> removerAction
     * /pessoa/confirmacao -> confirmacaoAction
     */
}
