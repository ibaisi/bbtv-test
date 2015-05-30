<?php
namespace Bbtv\LeaderboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="participant")
 */
class Participant
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;
    /**
     * @ORM\Column(type="integer")
     */
    protected $score;

    public function __construct($name) {
        $this->name = $name;
        $this->score = 0;
    }

    /**
     * @param String $aNewName
     */
    public function changeName($aNewName)
    {
        $this->name = $aNewName;
    }

    /**
     * @param Integer $pointsToIncrement
     */
    public function incrementScore($pointsToIncrement)
    {
        $this->score += $pointsToIncrement;
    }
}