<?php

namespace Louvre\BookingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailReservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomVisiteur', TextType::class, array(
                'attr' => array(
                    'placeholder' => '3 caracteres Minimum'
                )
            ))
            ->add('prenomVisiteur', TextType::class, array(
                'attr' => array(
                    'placeholder' => '3 caracteres Minimum'
                )
            ))
            ->add('paysVisiteur', CountryType::class, array(
                'preferred_choices'  => array(
                    'France'    => 'FR'
                )
            ))
            ->add('dateNaissance', BirthdayType::class, array(
                'years'     => range(1920, date('Y'))
            ))
            ->add('tarifReduit', CheckboxType::class, array('required' => false))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Louvre\BookingBundle\Entity\DetailReservation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'louvre_bookingbundle_detailreservation';
    }


}
