<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KorisnikRoles
 *
 * @ORM\Table(name="korisnik_roles")
 * @ORM\Entity
 */
class KorisnikRoles
{
    /**
     * @var int
     *
     * @ORM\Column(name="korisnik_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $korisnikId;

    /**
     * @var int
     *
     * @ORM\Column(name="role_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $roleId;


}
