<?php

namespace Web\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Controller\SecurityController as BaseSecurityController;

class SecurityController extends BaseSecurityController
{
    public function loginAction(Request $request)
    {
        return parent::loginAction($request);
    }

    protected function renderLogin(array $data)
    {
        $template = 'FOSUserBundle:Security:login.html';
        $extension = $this->container->getParameter('fos_user.template.engine');

        return $this->container->get('templating')->renderResponse("$template.$extension", $data);
    }
}
