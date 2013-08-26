<?php
/**
 * @author    Manuel Stosic <manuel.stosic@duit.de>
 * @copyright 2013 DU-IT GmbH
 */
namespace SamLdapUserObject\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use SamLdapUserObject\Entity\User;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class UserFieldset extends Fieldset implements InputFilterProviderInterface
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('user-fieldset');
        $this->setObject(new User());
        $this->setHydrator(new DoctrineObject($objectManager));

        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden'
        ));

        $this->add(array(
            'type'       => 'Zend\Form\Element\Email',
            'options'    => array(
                'label' => 'E-Mail-Adresse'
            ),
            'attributes' => array(
                'required' => true,
                'name'       => 'email',
            )
        ));

        $this->add(array(
            'name'       => 'name',
            'type'       => 'Zend\Form\Element\Text',
            'options'    => array(
                'label' => 'Vorname'
            ),
            'attributes' => array(
                'required' => true
            )
        ));

        $this->add(array(
            'name'       => 'surname',
            'type'       => 'Zend\Form\Element\Text',
            'options'    => array(
                'label' => 'Nachname'
            ),
            'attributes' => array(
                'required' => true
            )
        ));

        $this->add(array(
            'name'    => 'phoneWork',
            'type'    => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Telefonnummer Arbeit'
            ),
        ));

        $this->add(array(
            'name'    => 'phoneAlternative',
            'type'    => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Telefonnummer Sonstige'
            ),
        ));
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return array(
            'email'            => array(
                'filters'    => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
                'validators' => array(

                )
            ),
            'name'             => array(
                'filters'    => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
            ),
            'surname'          => array(
                'filters'    => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
            ),
            'phoneWork'        => array(
                'filters'    => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
            ),
            'phoneAlternative' => array(
                'filters'    => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
            ),
        );
    }
}