<?php
/**
 * Created by PhpStorm.
 * User: maxds
 * Date: 06.01.18
 * Time: 16:23
 */

namespace AppBundle\Form;


use AppBundle\Entity\Quizzes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizzesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('questions', TextType::class)
            ->add('status', TextType::class)
            ->add('submit', SubmitType::class, array(
                'label' => 'Add quiz'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Quizzes::class
        ]);
    }
}