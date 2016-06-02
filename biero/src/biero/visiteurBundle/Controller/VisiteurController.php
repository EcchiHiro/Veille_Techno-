<?php

namespace biero\visiteurBundle\Controller;


// Entités utilisées par le controlleur
use biero\visiteurBundle\Entity\Biere;
use biero\visiteurBundle\Entity\Commentaire;
use biero\visiteurBundle\Entity\Note;
use biero\visiteurBundle\Entity\Usager;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// Form
use biero\visiteurBundle\Form\CommentaireType;
use biero\visiteurBundle\Form\NoteType;

class VisiteurController extends Controller
{
    
    /**
    *  Méthode qui affiche la page d'accueil
    */
    
    public function indexAction()
    {
        $repository = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('visiteurBundle:Biere')
        ;
        
        // Récupération de la liste des bières
        $listeBieres = $repository->findAll();
                
        // Si la bdd est vide alors message d'erreur
        if (null == $listeBieres) {
          throw new NotFoundHttpException("Il n'existe aucune bière dans la base de données");
        }

        // On passe la liste en paramètre au rendering avec le template de la page d'accueil
        return $this->render('visiteurBundle:Default:index.html.twig', array(
          'listeBieres'           => $listeBieres
        ));
    }    
    
    /**
    *  Méthode qui affiche la page d'une bière
    */
    
    public function viewAction($id, Request $request )
    {
        
        $em = $this->getDoctrine()->getManager();

        // On récupère la bière par son $id
        $biere = $em
          ->getRepository('visiteurBundle:Biere')
          ->find($id)
        ;
        
        // Si la bière n'existe pas alors erreur
        if (null == $biere) {
          throw new NotFoundHttpException("La bière numéro ".$id." n'existe pas.");
        }

        // Liste des commentaires
         $listeCommentaires = $em
          ->getRepository('visiteurBundle:Commentaire')
          ->findBy(array('biere' => $biere))
        ;

        // Liste des notes
        $listeNotes = $em
          ->getRepository('visiteurBundle:Note')
          ->findBy(array('biere' => $biere))
        ;
        
        
        /*
        * Partie POST du controlleur
        * Ajouter un commentaire
        * Ajouter une note
        */
        
        $commentaire = new Commentaire();

        // On ajoute l'id de la bière dans le commentaire
        $commentaire->setBiere($biere);
        
        // On crée le formulaire grace au service form factory
        $form = $this->get('form.factory')->create(new CommentaireType, $commentaire);
   
        // Si la requête est en POST
        if ($request->isMethod('POST')) 
        {
              $form->handleRequest($request);

          // On vérifie que les valeurs entrées sont correctes
          // la validation est faite grace au Validator (dans les entités)
            
          if ($form->isValid()) 
          {
                // On enregistre notre objet commentaire dans la base de données
                $em = $this->getDoctrine()->getManager();
                $em->persist($commentaire);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Commentaire ajouté.');

                // On redirige vers la page de la bière pour laquelle on as ajouté un commentaire
                return $this->redirectToRoute('visiteur_biere', array('id' => $biere->getId()));
          }
            
        }
        
        
        
        $note = new Note();

        // On ajoute l'id de la bière dans la note
        $note->setBiere($biere);
        
        // On crée le FormBuilder grâce au service form factory
        $form2 = $this->get('form.factory')->create(new NoteType, $note);

        
        // Si la requête est en POST
        if ($request->isMethod('POST')) 
        {

              $form2->handleRequest($request);

          // On vérifie que les valeurs entrées sont correctes
          // la validation est faite grace au Validator (dans les entités)
            
            
          if ($form2->isValid()) 
          {
                // On enregistre notre objet note dans la base de données
                $em = $this->getDoctrine()->getManager();
                $em->persist($note);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Note ajoutée.');

                // On redirige vers la page de visualisation de l'annonce nouvellement créée
                return $this->redirectToRoute('visiteur_biere', array('id' => $biere->getId()));
          }
            
        }

        // Vue d'une bière avec en param les informations de la bière, la liste des notes et commentaires
        // ainsi que les deux formulaires.
        return $this->render('visiteurBundle:Default:view.html.twig', array(
          'biere'           => $biere,
          'listeCommentaires' => $listeCommentaires,
          'listeNotes' => $listeNotes,
          'form' => $form->createView(),
          'form2' => $form2->createView(),
        ));
        
    }
    
    
    
}


?>