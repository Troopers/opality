<?php

namespace App\Controller;

use App\Entity\Responsibility;
use App\Repository\ResponsibilityRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/responsibility")
 */
class ResponsibilityController extends AbstractController
{
    /**
     * @Route("/", name="responsibility")
     */
    public function index(UserRepository $userRepository, ResponsibilityRepository $responsibilityRepository)
    {
        $users = $userRepository->getAll()->joinResponsibilities()->run();
        $responsibilities = new ArrayCollection($responsibilityRepository->findWithInvolvements());
        $responsibilitiesWithoutLeadership = $responsibilities->filter(function (Responsibility $responsibility) {
            return $responsibility->getLeaderInvolvements()->count() === 0;
        });
        $responsibilitiesWithoutAdvisors = $responsibilities->filter(function (Responsibility $responsibility) {
            return $responsibility->getAdvisorInvolvements()->count() === 0;
        });
        //get

        return $this->render('responsibility/index.html.twig', [
            'users' => $users,
            'responsibilities' => $responsibilities,
            'responsibilitiesWithoutLeadership' => $responsibilitiesWithoutLeadership,
            'responsibilitiesWithoutAdvisors' => $responsibilitiesWithoutAdvisors,
        ]);
    }
}
