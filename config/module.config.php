<?php
return array(
    'service_manager' => array(
        'aliases'    => array(
            'SamLdapUserObject\ObjectManager' => 'Doctrine\ORM\EntityManager',
            'SamLdapUserObject\AuthService'   => 'SamLdapUser\Service\AuthService'
        ),
        'invokables' => array(
            'SamLdapUserObject\UserPrototype' => 'SamLdapUserObject\Entity\User'
        ),
        'factories'  => array(
            'SamLdapUserObject\Service\UserService' => 'SamLdapUserObject\Service\UserServiceFactory',
            'SamLdapUserObject\Form\UserEditForm'   => 'SamLdapUserObject\Form\UserEditFormFactory'
        )
    ),
    'bjyauthorize'    => array(
        'guards' => array(
            'BjyAuthorize\Guard\Route' => array(
                array('route' => 'user-manager', 'roles' => array('user')),
                array('route' => 'user-manager/edit', 'roles' => array('user')),
            )
        )
    ),
    'doctrine'        => array(
        'driver' => array(
            'SamLdapUserObject_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'filesystem',
                'paths' => array(__DIR__ . '/../src/SamLdapUserObject/Entity')
            ),
            'orm_default'              => array(
                'drivers' => array(
                    'SamLdapUserObject\Entity' => 'SamLdapUserObject_driver'
                )
            )
        )
    ),
    'controllers'     => array(
        'invokables' => array(
            'SamLdapUserObject\Controller\User' => 'SamLdapUserObject\Controller\UserController'
        )
    ),
    'router'          => array(
        'routes' => array(
            'user-manager' => array(
                'type'          => 'Zend\Mvc\Router\Http\Literal',
                'options'       => array(
                    'route'    => '/user',
                    'defaults' => array(
                        'controller' => 'SamLdapUserObject\Controller\User',
                        'action'     => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes'  => array(
                    'edit' => array(
                        'type'    => 'Zend\Mvc\Router\Http\Literal',
                        'options' => array(
                            'route'    => '/edit',
                            'defaults' => array(
                                'action' => 'userEdit'
                            )
                        ),
                    )
                )
            )
        )
    ),
    'view_manager'    => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);