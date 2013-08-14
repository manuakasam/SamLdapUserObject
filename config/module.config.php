<?php
return array(
    'service_manager' => array(
        'aliases' => array(
            'SamLdapUserObject\ObjectManager' => 'Doctrine\ORM\EntityManager'
        ),
        'invokables' => array(
            'SamLdapUserObject\UserPrototype' => 'SamLdapUserObject\Entity\User'
        )
    ),
    'doctrine'        => array(
        'driver' => array(
            'SamLdapUserObject_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'filesystem',
                'paths' => array(__DIR__ . '/../src/SamLdapUserObject/Entity')
            ),
            'orm_default'           => array(
                'drivers' => array(
                    'SamLdapUserObject\Entity' => 'SamLdapUserObject_driver'
                )
            )
        )
    )
);