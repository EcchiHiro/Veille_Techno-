<?php

namespace biero\visiteurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

// Permet d'utiliser les annotations pour la validation
use Gedmo\Mapping\Annotation as Gedmo;
// Validator
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Usager
 *
 * @ORM\Table(name="usager")
 * @ORM\Entity(repositoryClass="biero\visiteurBundle\Repository\UsagerRepository")
 */
class Usager
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
     * @ORM\Column(name="courriel", type="string", length=255)
     * @Assert\Email(
     *     message = "Cet email : '{{ value }}' n'est pas valide"
     * )
     */
    private $courriel;


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
     * Set courriel
     *
     * @param string $courriel
     * @return Usager
     */
    public function setCourriel($courriel)
    {
        $this->courriel = $courriel;

        return $this;
    }

    /**
     * Get courriel
     *
     * @return string 
     */
    public function getCourriel()
    {
        return $this->courriel;
    }
}
