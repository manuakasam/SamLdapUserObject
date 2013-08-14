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
}