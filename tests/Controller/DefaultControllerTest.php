<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Tests\NeedLogin;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    use NeedLogin;

    public function testIndexAction()
    {
        $client = static::createClient();

        $client->request('GET', '/');
        $this->assertResponseRedirects('');

    }

    public function testIndexActionLoggedAsUser()
    {
        
        self::bootKernel();
        $user = self::getContainer()->get(UserRepository::class)->findOneBy(['username' => 'userdemo']);
        self::ensureKernelShutdown();

        $client = static::createClient();

        $this->loginUser($client, $user);
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Bienvenue sur Todo List');
    }

    public function testIndexActionLoggedAsAdmin()
    {
        self::bootKernel();
        $user = self::getContainer()->get(UserRepository::class)->findOneBy(['username' => 'admin']);
        self::ensureKernelShutdown();

        $crawler = $client = static::createClient();

        $this->loginUser($client, $user);
        $crawler = $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Bienvenue sur Todo List');
        $this->assertSame(1, $crawler->filter('html:contains("Créer un utilisateur")')->count());
    }
}