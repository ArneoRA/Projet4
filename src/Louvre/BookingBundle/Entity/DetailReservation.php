<?php

namespace Louvre\BookingBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
// Permet d'ajouter des insertions (contraintes)
use Symfony\Component\Validator\Constraints as Assert;

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
     * Set paysVisiteur
     *
     * @param Pays $paysVisiteur
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
     * @return \Louvre\BookingBundle\Entity\Pays
     */
    public function getPaysVisiteur()
    {
        return $this->paysVisiteur;
    }
}
