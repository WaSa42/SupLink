<?php

namespace Web\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array(
                'required'  => true,
            ))
            ->add('email', 'email', array(
                'required'  => true,
            ))
            ->add('lastName', 'text', array(
                'required'  => false,
            ))
            ->add('firstName', 'text', array(
                'required'  => false,
            ))
            ->add('job', 'text', array(
                'required'  => false,
            ))
            ->add('skills', 'text', array(
                'required'  => false,
            ))
            ->add('enabled', 'checkbox', array(
                'required'  => false,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Web\Bundle\UserBundle\Entity\User',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'web_userbundle_user';
    }
}
