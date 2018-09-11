<?php

namespace App\Security;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\PathUserResponse;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUserProvider;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\VarDumper\VarDumper;

class GitlabUserProvider extends OAuthUserProvider
{
    private $userRepository;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository, $publicDir)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->publicDir = $publicDir;
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
            $user->setFirstname($response->getData()['name']);
            $filename = sprintf("/uploads/%s.jpeg", $response->getData()['username']);
            file_put_contents($this->publicDir.$filename, fopen($response->getData()['avatar_url'], 'r'));
            $user->setPicture($filename);
            $user->setEnabled(true);
            $user->setPassword('---gitlab-oauth---');
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }

        return $user;
    }
}
