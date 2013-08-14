<?php
/**
 * @author Manuel Stosic <manuel.stosic@duit.de>
 * @copyright 2013 DU-IT GmbH
 */
namespace SamLdapUserObject\Entity;

interface LdapUserInterface 
{
    public function setId($id);
    public function getId();
    public function setLdapIdentity($ldapIdentity);
    public function getLdapIdentity();
}