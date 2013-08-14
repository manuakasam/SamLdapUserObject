<?php
namespace SamLdapUserObject;

use SamLdapUser\Service\AuthService;
use SamLdapUserObject\Service\FindByLdapIdentityInterface;
use Zend\EventManager\Event;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface
{
    /**
     * Return an array for passing to Zend\Loader\AutoloaderFactory.
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
//            'invokables' => array(
//                'SamLdapUserObject\Entity\User' => 'SamLdapUserObject\Entity\User'
//            ),
            'factories' => array(
                'SamLdapUserObject\Service\UserService' => 'SamLdapUserObject\Service\UserServiceFactory'
            )
        );
    }

    public function onBootstrap(MvcEvent $mvcEvent)
    {
        $eventManager       = $mvcEvent->getApplication()->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();

        $sharedEventManager->attach(
            'SamLdapUser\Service\AuthService',
            AuthService::EVENT_IDENTITY_GET,
            function (Event $e) use ($mvcEvent) {
                $stringIdentity = $e->getTarget();
                $service        = $mvcEvent->getApplication()->getServiceManager()->get('SamLdapUserObject\Service\UserService');

                if (!$service instanceof FindByLdapIdentityInterface) {
                    throw new \Exception('SamLdapUserObject::onBootstrap(EVENT_IDENTITY_GET) was unable to get a valid mapping-class.');
                }

                $userIdentity = $service->findByLdapIdentity($stringIdentity);
                if ($userIdentity) {
                    $e->stopPropagation();
                    return $userIdentity;
                }

                $userPrototype = $mvcEvent->getApplication()->getServiceManager()->get('SamLdapUserObject\UserPrototype');
                $userPrototype->setLdapIdentity($stringIdentity);

                try {
                    $service->createUser($userPrototype);
                    return $userPrototype;
                } catch (\Exception $e) {
                    return $stringIdentity;
                }
            }
        );
    }
}