<?php

namespace biero\visiteurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

// Permet d'utiliser les annotations pour la validation
use Gedmo\Mapping\Annotation as Gedmo;
// Validator
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity(repositoryClass="biero\visiteurBundle\Repository\NoteRepository")
 */
class Note
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
     * @var int
     *
     * @ORM\Column(name="note", type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 20,
     *      minMessage = "La note doit être supérieure à {{ limit }}",
     *      maxMessage = "La note doit être inférieure à {{ limit }}"
     * )
     */
    private $note;
    
        
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
     * Set note
     *
     * @param integer $note
     * @return Note
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set biere
     *
     * @param \biero\visiteurBundle\Entity\Biere $biere
     * @return Note
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
     * @return Note
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
}
