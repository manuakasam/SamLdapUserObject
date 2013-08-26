<?php
namespace SamLdapUserObject\Controller;

use Zend\Http\PhpEnvironment\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'user' => $this->getServiceLocator()
                ->get('SamLdapUserObject\AuthService')
                ->getIdentity()
        ));
    }

    public function userEditAction()
    {
        $prg = $this->prg($this->url('user-manager/edit'), true);

        // Post Request also redirect
        if ($prg instanceof Response) {
            return $prg;
        }

        $viewModel   = new ViewModel();
        $srvcLocator = $this->getServiceLocator();
        $form        = $srvcLocator->get('SamLdapUserObject\Form\UserEditForm');
        $usrIdentity = $srvcLocator->get('SamLdapUserObject\AuthService')->getIdentity();

        $form->bind($usrIdentity);

        $viewModel->setTemplate('sam-ldap-user-object/user/user-edit.phtml');
        $viewModel->setVariable('form', $form);

        // Weder Post noch Redirect, also Index
        if (false === $prg) {
            return $viewModel;
        }

        // Handle Form Data
        $form->setData($prg);
        if (false === $form->isValid()) {
            return $viewModel;
        }

        try {
            $userService = $srvcLocator->get('SamLdapUserObject\Service\UserService');
            $userService->updateUser($form->getData());

            $this->flashMessenger()->addSuccessMessage('Profil erfolgreich aktualisiert');

            return $this->redirect()->toRoute('user-manager');
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('Profil konnte nicht aktualisiert werden.')
                ->addErrorMessage($e->getMessage());

            return $viewModel;
        }
    }
}