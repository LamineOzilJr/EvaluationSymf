<?php

namespace App\Form;

use App\Entity\Indicateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IndicateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle',TextType::class, array('required' => true, 'label'=>"Libelle", 'attr'=>array('class'=>'form-control form-group')))
            ->add('Envoyer', SubmitType::class, array('attr'=>array('class'=>'btn btn-success'))) ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Indicateur::class,
        ]);
    }
}
