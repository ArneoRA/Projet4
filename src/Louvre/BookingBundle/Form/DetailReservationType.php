<?php

namespace Louvre\BookingBundle\Form;

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
            ->add('nomVisiteur', TextType::class)
            ->add('prenomVisiteur', TextType::class)
            ->add('paysVisiteur', CountryType::class)
            ->add('dateNaissance', BirthdayType::class)
            ->add('tarifReduit', CheckboxType::class, array('required' => false))
            // Valeur du Champ :
            //      0 = Tarif normal
            //      1 = Tarif réduit
//            ->add('tarifvisiteur', TextType::class, array(
//                'label'     => ' ', //Je masque le label pour ne pas le faire afficher
//                'attr'      => array(
//                    'class' => 'hidden')
//                )
//            )
//            ->add('idResa', TextType::class, array(
//                    'label'     => ' ', //Je masque le label pour ne pas le faire afficher
//                    'attr'      => array(
//                        'class' => 'hidden')
//                )
//            )
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
