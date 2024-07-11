<?php
namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User; // Make sure to import the User entity

class ProductControllerTest extends WebTestCase
{
    private function getJwtToken(UserInterface $user): string
    {
        self::bootKernel();
        $container = self::$kernel->getContainer();

        /** @var JWTTokenManagerInterface $jwtManager */
        $jwtManager = $container->get('lexik_jwt_authentication.jwt_manager');

        return $jwtManager->create($user);
    }

    public function testCreate()
    {
     	$client = static::createClient();

        // Fetch the user from the database
        $userRepository = self::$container->get(EntityManagerInterface::class)->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => 'amjad@gmail.com']); // Adjust as necessary

        // Generate JWT token
        $token = $this->getJwtToken($user);

        // Add the token to the request headers
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $token));

        $client->request(
            'POST',
            '/api/products',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'name' => 'Test Product',
                'description' => 'This is a test product.',
                'price' => '99.99'
            ])
        );
        
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $data = json_decode($client->getResponse()->getContent(), true);
        // Perform assertions
        $this->assertTrue(true);
       echo $data['message'];
    }
}
