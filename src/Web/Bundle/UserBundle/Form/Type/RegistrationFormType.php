<?php

namespace Web\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('email', 'email', array('translation_domain' => 'FOSUserBundle', 'attr' => array('class' => 'form-control', 'placeholder' => 'Adresse e-mail'), 'label' => false))
            ->add('username', null, array('translation_domain' => 'FOSUserBundle', 'attr' => array('class' => 'form-control', 'placeholder' => 'Nom d\'utilisateur'), 'label' => false))
            ->add('plainPassword', 'repeated', array(
            'type' => 'password',
            'options' => array('translation_domain' => 'FOSUserBundle'),
            'first_options' => array('attr' => array('class' => 'form-control', 'placeholder' => 'Mot de passe'), 'label' => false),
            'second_options' => array('attr' => array('class' => 'form-control', 'placeholder' => 'Vérification du mot de passe'), 'label' => false),
            'invalid_message' => 'fos_user.password.mismatch',
        ))
        ;
    }

    public function getName()
    {
        return 'web_user_registration';
    }
}