<?php

namespace biero\visiteurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('usager',      new UsagerType()) // On appele le form d'usager (le champ user)
            ->add('commentaire',  'textarea')
            ->add('soumettre',      'submit')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'biero\visiteurBundle\Entity\Commentaire'
        ));
    }
    
    public function getName()
    {
      return 'visiteur_biere';
    }
    
}

?>
