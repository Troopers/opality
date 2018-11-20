<?php

namespace App\Controller\API;

use App\Repository\CoreValueRepository;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class APICoreValueController extends AbstractController
{
    /**
     * @Route("/api/objectives/filterByObjectiveUsersOrTeams", name="api_coreValue_filterByObjectiveUsersOrTeams", options={"expose"=true})
     */
    public function filterByObjectiveUsersOrTeams(Request $request, CoreValueRepository $coreValueRepository)
    {
        $coreValues = $coreValueRepository
            ->joinObjectives()
            ->joinUsers()
            ->joinTeams()
            ->filterByUsers($request->query->get('users', []))
            ->filterByTeams($request->query->get('teams', []))
            ->run('getResult', Query::HYDRATE_ARRAY);

        return new JsonResponse($coreValues);
    }
}
