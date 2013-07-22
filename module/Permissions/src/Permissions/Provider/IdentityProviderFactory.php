<?php

namespace Permissions\Provider;

use Permissions\Provider\IdentityProvider;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IdentityProviderFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return \BjyAuthorize\Provider\Identity\ProviderInterface
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('BjyAuthorize\Config');

        $auth = $serviceLocator->get('AuthService');

        $user = $auth->hasIdentity() ? $auth->getIdentity() : null;

        $provider = new IdentityProvider( $user );
        $provider->setDefaultRole( $config['default_role'] );

        return $provider;
    }
}
