<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KorisnikHasLogs
 *
 * @ORM\Table(name="korisnik_has_logs")
 * @ORM\Entity
 */
class KorisnikHasLogs
{
    /**
     * @var int
     *
     * @ORM\Column(name="log_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $logId;

    /**
     * @var int
     *
     * @ORM\Column(name="korisnik_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $korisnikId;


}
