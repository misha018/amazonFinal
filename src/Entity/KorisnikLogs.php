<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * KorisnikLogs
 *
 * @ORM\Table(name="korisnik_logs")
 * @ORM\Entity
 */
class KorisnikLogs
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
     * @var string
     *
     * @ORM\Column(name="action", type="text", length=65535, nullable=false)
     */
    private $action;

    /**
     * @var string
     *
     * @ORM\Column(name="artikl", type="string", length=50, nullable=false)
     */
    private $artikl;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    public function __construct($action, $artikl, Korisnikk $user, $createdAt) {
        $this->action = $action;
        $this->artikl = $artikl;
        $this->users = new ArrayCollection([$user]);;
        $this->created = $created;
    }

    // geteri
    public function getAction(){
        return $this->action;
    }

    public function getArtikl(){
        return $this->artikl;
    }

    public function getKorisnikk(){
        return $this->users->toArray();
    }

    public function getCreated(){
        return $this->created;
    }

    public function getId(){
        return $this->id;
    }    

}
