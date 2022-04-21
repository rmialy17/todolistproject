<?php

namespace App\Tests\Controller;

use Exception;

use App\Entity\User;
use App\Tests\NeedLogin;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class SecurityControllerTest extends WebTestCase
{
    use NeedLogin;

    public function setUp(): void
    {
        $this->client = static::createClient();
        $this->em = $this->client->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testDisplayLogin()
    {
        $this->client->request('GET', '/login');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1', 'Connectez-vous');
        $this->assertSelectorNotExists('.alert.alert-danger');
    }

    public function testLoginWithBadCredentials()
    {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Se connecter')->form([
            '_username' => 'demo',
            '_password' => 'fakepassword'
        ]);
        $this->client->submit($form);
        $this->assertResponseRedirects();
        $this->client->followRedirect();
        $this->assertSelectorExists('.alert.alert-danger');
    }

    public function testSuccessfullLogin()
    {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Se connecter')->form([
            '_username' => 'userdemo',
            '_password' => '#Demo0000'
        ]);
        $this->client->submit($form);
        $this->assertResponseRedirects();
        $this->client->followRedirect();
        $this->assertSelectorNotExists('.alert.alert-danger');
    }

    // public function testAlreadyLogged(){
    //     $user = $this->em->getRepository(User::class)->findOneBy(["username" => "userdemo"]);
    //     $this->loginUser($this->client, $user);
    //     $this->client->request('GET', '/login');
    //     $this->assertResponseRedirects();
    // }
}