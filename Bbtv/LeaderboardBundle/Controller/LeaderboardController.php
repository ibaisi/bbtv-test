<?php

namespace Bbtv\LeaderboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class LeaderboardController extends Controller
{
    public function leaderboardAction()
    {
        $leaderboardService = $this->container->get('leaderboard');

        $response = new Response($leaderboardService->leaderboard());
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    public function addPointsToParticipantAction($participantId, $points)
    {
        $leaderboardService = $this->container->get('leaderboard');

        $response = new Response($leaderboardService->addPointsToParticipant($participantId, $points));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    public function addParticipantAction($participantName)
    {
        $leaderboardService = $this->container->get('leaderboard');

        $response = new Response($leaderboardService->addParticipant($participantName));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}
