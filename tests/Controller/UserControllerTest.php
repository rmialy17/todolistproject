<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Tests\NeedLogin;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class UserControllerTest extends WebTestCase{

    use NeedLogin;

    public function setUp(): void
    {
        $this->client = static::createClient();

        $this->em = $this->client->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testListUserIsRedirectedWhenNotConnected()
    {
        $this->client->request('GET', '/users');
        $this->assertResponseRedirects();
    }

    public function testListUserIsForbiddenWhenNotAdmin()
    {
        $user = $this->em->getRepository(User::class)->findOneBy(["username" => "userdemo"]);
        $this->loginUser($this->client, $user);

        $this->client->request('GET', '/users');
        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    public function testListUserAccessForAdmin()
    {
        $user = $this->em->getRepository(User::class)->findOneBy(["username" => "admin"]);
        $this->loginUser($this->client, $user);

        $this->client->request('GET', '/users');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testNewUserIsRedirected()
    {
        $this->client->request('GET', '/users/create');
        $this->assertResponseRedirects();
    }

    public function testEditUserIsRedirected()
    {
        $this->client->request('GET', '/users/1/edit');
        $this->assertResponseRedirects();
    }
    
    public function testLetAuthenticatedUserAdminAccessNewUser()
    {
        $user = $this->em->getRepository(User::class)->findOneBy(["username" => "admin"]);
        $this->loginUser($this->client, $user);

        $this->client->request('GET', '/users/create');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    
    public function testLetAuthenticatedUserAdminAccessEditUser()
    {
        $user = $this->em->getRepository(User::class)->findOneBy(["username" => "admin"]);
        $this->loginUser($this->client, $user);

        $this->client->request('GET', '/users/1/edit');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    
    public function testNewUser(){
        $user = $this->em->getRepository(User::class)->findOneBy(["username" => "admin"]);
        $this->loginUser($this->client, $user);

        $crawler = $this->client->request("GET", "/users/create");
        $form = $crawler->selectButton("Ajouter")->form();
        $form['registration_form[username]'] = 'newadmin';
        $form['registration_form[email]'] = 'newadmin@gmail.com';
        $form['registration_form[password][first]'] = '#Newadmin1234';
        $form['registration_form[password][second]']  = '#Newadmin1234';
        $form['registration_form[role]'] = 'ROLE_ADMIN';

        $this->client->submit($form);
        // Before
         $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        // After
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Créer un utilisateur');
    }
    
    public function testEditUser(){
        $user = $this->em->getRepository(User::class)->findOneBy(["username" => "admin"]);
        $this->loginUser($this->client, $user);

        $crawler = $this->client->request("GET", "/users/1/edit");
        $form = $crawler->selectButton("Modifier")->form();
        $form['registration_form[username]'] = 'admin';
        $form['registration_form[email]'] = 'admin@gmail.com';
        $form['registration_form[password][first]'] = '#Demo00000';
        $form['registration_form[password][second]']  = '#Demo00000';
        $form['registration_form[role]'] = 'ROLE_ADMIN';

        $this->client->submit($form);
        $this->assertResponseRedirects();
        $this->client->followRedirect();
        $this->assertSelectorTextContains('h1', 'Liste des utilisateurs');
    }


}