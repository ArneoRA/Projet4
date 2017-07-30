<?php

namespace Louvre\BookingBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * DetailReservation
 *
 * @ORM\Table(name="detail_reservation")
 * @ORM\Entity(repositoryClass="Louvre\BookingBundle\Repository\DetailReservationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class DetailReservation
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
     * @ORM\Column(name="Nom_Visiteur", type="string", length=255)
     */
    private $nomVisiteur;

    /**
     * @var string
     * @ORM\Column(name="Prenom_Visiteur", type="string", length=255)
     */
    private $prenomVisiteur;

    /**
     * @var string
     * @ORM\Column(name="Pays_Visiteur", type="string", length=255)
     */
    private $paysVisiteur;

    /**
     * @var \DateTime
     * @ORM\Column(name="Date_Naissance", type="date")
     */
    private $dateNaissance;

    /**
     * @var boolean
     * @ORM\Column(name="Tarif_Reduit", type="boolean")
     */
    private $tarifReduit;

    /**
     * @var integer
     * @ORM\Column(name="Tarif_Visiteur", type="integer")
     */
    private $tarifvisiteur = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Reservation", inversedBy="details", cascade={"persist"})
     * @ORM\JoinColumn(name="idresa", referencedColumnName="id")
     */
    private $reservation;

    /**
     * @ORM\Column(name="idresa", type="integer", nullable=true)
     */
    private $idResa = 0;

    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomVisiteur
     * @param string $nomVisiteur
     * @return DetailReservation
     */
    public function setNomVisiteur($nomVisiteur)
    {
        $this->nomVisiteur = $nomVisiteur;
        return $this;
    }

    /**
     * Get nomVisiteur
     * @return string
     */
    public function getNomVisiteur()
    {
        return $this->nomVisiteur;
    }

    /**
     * Set prenomVisiteur
     * @param string $prenomVisiteur
     * @return DetailReservation
     */
    public function setPrenomVisiteur($prenomVisiteur=0)
    {
        $this->prenomVisiteur = $prenomVisiteur;
        return $this;
    }

    /**
     * Get prenomVisiteur
     * @return string
     */
    public function getPrenomVisiteur()
    {
        return $this->prenomVisiteur;
    }

    /**
     * Set dateNaissance
     * @param \DateTime $dateNaissance
     * @return DetailReservation
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
        return $this;
    }

    /**
     * Get dateNaissance
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set tarifVisiteur
     * @param string $tarifReduit
     * @return DetailReservation
     */
    public function setTarifReduit($tarifReduit)
    {
        $this->tarifReduit = $tarifReduit;
        return $this;
    }

    /**
     * Get tarifReduit
     * @return string
     */
    public function getTarifReduit()
    {
        return $this->tarifReduit;
    }

    /**
     * Set tarifvisiteur
     * @param integer $tarifvisiteur
     * @return DetailReservation
     */
    public function setTarifvisiteur($tarifvisiteur)
    {
        $this->tarifvisiteur = $tarifvisiteur;

        return $this;
    }

    /**
     * Get tarifvisiteur
     * @return integer
     */
    public function getTarifvisiteur()
    {
        return $this->tarifvisiteur;
    }

    /**
     * Set paysVisiteur
     * @param string $paysVisiteur
     * @return DetailReservation
     */
    public function setPaysVisiteur($paysVisiteur)
    {
        $this->paysVisiteur = $paysVisiteur;

        return $this;
    }

    /**
     * Get paysVisiteur
     * @return string
     */
    public function getPaysVisiteur()
    {
        return $this->paysVisiteur;
    }

    /**
     * Set reservation
     * @param \Louvre\BookingBundle\Entity\Reservation $reservation
     * @return DetailReservation
     */
    public function setReservation(\Louvre\BookingBundle\Entity\Reservation $reservation = null)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     * @return \Louvre\BookingBundle\Entity\Reservation
     */
    public function getReservation()
    {
        return $this->reservation;
    }


    /**
     * @return mixed
     */
    public function getIdResa()
    {
        return $this->idResa;
    }

    /**
     * @param mixed $idResa
     */
    public function setIdResa($idResa)
    {
        $this->idResa = $idResa;
    }



}
