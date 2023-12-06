<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artikl
 *
 * @ORM\Table(name="artikl")
 * @ORM\Entity
 */
class Artikl
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="cena", type="integer", nullable=false)
     */
    private $cena;

    /**
     * @var int
     *
     * @ORM\Column(name="kolicina", type="integer", nullable=false)
     */
    private $kolicina;

    /**
     * @var string
     *
     * @ORM\Column(name="ime", type="string", length=30, nullable=false)
     */
    private $ime;

    /**
     * @var string
     *
     * @ORM\Column(name="opis_proizvoda", type="text", length=65535, nullable=false)
     */
    private $opisProizvoda;

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of cena
     *
     * @return int
     */
    public function getCena()
    {
        return $this->cena;
    }

    /**
     * Set the value of cena
     *
     * @param int $cena
     * @return self
     */
    public function setCena($cena)
    {
        $this->cena = $cena;
        return $this;
    }

    /**
     * Get the value of kolicina
     *
     * @return int
     */
    public function getKolicina()
    {
        return $this->kolicina;
    }

    /**
     * Set the value of kolicina
     *
     * @param int $kolicina
     * @return self
     */
    public function setKolicina($kolicina)
    {
        $this->kolicina = $kolicina;
        return $this;
    }

    /**
     * Get the value of ime
     *
     * @return string
     */
    public function getIme()
    {
        return $this->ime;
    }

    /**
     * Set the value of ime
     *
     * @param string $ime
     * @return self
     */
    public function setIme($ime)
    {
        $this->ime = $ime;
        return $this;
    }

    /**
     * Get the value of opisProizvoda
     *
     * @return string
     */
    public function getOpisProizvoda()
    {
        return $this->opisProizvoda;
    }

    /**
     * Set the value of opisProizvoda
     *
     * @param string $opisProizvoda
     * @return self
     */
    public function setOpisProizvoda($opisProizvoda)
    {
        $this->opisProizvoda = $opisProizvoda;
        return $this;
    }
}
