<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdType extends AbstractType
{
    /** Permet d'avoir la configuration de base d'un champ
     * 
     * 
     * @param string $label
     * @param string $placeholder
     * @return array
     **/

    private function getConfiguration($label, $placeholder) {

        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]];

    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title', TextType::class , $this->getConfiguration('Titre','Titre de votre annonce'))
        ->add('slug',TextType::class , $this->getConfiguration('Slug','Le slug ce fait automatiquement, mais vas y fait toi plaiz')) 
        ->add('coverImage',UrlType::class,$this->getConfiguration('Image','Entrez une image de votre bien'))
        ->add('introduction',TextType::class , $this->getConfiguration('Introduction','Introduisez votre annonce en quelques mots'))
        ->add('content', TextareaType::class , $this->getConfiguration('Description','Ecrire une description precise de votre bien'))
        ->add('rooms' , IntegerType::class , $this->getConfiguration('Chambres','Nombres de chambres disponnibles'))
        ->add('price', MoneyType::class , $this->getConfiguration('Prix par nuit','Prix par nuit de votre annonce'))



             ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
