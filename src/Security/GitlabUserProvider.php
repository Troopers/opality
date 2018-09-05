<?php

namespace App\Security;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\PathUserResponse;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUserProvider;
use Symfony\Component\VarDumper\VarDumper;

class GitlabUserProvider extends OAuthUserProvider
{
    private $userRepository;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        return $this->userRepository->findOneBy(['email' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        /** @var PathUserResponse $response */
        $email = $response->getData()['email'];
        $user = $this->userRepository->findOneBy(['email' => $email]);
        if (null === $user) {
            $user = new User();
            $user->setEmail($email);
            $user->setEnabled(true);
            $user->setPassword('---gitlab-oauth---');
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }

        return $user;
    }
}
