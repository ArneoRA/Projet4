<?php

namespace Louvre\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DetailReservation
 *
 * @ORM\Table(name="detail_reservation")
 * @ORM\Entity(repositoryClass="Louvre\BookingBundle\Repository\DetailReservationRepository")
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
     *
     * @ORM\Column(name="Nom_Visiteur", type="string", length=255)
     */
    private $nomVisiteur;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom_Visiteur", type="string", length=255)
     */
    private $prenomVisiteur;

    /**
     * @var string
     *
     * @ORM\Column(name="Pays_Visiteur", type="string", length=255)
     */
    private $paysVisiteur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Naissance", type="date")
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="Tarif_Visiteur", type="decimal", precision=2, scale=0)
     */
    private $tarifVisiteur;

    /**
     * @ORM\ManyToOne(targetEntity="Louvre\BookingBundle\Entity\Reservation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reservation;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomVisiteur
     *
     * @param string $nomVisiteur
     *
     * @return DetailReservation
     */
    public function setNomVisiteur($nomVisiteur)
    {
        $this->nomVisiteur = $nomVisiteur;

        return $this;
    }

    /**
     * Get nomVisiteur
     *
     * @return string
     */
    public function getNomVisiteur()
    {
        return $this->nomVisiteur;
    }

    /**
     * Set prenomVisiteur
     *
     * @param string $prenomVisiteur
     *
     * @return DetailReservation
     */
    public function setPrenomVisiteur($prenomVisiteur)
    {
        $this->prenomVisiteur = $prenomVisiteur;

        return $this;
    }

    /**
     * Get prenomVisiteur
     *
     * @return string
     */
    public function getPrenomVisiteur()
    {
        return $this->prenomVisiteur;
    }

    /**
     * Set paysVisiteur
     *
     * @param string $paysVisiteur
     *
     * @return DetailReservation
     */
    public function setPaysVisiteur($paysVisiteur)
    {
        $this->paysVisiteur = $paysVisiteur;

        return $this;
    }

    /**
     * Get paysVisiteur
     *
     * @return string
     */
    public function getPaysVisiteur()
    {
        return $this->paysVisiteur;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return DetailReservation
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set tarifVisiteur
     *
     * @param string $tarifVisiteur
     *
     * @return DetailReservation
     */
    public function setTarifVisiteur($tarifVisiteur)
    {
        $this->tarifVisiteur = $tarifVisiteur;

        return $this;
    }

    /**
     * Get tarifVisiteur
     *
     * @return string
     */
    public function getTarifVisiteur()
    {
        return $this->tarifVisiteur;
    }

    /**
     * Set reservation
     *
     * @param \Louvre\BookingBundle\Entity\Reservation $reservation
     *
     * @return DetailReservation
     */
    public function setReservation(\Louvre\BookingBundle\Entity\Reservation $reservation)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \Louvre\BookingBundle\Entity\Reservation
     */
    public function getReservation()
    {
        return $this->reservation;
    }
}
