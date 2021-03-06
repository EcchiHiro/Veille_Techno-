<?php

namespace biero\visiteurBundle\Entity;

// Doctrine
use Doctrine\ORM\Mapping as ORM;

// Permet d'utiliser les annotations pour la validation
use Gedmo\Mapping\Annotation as Gedmo;
// Validator
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Biere
 *
 * @ORM\Table(name="biere")
 * @ORM\Entity(repositoryClass="biero\visiteurBundle\Repository\BiereRepository")
 */
class Biere
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
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\Length(
     *      min = 5,
     *      minMessage = "le nom doit être plus grand que {{ limit }} caractères"
     * )
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="brasserie", type="string", length=255)
     * @Assert\Length(
     *      min = 5,
     *      minMessage = "la brasserie doit être plus grand que {{ limit }} caractères"
     * )
     */
    private $brasserie;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     * @Assert\Valid()
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="datetimetz")
     * @Assert\DateTime()
     */
    private $dateAjout;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modif", type="datetime")
     * @Assert\DateTime()
     */
    private $dateModif;



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
     * Set nom
     *
     * @param string $nom
     * @return Biere
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set brasserie
     *
     * @param string $brasserie
     * @return Biere
     */
    public function setBrasserie($brasserie)
    {
        $this->brasserie = $brasserie;

        return $this;
    }

    /**
     * Get brasserie
     *
     * @return string 
     */
    public function getBrasserie()
    {
        return $this->brasserie;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Biere
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Biere
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return Biere
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
     * Set dateModif
     *
     * @param \DateTime $dateModif
     * @return Biere
     */
    public function setDateModif($dateModif)
    {
        $this->dateModif = $dateModif;

        return $this;
    }

    /**
     * Get dateModif
     *
     * @return \DateTime 
     */
    public function getDateModif()
    {
        return $this->dateModif;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return Biere
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean 
     */
    public function getActif()
    {
        return $this->actif;
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
