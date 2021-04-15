<?php

namespace Pessoa\Form;

use Zend\Form\Form;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Email;
use Zend\Form\Element\Submit;

/**
 * Description of PessoaForm
 *
 * @author fernando
 */
class PessoaForm extends Form {

    public function __construct() {
        parent::__construct('pessoa', [$options]);

        $this->add(new Hidden('id'));
        $this->add(new Text('nome', ['label' => 'Nome']));
        $this->add(new Text('sobrenome', ['label' => 'Sobrenome']));
        $this->add(new Email('email', ['label' => 'E-mail']));
        $this->add(new Text('situacao', ['label' => 'Situação']));

        $submit = new Submit('submit');

        $submit->setAttributes(['value' => 'Salvar', 'id' => 'submitbutton']);
        $this->add($submit);
    }

}
