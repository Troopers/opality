<?php

namespace App\Controller;

use App\Repository\CoreValueRepository;
use App\Repository\ResponsibilityRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class GoalController extends AbstractController
{
    /**
     * @Route("/", name="goal")
     */
    public function index(CoreValueRepository $coreValueRepository)
    {
        $coreValues = $coreValueRepository->findAll();

        return $this->render('goal/index.html.twig', [
            'coreValues' => $coreValues
        ]);
    }
}
