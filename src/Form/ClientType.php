<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ClientType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nome: '])
            ->add('email', TextType::class, ['label' => 'Email: '])
            ->add('telephone', TextType::class, ['label' => 'Telefone: '])
            ->add('password', TextType::class, ['label' => 'Senha: '])
            ->add('Salvar', SubmitType::class);
            

    }
}