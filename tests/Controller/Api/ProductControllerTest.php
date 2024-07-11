<?php
namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

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
    
    public function testIndex()
    {
        $client = static::createClient();
        // Fetch the user from the database
        $userRepository = self::$container->get(EntityManagerInterface::class)->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => 'amjad@gmail.com']); //Adjust as necessary
        //Generate JWT token
        $token = $this->getJwtToken($user);
        // Add the token to the request headers
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $token));
        $client->request('GET', '/api/products');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $data = json_decode($client->getResponse()->getContent(), true);
        echo "Test-Case-1:".$data['message'];
        $this->assertTrue(true);
        print_r($data);
    }

    public function testShow()
    {
        $client = static::createClient();
        // Fetch the user from the database
        $userRepository = self::$container->get(EntityManagerInterface::class)->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => 'amjad@gmail.com']); // Adjust as necessary
        // Generate JWT token
        $token = $this->getJwtToken($user);
        // Add the token to the request headers
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $token));
        $client->request('GET', '/api/products/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $data = json_decode($client->getResponse()->getContent(), true);
        echo "Test-Case-2:".$data['message'];
        $this->assertTrue(true);
        print_r($data);
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
                'name' => 'Latest Test Product',
                'description' => 'This is a test product.',
                'price' => '199.99'
            ])
        );
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertTrue(true);
       echo "Test-Case-3:".$data['message'];
       print_r($data);
    }
    public function testUpdate()
    {
        $client = static::createClient();
        // Fetch the user from the database
        $userRepository = self::$container->get(EntityManagerInterface::class)->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => 'amjad@gmail.com']); // Adjust as necessary
        // Generate JWT token
        $token = $this->getJwtToken($user);
        // Add the token to the request headers
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $token));
        $client->request('PUT', '/api/products/1', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Updated Product',
            'description' => 'Updated Description',
            'price' => '150.0',
        ]));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertTrue(true);
        echo "Test-Case-4:".$data['message'];
        print_r($data);
    }
    public function testDelete()
    {
        $client = static::createClient();
        // Fetch the user from the database
        $userRepository = self::$container->get(EntityManagerInterface::class)->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => 'amjad@gmail.com']); // Adjust as necessary
        // Generate JWT token
        $token = $this->getJwtToken($user);
        // Add the token to the request headers
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $token));
        $client->request('DELETE', '/api/products/13');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue(true);
       echo "Test-Case-5:Product deleted successfully.";
}
}
