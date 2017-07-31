<?php

namespace Louvre\BookingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class ReservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateVisite', DateType::class, array(
                'widget' => 'single_text', // Permet d'afficher la date dans un seul champ
                // Format de la date
                'format' => 'dd/MM/yyyy',
            ))
            ->add('typeReservation', ChoiceType::class, array(
                'choices' => array(
                    'Demi-Journée' =>0,
                    'Journée' =>1,
                )
            ))
            ->add('nbrePlaces',ChoiceType::class, array(
                'choices'    =>array(
                    '1 personne' => 1,
                    '2 personnes' => 2,
                    '3 personnes' => 3,
                    '4 personnes' => 4,
                    '5 personnes' => 5,
                    '6 personnes' => 6,
                )
            ))
//            ->add('detailResa', DetailReservationType::class)
            ->add('details', CollectionType::class, array(
                'entry_type'    => DetailReservationType::class,
                'allow_add'     => true,
                'allow_delete'  => false,
            ))
            ->add('emailClient', EmailType::class)
//            ->add('montantReservation', TextType::class)
            ->add('Valider',      SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Louvre\BookingBundle\Entity\Reservation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'louvre_bookingbundle_reservation';
    }


}
