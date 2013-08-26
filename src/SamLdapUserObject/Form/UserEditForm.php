<?php
/**
 * @author Manuel Stosic <manuel.stosic@duit.de>
 * @copyright 2013 DU-IT GmbH
 */
namespace SamLdapUserObject\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Form\Form;

class UserEditForm extends Form
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('user-edit-form');
        $this->objectManager = $objectManager;

        $this->setHydrator(new DoctrineObject($objectManager));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf'
        ));

        $fieldset = new UserFieldset($objectManager);
        $fieldset->setUseAsBaseFieldset(true);
        $this->add($fieldset);

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'options' => array(
                'label' => 'Profil aktualisieren'
            ),
            'attributes' => array(
                'class' => 'btn btn-primary'
            )
        ));
    }
}