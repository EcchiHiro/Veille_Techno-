<?php

namespace biero\adminBundle\Controller;

//Entités utilisés
use biero\visiteurBundle\Entity\Biere;
use biero\visiteurBundle\Entity\Usager;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// Form
use biero\visiteurBundle\Form\BiereType;

class AdminController extends Controller
{
    
    /**
    *  Méthode qui affiche la d'index de l'administration
    */
    
    public function indexAction()
    {
        // On accède au manager 
        // de l'entité bière
        $repository = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('visiteurBundle:Biere')
        ;

        // Requete qui recupére toute les bières
        $listeBieres = $repository->findAll();
                
        if (null == $listeBieres) {
          throw new NotFoundHttpException("Il n'existe aucune bière dans la base de données");
        }

        // Génération de la vue avec le template de l'index
        return $this->render('adminBundle:Default:index.html.twig', array(
          'listeBieres'           => $listeBieres
        ));
    }
    
    /**
    *  Méthode qui affiche gere l'ajout d'une bière
    */
    
    public function addAction(Request $request )
    {
        // Création de l'entité bière 
        $biere = new Biere();
        
        //Génération du formulaire à partir de l'entité 
        // ici on utilise le form Biere Type (Bundle visiteur forms)
        $form = $this->createForm(new BiereType(), $biere);

        // Si le formulaire est valide on ajoute la bière
        if ($form->handleRequest($request)->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($biere);
          $em->flush();

          $request->getSession()->getFlashBag()->add('notice', 'La bière à bien été ajoutée');

          return $this->redirect($this->generateUrl('admin_homepage'));
        }

        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire n'est pas valide, donc on l'affiche de nouveau
        return $this->render('adminBundle:Default:ajout.html.twig', array(
          'form' => $form->createView(),
        ));
       
    }
       
    
    /**
    *  Méthode qui affiche gere la modification d'une bière
    */
    
    public function modifAction($id, Request $request )
    {
        
        $em = $this->getDoctrine()->getManager();

        // On récupère l'annonce $id
        $biere = $em->getRepository('visiteurBundle:Biere')->find($id);
        
        // Si l'id est inconnu
        if (null == $biere) {
          throw new NotFoundHttpException("La bière dont l'id est :  ".$id." n'existe pas.");
        }

        // Génération du formulaire avec les informations de la bière
        $form = $this->createForm(new BiereType(), $biere);
        
        // Si c'est valide la requete ce fait
        if ($form->handleRequest($request)->isValid()) {
          
          $em->flush();

          $request->getSession()->getFlashBag()->add('notice', 'La bière a bien été modifiée');

          return $this->redirect($this->generateUrl('admin_homepage'));
        }

        
        return $this->render('adminBundle:Default:modif.html.twig', array(
          'form'   => $form->createView(),
          'biere' => $biere 
        ));
       
    }
    
    /**
    *  Méthode qui affiche / gere la suppression d'une bière
    */
    
    public function deleteAction($id, Request $request )
    {
        $em = $this->getDoctrine()->getManager();

        // On récupère l'annonce $id
        $biere = $em
            ->getRepository('visiteurBundle:Biere')
            ->find($id);

        if (null == $biere) {
          throw new NotFoundHttpException("La bière avec l'id :  ".$id." n'existe pas.");
        }

        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'annonce contre cette faille
        $form = $this->createFormBuilder()->getForm();

        if ($form->handleRequest($request)->isValid()) {
          $em->remove($biere);
          $em->flush();

          $request->getSession()->getFlashBag()->add('info', "La bière a bien été supprimée.");

          return $this->redirect($this->generateUrl('admin_homepage'));
        }

        // Si la requête est en GET, on affiche une page de confirmation avant de supprimer
        return $this->render('adminBundle:Default:delete.html.twig', array(
          'biere' => $biere,
          'form'   => $form->createView()
        ));
    }
}


?>