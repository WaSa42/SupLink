<?php

namespace Web\Bundle\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Session\Session;
use JMS\SecurityExtraBundle\Annotation\Secure;
use FOS\UserBundle\Doctrine\UserManager;
use Web\Bundle\UserBundle\Form\Type\UserType;

class UserController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('WebUserBundle:User');
        $users = $repository->findAll();

        return $this->render('WebUserBundle:Home:index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/profile/edit", name="profile_edit")
     * @Method({"GET", "POST"})
     * @Template("WebUserBundle:Profile:edit.html.twig")
     */
    public function editAction()
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $this->container->get('security.context')->getToken()->getUser();

        $form = $this->createForm(new UserType(), $user);

        $request = $this->get('request');
        $form->handleRequest($request);

        if($request->getMethod() == 'POST')
        {
            if($form->isValid())
            {
                $userManager->updateUser($user);
                return $this->redirect($this->generateUrl('fos_user_profile_show'));
            }
        }

        return array(
            'entity' => $user,
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/profile/user/{id}", name="user_profile")
     * @Method("GET")
     */
    public function displayAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('WebUserBundle:User');
        $user = $repository->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Utilisateur inexistant.');
        }

        return $this->render('BlogDuLibreAvisUserBundle:Profile:display.html.twig', array(
            'user' => $user,
        ));
    }
}
