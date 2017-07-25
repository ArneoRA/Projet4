<?php

namespace Louvre\BookingBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('nomVisiteur', TextType::class)
            ->add('prenomVisiteur', TextType::class)
            ->add('paysVisiteur', TextType::class)
//            ->add('paysVisiteur', EntityType::class, array(
//                'class'         =>'LouvreBookingBundle:Pays',
//                'query_builder' => function (EntityRepository $entityRepository){
//                    return $entityRepository->listePays();
//                }
//            ))
            ->add('dateNaissance', BirthdayType::class)
            ->add('tarifVisiteur', TextType::class);
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
