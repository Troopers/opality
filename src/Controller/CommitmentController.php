<?php

namespace App\Controller;

use App\Repository\CoreValueRepository;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commitments")
 */
class CommitmentController extends AbstractController
{
    /**
     * @Route("/", name="commitment_index")
     * @param Request $request
     * @param CoreValueRepository $coreValueRepository
     * @param UserRepository $userRepository
     * @param TeamRepository $teamRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, CoreValueRepository $coreValueRepository, UserRepository $userRepository, TeamRepository $teamRepository)
    {
        $coreValueRepository
            ->getAll()
            ->joinCommitments()
            ->joinObjectives()
            ->joinUsers()
            ->joinTeams();

        if ($request->query->has('me')) {
            $coreValueRepository->filterByUsers([$this->getUser()]);
        } else if ($request->query->get('user', false)) {
            $coreValueRepository->filterByUsers([$request->query->get('user')]);
        } else if ($request->query->get('team', false)) {
            $coreValueRepository->filterByTeams([$request->query->get('team')]);
        }

        $coreValues = $coreValueRepository->run('getResult', Query::HYDRATE_ARRAY);

        return $this->render('commitment/index.html.twig', [
            'coreValues' => $coreValues,
            'users' => $userRepository->getAll()->run('getResult', Query::HYDRATE_ARRAY),
            'teams' => $teamRepository->getAll()->run('getResult', Query::HYDRATE_ARRAY),
        ]);
    }
}
