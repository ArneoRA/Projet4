<?php

namespace Louvre\BookingBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
// Permet d'ajouter des insertions (contraintes)
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reservation
 *
 * @ORM\Table(name="Reservation")
 * @ORM\Entity(repositoryClass="Louvre\BookingBundle\Repository\ReservationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Reservation
{
    /**
     * Initialisation d'un constante pour gérer le nombre maximum de billets disponible pour 1 journée
     */
    const BILLET_MAX = 5;

    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="Code_Reservation", type="string", length=10)
     */
    private $codeReservation;

    /**
     * @var \DateTime
     * @ORM\Column(name="Date_Reservation", type="date")
     */
    private $dateReservation;

    /**
     * @var bool
     * @ORM\Column(name="Type_Reservation", type="boolean")
     */
    private $typeReservation;

    /**
     * @var int
     * @ORM\Column(name="Nbre_Places", type="smallint")
     */
    private $nbrePlaces;

    /**
     * @var string
     * @ORM\Column(name="Email_client", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email(message = "Cet email : {{value}} n'est pas une adresse mail valide", checkMX = true)
     */
    private $emailClient;

    /**
     * @var string
     * @ORM\Column(name="Montant_Reservation", type="decimal", precision=2, scale=0)
     */
    private $montantReservation;

    /**
     * @var \DateTime
     * @ORM\Column(name="Date_Visite", type="date")
     */
    private $dateVisite;

    /**
     * @var boolean
     * @ORM\column(name="valided", type="boolean")
     */
    private $valided;

    /**
     * @ORM\OneToMany (targetEntity="DetailReservation", mappedBy="reservation", cascade={"persist"})
     */
    private $details;

    /**
     * Reservation constructor.
     */

    public function __construct()
    {
        $this->dateReservation = new \DateTime();
        $this->dateVisite = new \DateTime();
        $this->typeReservation = 1;
        $this->codeReservation = $this->aleatoire(10);
        $this->montantReservation = 0;
        $this->details = new ArrayCollection();
        $this->valided = 0;

     }

    /**
     * @param $car
     * Génére un code réservation composé de lettres et de chiffres d'une maniere aléatoire
     * @return string
     */
    protected function aleatoire($car) {
        $string = "";
        $chaine = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        srand((double)microtime()*1000000);
        for($i=0; $i<$car; $i++) {
            $string .= $chaine[rand()%strlen($chaine)];
        }
        return $string;
    }


    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set codeReservation
     * @param string $codeReservation
     * @return Reservation
     */
    public function setCodeReservation($codeReservation)
    {
        $this->codeReservation = $codeReservation;
        return $this;
    }

    /**
     * Get codeReservation
     * @return string
     */
    public function getCodeReservation()
    {
        return $this->codeReservation;
    }

    /**
     * Set dateReservation
     * @param \DateTime $dateReservation
     * @return Reservation
     */
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;
        return $this;
    }

    /**
     * Get dateReservation
     * @return \DateTime
     */
    public function getDateReservation()
    {
        return $this->dateReservation;
    }

    /**
     * Set typeReservation
     * @param boolean $typeReservation
     * @return Reservation
     */
    public function setTypeReservation($typeReservation)
    {
        $this->typeReservation = $typeReservation;
        return $this;
    }

    /**
     * Get typeReservation
     * @return bool
     */
    public function getTypeReservation()
    {
        return $this->typeReservation;
    }

    /**
     * Set nbrePlaces
     * @param integer $nbrePlaces
     * @return Reservation
     */
    public function setNbrePlaces($nbrePlaces)
    {
        $this->nbrePlaces = $nbrePlaces;
        return $this;
    }

    /**
     * Get nbrePlaces
     * @return int
     */
    public function getNbrePlaces()
    {
        return $this->nbrePlaces;
    }

    /**
     * Set emailClient
     * @param string $emailClient
     * @return Reservation
     */
    public function setEmailClient($emailClient)
    {
        $this->emailClient = $emailClient;
        return $this;
    }

    /**
     * Get emailClient
     * @return string
     */
    public function getEmailClient()
    {
        return $this->emailClient;
    }

    /**
     * Set montantReservation
     * @param string $montantReservation
     * @return Reservation
     */
    public function setMontantReservation($montantReservation)
    {
        $this->montantReservation = $montantReservation;
        return $this;
    }

    /**
     * Get montantReservation
     * @return string
     */
    public function getMontantReservation()
    {
        return $this->montantReservation;
    }

    /**
     * Set dateVisite
     * @param \DateTime $dateVisite
     * @return Reservation
     */
    public function setDateVisite($dateVisite)
    {
        $this->dateVisite = $dateVisite;
        return $this;
    }

    /**
     * Get dateVisite
     * @return \DateTime
     */
    public function getDateVisite()
    {
        return $this->dateVisite;
    }


    /**
     * Add detail
     * @param \Louvre\BookingBundle\Entity\DetailReservation $detail
     * @return Reservation
     */
    public function addDetail(\Louvre\BookingBundle\Entity\DetailReservation $detail)
    {
        $this->details[] = $detail;
        return $this;
    }

    /**
     * Remove detail
     * @param \Louvre\BookingBundle\Entity\DetailReservation $detail
     */
    public function removeDetail(\Louvre\BookingBundle\Entity\DetailReservation $detail)
    {
        $this->details->removeElement($detail);
    }

    /**
     * Get details
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDetails()
    {
        return $this->details;
    }


    /**
     * Set valided
     *
     * @param boolean $valided
     *
     * @return Reservation
     */
    public function setValided($valided)
    {
        $this->valided = $valided;

        return $this;
    }

    /**
     * Get valided
     *
     * @return boolean
     */
    public function getValided()
    {
        return $this->valided;
    }
}
