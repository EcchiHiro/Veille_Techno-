<?php

namespace biero\visiteurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

// Permet d'utiliser les annotations pour la validation
use Gedmo\Mapping\Annotation as Gedmo;
// Validator
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="biero\visiteurBundle\Repository\CommentaireRepository")
 */
class Commentaire
{
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255)
     * @Assert\Length(min=5)
     */
    private $commentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="datetimetz")
     * @Assert\DateTime()
     */
    private $dateAjout;

    /**
    * @ORM\ManyToOne(targetEntity="biero\visiteurBundle\Entity\Biere", cascade={"remove"})
    * @ORM\JoinColumn(onDelete="CASCADE")
    */
    private $biere;    
    
    /**
    * @ORM\ManyToOne(targetEntity="biero\visiteurBundle\Entity\Usager", cascade={"persist"})
    */
    private $usager;
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return Commentaire
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime 
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * Set biere
     *
     * @param \biero\visiteurBundle\Entity\Biere $biere
     * @return Commentaire
     */
    public function setBiere(\biero\visiteurBundle\Entity\Biere $biere = null)
    {
        $this->biere = $biere;

        return $this;
    }

    /**
     * Get biere
     *
     * @return \biero\visiteurBundle\Entity\Biere 
     */
    public function getBiere()
    {
        return $this->biere;
    }

    /**
     * Set usager
     *
     * @param \biero\visiteurBundle\Entity\Usager $usager
     * @return Commentaire
     */
    public function setUsager(\biero\visiteurBundle\Entity\Usager $usager = null)
    {
        $this->usager = $usager;

        return $this;
    }

    /**
     * Get usager
     *
     * @return \biero\visiteurBundle\Entity\Usager 
     */
    public function getUsager()
    {
        return $this->usager;
    }
    
    
        
    /**
     * Constructeur de l'entité
     */
    
    public function __construct()
    {
        // On défini la valeur par défaut de la date
        $this->dateAjout = new \Datetime();

    }
}
