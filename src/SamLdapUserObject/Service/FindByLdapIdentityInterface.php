<?php
namespace SamLdapUserObject\Service;

interface FindByLdapIdentityInterface 
{
    public function findByLdapIdentity($username);
}