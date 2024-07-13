<?php
namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    private $jwtManager;
    private $guardHandler;
    private $userProvider;

    public function __construct(
        JWTTokenManagerInterface $jwtManager,
        GuardAuthenticatorHandler $guardHandler,
        UserProviderInterface $userProvider
    ) {
        $this->jwtManager = $jwtManager;
        $this->guardHandler = $guardHandler;
        $this->userProvider = $userProvider;
    }

    /**
     * @Route("/api/login", name="api_login", methods={"POST"})
     */
    public function login(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        try {
            $user = $this->userProvider->loadUserByUsername($email);
        } catch (AuthenticationException $e) {
            return $this->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }

        if (!$this->isPasswordValid($user, $password)) {
            return $this->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }

        $token = $this->jwtManager->create($user);

        return $this->json(['token' => $token]);
    }

    private function isPasswordValid($user, $password)
    {
        return $this->get('security.password_encoder')->isPasswordValid($user, $password);
    }
}


