<?php
/**
 * Created by PhpStorm.
 * User: maxds
 * Date: 06.01.18
 * Time: 1:06
 */

namespace AppBundle\Form;


use AppBundle\Entity\Questions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question', TextType::class)
            ->add('answer1', TextType::class)
            ->add('answer2', TextType::class)
            ->add('answer3', TextType::class)
            ->add('answerTrue', TextType::class)
            ->add('submit', SubmitType::class, array(
                'label' => 'Add question'
            ));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Questions::class
        ]);
    }
}