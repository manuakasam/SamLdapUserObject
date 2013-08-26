<?php
/**
 * @author Manuel Stosic <manuel.stosic@duit.de>
 * @copyright 2013 DU-IT GmbH
 */
namespace SamLdapUserObject\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserEditFormFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new UserEditForm(
            $serviceLocator->get('SamLdapUserObject\ObjectManager')
        );
    }
}