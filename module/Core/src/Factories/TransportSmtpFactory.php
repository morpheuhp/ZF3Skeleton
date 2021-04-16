<?php

namespace Core\Factories;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Description of TransportSmtpFactory
 *
 * @author fernando
 */
class TransportSmtpFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, $options = null): object {
        $config = $container->get('config');
        $transport = new SmtpTransport();
        $options = new SmtpOptions($config['mail']);
        $transport->setOptions($options);
        return $transport;
    }

}
