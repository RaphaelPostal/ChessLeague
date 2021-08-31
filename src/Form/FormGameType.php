<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Player;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormGameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('end', ChoiceType::class, [
                'label' => 'Issue',
                'choices' => [
                    'Mat' => Game::MATE,
                    'Abandon' => Game::SURREND,
                    'Égalité' => Game::DRAW
                ]
            ])
            ->add('winner', EntityType::class, [
                'class' => Player::class,
                'choice_label' => 'name',
                'label' => 'Gagnant'
            ])
            ->add('Blancs', EntityType::class, [
                'class' => Player::class,
                'choice_label' => 'name'
            ])
            ->add('Noirs', EntityType::class, [
                'class' => Player::class,
                'choice_label' => 'name'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Sauvegarder'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
