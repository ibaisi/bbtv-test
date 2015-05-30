<?php

namespace Bbtv\LeaderboardBundle\Services;

use Bbtv\LeaderboardBundle\Entity\Participant;
use Doctrine\ORM\EntityManager;

class LeaderboardService
{
    protected $em;
    protected $serializer;

    /**
     * @param EntityManager $entityManager
     * @param $serializer
     */
    public function __construct(EntityManager $entityManager, $serializer)
    {
        $this->em = $entityManager;
        $this->serializer = $serializer;
    }

    /**
     * @return mixed
     */
    public function leaderboard()
    {
        $participants = $this->em->getRepository('BbtvLeaderboardBundle:Participant')->findBy([],['score' => 'DESC']);

        $serializedParticipants = $this->serializer->serialize($participants, 'json');

        return $serializedParticipants;
    }

    /**
     * @param Integer $id
     * @param Integer $points
     *
     * @return mixed
     */
    public function addPointsToParticipant($id, $points)
    {
        $participant = $this->em->getRepository('BbtvLeaderboardBundle:Participant')->findOneById($id);
        $participant->incrementScore($points);

        $this->em->persist($participant);
        $this->em->flush();

        return $this->leaderboard();
    }

    /**
     * @param String $name
     *
     * @return mixed
     */
    public function addParticipant($name)
    {
        $participant = new Participant($name);

        $this->em->persist($participant);
        $this->em->flush();

        return $this->leaderboard();
    }
}