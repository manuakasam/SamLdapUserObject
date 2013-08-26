<?php
namespace SamLdapUserObject\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 *
 * @package SamLdapUserObject\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="ldap_users", indexes={
 * @ORM\Index(name="search_idx", columns={
 *         "ldap_identity"
 *     })
 * })
 */
class User implements LdapUserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     * @access protected
     */
    protected $id;

    /**
     * @ORM\Column(name="ldap_identity", type="string", nullable=false)
     * @var string
     * @access protected
     */
    protected $ldapIdentity;

    /**
     * @ORM\Column(name="name", type="string", nullable=true)
     * @var string
     * @access protected
     */
    protected $name;

    /**
     * @ORM\Column(name="surname", type="string", nullable=true)
     * @var string
     * @access protected
     */
    protected $surname;

    /**
     * @ORM\Column(name="phone_work", type="string", nullable=true)
     * @var string
     * @access protected
     */
    protected $phoneWork;

    /**
     * @ORM\Column(name="phone_alternative", type="string", nullable=true)
     * @var string
     * @access protected
     */
    protected $phoneAlternative;

    /**
     * @ORM\Column(name="email", type="string", nullable=true)
     * @var string
     * @access protected
     */
    protected $email;

    public function getDisplayName()
    {
        if ($this->getName() && $this->getSurname()) {
            return $this->getName().' '.$this->getSurname();
        }

        return $this->getLdapIdentity();
    }

    public function hasProfileBeenEdited()
    {
        return !(
               is_null($this->getEmail())
            && is_null($this->getName())
            && is_null($this->getSurname())
            && is_null($this->getPhoneWork())
            && is_null($this->getPhoneAlternative())
        );
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $ldapIdentity
     * @return User
     */
    public function setLdapIdentity($ldapIdentity)
    {
        $this->ldapIdentity = $ldapIdentity;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLdapIdentity()
    {
        return $this->ldapIdentity;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $phoneAlternative
     * @return User
     */
    public function setPhoneAlternative($phoneAlternative)
    {
        $this->phoneAlternative = $phoneAlternative;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneAlternative()
    {
        return $this->phoneAlternative;
    }

    /**
     * @param string $phoneWork
     * @return User
     */
    public function setPhoneWork($phoneWork)
    {
        $this->phoneWork = $phoneWork;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneWork()
    {
        return $this->phoneWork;
    }

    /**
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }
}