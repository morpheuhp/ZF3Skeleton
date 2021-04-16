<?php

namespace Core\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Form\View\Helper\FormElementErrors;

/**
 * Description of FormElementErrorsFactory
 *
 * @author fernando
 */
class FormElementErrorsFactory implements FactoryInterface {

    //put your code here
    public function __invoke(ContainerInterface $container, $requestedName, $options = null): object {
        $helper = new FormElementErrors();
        $config = $container->get('config');

        if (isset($config['view_helper_config']['form_element_errors'])) {
            $configHelper = $config['view_helper_config']['form_element_errors'];
            if (isset($configHelper['message_open_format'])) {
                $helper->setMessageOpenFormat($configHelper['message_open_format']);
            }
            if (isset($configHelper['message_separator_string'])) {
                $helper->setMessageSeparatorString($configHelper['message_separator_string']);
            }
            if (isset($configHelper['message_close_string'])) {
                $helper->setMessageCloseString($configHelper['message_close_string']);
            }
        }
        return $helper;
    }

}
