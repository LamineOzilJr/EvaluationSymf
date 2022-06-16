<?php

namespace App\Form;

use App\Entity\Evaluation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, array('required' => true, 'label'=>"Libelle", 'attr'=>array('class'=>'form-control form-group')))
            ->add('critere', EntityType::class, array('class'=>'App\Entity\Critere', 'label'=>'Critere', 'attr'=>array('class'=>'form-control form-group')))
            ->add('indicateur', EntityType::class, array('class'=>'App\Entity\Indicateur', 'label'=>'Indicateur', 'attr'=>array('class'=>'form-control form-group')))
            ->add('Envoyer', SubmitType::class, array('attr'=>array('class'=>'btn btn-success')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evaluation::class,
        ]);
    }
}
