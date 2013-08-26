<?php
namespace SamLdapUserObject\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use SamLdapUserObject\Entity\User;

class UserService implements FindByLdapIdentityInterface
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var ObjectRepository
     */
    protected $objectRepository;

    /**
     * @param $username
     * @return User
     */
    public function findByLdapIdentity($username)
    {
        return $this->getObjectRepository()->findOneBy(array('ldapIdentity' => $username));
    }

    public function createUser(User $prototype)
    {
        $om = $this->getObjectManager();
        $om->persist($prototype);
        $om->flush();
    }

    public function updateUser(User $userObject)
    {
        $om = $this->getObjectManager();
        $om->persist($userObject);
        $om->flush();
    }

    /**
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->setObjectManager($objectManager);
    }

    /**
     * @param \Doctrine\Common\Persistence\ObjectManager $objectManager
     * @return UserService
     */
    public function setObjectManager($objectManager)
    {
        $this->objectManager = $objectManager;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    public function getObjectManager()
    {
        return $this->objectManager;
    }

    /**
     * @param \Doctrine\Common\Persistence\ObjectRepository $objectRepository
     * @return UserService
     */
    public function setObjectRepository($objectRepository)
    {
        $this->objectRepository = $objectRepository;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getObjectRepository()
    {
        if (!$this->objectRepository) {
            $this->setObjectRepository(
                $this->getObjectManager()->getRepository('SamLdapUserObject\Entity\User')
            );
        }

        return $this->objectRepository;
    }
}