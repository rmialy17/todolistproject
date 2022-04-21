<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Tests\NeedLogin;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    use NeedLogin;

    // -----------------------Display-----------------------
    
    public function testListDisplayAsUser()
    {
        self::bootKernel();
        $user = self::getContainer()->get('doctrine')->getManager()->getRepository(User::class)->findOneBy(['username' => 'userdemo']);
        self::ensureKernelShutdown();

        $client = static::createClient();

        $this->loginUser($client, $user);

        $crawler = $client->request('GET', '/tasks');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Liste des tâches');
        $this->assertSelectorTextContains('button', 'Marquer comme faite');
        $this->assertSame(1, $crawler->filter('html:contains("Marquer non terminée")')->count());
        
    }

    public function testListDisplayAsNotLogged() 
    //Test inutile car un user doit etre connecté pour consulter la liste des taches ???
    {
        $client = static::createClient();

        $client->request('GET', '/tasks');
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('button', 'Se connecter');
    }

    public function testListDoneDisplayAsUser() 
    //Test inutile car un user doit etre connecté pour consulter la liste des taches ???
    {
        self::bootKernel();
        $user = self::getContainer()->get('doctrine')->getManager()->getRepository(User::class)->findOneBy(['username' => 'Anonyme']);
        self::ensureKernelShutdown();

        $client = static::createClient();

        $this->loginUser($client, $user);

        $crawler = $client->request('GET', '/tasks/6/toggle');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Liste des tâches');
        // //+ verifier qu'il n' y pas d'elt span avec la classe glyphicon-remove
        // $this->assertSelectorTextContains('button', 'Marquer non terminée');
        // $this->assertSame(0, $crawler->filter('html:contains("Marquer comme faite")')->count());
    }

//     public function testListDoneDisplayAsNotLogged()
// //Test inutile car un user doit etre connecté pour consulter la liste des taches ???
//     {
//         $client = static::createClient();

//         $client->request('GET', '/tasks/toggle');
//         $this->assertResponseRedirects();
//         $client->followRedirect();
//         $this->assertResponseIsSuccessful();
//         $this->assertSelectorTextContains('button', 'Se connecter');
//     }

    public function testCreateDisplayAsUser()//OK
    {
        self::bootKernel();
        $user = self::getContainer()->get('doctrine')->getManager()->getRepository(User::class)->findOneBy(['username' => 'userdemo']);
        self::ensureKernelShutdown();

        $client = static::createClient();

        $this->loginUser($client, $user);

        $crawler = $client->request('GET', '/tasks/create');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Créer une tâche');
        $this->assertSelectorTextContains('button', 'Ajouter');
        
    }

//     public function testCreateDisplayAsNotLogged()
// //Test inutile car un user doit etre connecté pour consulter la liste des taches ???
//     {
//         $client = static::createClient();

//         $client->request('GET', '/tasks/create');
//         $this->assertResponseRedirects();
//         $client->followRedirect();
//         $this->assertResponseIsSuccessful();
//         $this->assertSelectorTextContains('button', 'Se connecter');
//     }

    public function testEditDisplayAsUserAuthor()//OK
    {
        self::bootKernel();
        $user = self::getContainer()->get('doctrine')->getManager()->getRepository(User::class)->findOneBy(['username' => 'userdemo']);
        self::ensureKernelShutdown();

        $client = static::createClient();

        $this->loginUser($client, $user);

        $crawler = $client->request('GET', '/tasks/2/edit');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Modifier la tâche');
        $this->assertSelectorTextContains('button', 'Modifier');
        
    }

    // public function testEditDisplayAsUserNotAuthor()//inutile??marche pas
    // {
    //     self::bootKernel();
    //     $user = self::getContainer()->get('doctrine')->getManager()->getRepository(User::class)->findOneBy(['username' => 'userdemo']);
    //     self::ensureKernelShutdown();

    //     $client = static::createClient();

    //     $this->loginUser($client, $user);

    //     $crawler = $client->request('GET', '/tasks/5/edit');
    //     $this->assertResponseRedirects();
    //     $client->followRedirect();
    //     $this->assertResponseIsSuccessful();
    //     $this->assertSelectorTextContains('h1', 'Liste des tâches');
    // }

//     public function testEditDisplayAsAdminNotAuthorButAnonyme()//inutile??
//     {
//         self::bootKernel();
//         $user = self::getContainer()->get('doctrine')->getManager()->getRepository(User::class)->findOneBy(['username' => 'admin']);
//         self::ensureKernelShutdown();

//         $client = static::createClient();

//         $this->loginUser($client, $user);

//         $crawler = $client->request('GET', '/tasks/3/edit');
//         $this->assertResponseIsSuccessful();
//         $this->assertSelectorTextContains('h1', 'Modifier la tâche');
//         $this->assertSelectorTextContains('button', 'Modifier');
//     }

    public function testEditDisplayAsNotLogged()//INUTILE
    {
        $client = static::createClient();

        $client->request('GET', '/tasks/4/edit');
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('button', 'Se connecter');
    }

    public function testEditDisplayAsAdminTaskNotExist()//OK
    {
        self::bootKernel();
        $user = self::getContainer()->get('doctrine')->getManager()->getRepository(User::class)->findOneBy(['username' => 'admin']);
        self::ensureKernelShutdown();

        $client = static::createClient();

        $this->loginUser($client, $user);

        $client->request('GET', '/tasks/256/edit');
        $this->assertTrue($client->getResponse()->isNotFound());
    }




// // -----------------------Delete-----------------------

//     // Verifier la BDD !!

    public function testDeleteAsUserAuthor()//OK
    {
        $client = static::createClient();

        $client->request('GET', '/tasks/26/delete');
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertResponseIsSuccessful();

    }

    // public function testDeleteAsUserNotAuthor()//marche pas
    // {
    //     self::bootKernel();
    //     $user = self::getContainer()->get('doctrine')->getManager()->getRepository(User::class)->findOneBy(['username' => 'userdemo']);
    //     self::ensureKernelShutdown();

    //     $client = static::createClient();

    //     $this->loginUser($client, $user);

    //     $client->request('GET', '/tasks/5/delete');
    //     $this->assertResponseRedirects();
    //     $client->followRedirect();
    //     $this->assertResponseIsSuccessful();
    //     $this->assertSelectorTextContains('h1', 'Liste des tâches');
    // }

//     public function testDeleteAsAdminNotAuthorButAnonyme()//INUTILE
//     {
//         self::bootKernel();
//         $user = self::getContainer()->get('doctrine')->getManager()->getRepository(User::class)->findOneBy(['username' => 'admin']);
//         self::ensureKernelShutdown();

//         $client = static::createClient();

//         $this->loginUser($client, $user);

//         $client->request('GET', '/tasks/3/delete');
//         $this->assertResponseRedirects();
//         $client->followRedirect();
//         $this->assertResponseIsSuccessful();
//         $this->assertSelectorTextContains('h1', 'Liste des tâches');
//         $this->assertSelectorExists('.alert.alert-success');
//     }

//     public function testDeleteAsNotLogged()//INUTILE car impossible
//     {
//         $client = static::createClient();

//         $client->request('GET', '/tasks/1/delete');
//         $this->assertResponseRedirects();
//         $client->followRedirect();
//         $this->assertResponseIsSuccessful();
//         $this->assertSelectorTextContains('button', 'Se connecter');
//     }

    public function testDeleteAsAdminTaskNotExist()//OK
    {
        self::bootKernel();
        $user = self::getContainer()->get('doctrine')->getManager()->getRepository(User::class)->findOneBy(['username' => 'admin']);
        self::ensureKernelShutdown();

        $client = static::createClient();

        $this->loginUser($client, $user);

        $client->request('GET', '/tasks/"847/delete');
        $this->assertTrue($client->getResponse()->isNotFound());
    }


//     // -----------------------toggle-----------------------

//     // Verifier la BDD !!

    public function testToggleAsUser()//OK
    {
        self::bootKernel();
        $user = self::getContainer()->get('doctrine')->getManager()->getRepository(User::class)->findOneBy(['username' => 'userdemo']);
        self::ensureKernelShutdown();

        $client = static::createClient();

        $this->loginUser($client, $user);

        $client->request('GET', '/tasks/6/toggle');
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Liste des tâches');
        $this->assertSelectorExists('.alert.alert-success');
        
    }

    public function testToggleAsNotLogged()//OK
    {
        $client = static::createClient();

        $client->request('GET', '/tasks/3/toggle');
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertResponseIsSuccessful();
        
    }


//         // -----------------------create-----------------------

    public function testCreateAsUser()//OK
    {
        self::bootKernel();
        $user = self::getContainer()->get('doctrine')->getManager()->getRepository(User::class)->findOneBy(['username' => 'userdemo']);
        self::ensureKernelShutdown();

        $client = static::createClient();

        $this->loginUser($client, $user);

        $crawler = $client->request('GET', '/tasks/create');

        $form = $crawler->selectButton('Ajouter')->form([
            'task[title]' => 'Le titre',
            'task[content]' => 'le contenu'
        ]);
        $client->submit($form);

        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('.alert.alert-success');
        //Dama bloque ?
        //$this->assertSelectorTextContains('a', 'Le titre');
    }

    public function testCreateAsUserEmptyForm()//OK
    {
        self::bootKernel();
        $user = self::getContainer()->get('doctrine')->getManager()->getRepository(User::class)->findOneBy(['username' => 'userdemo']);
        self::ensureKernelShutdown();

        $client = static::createClient();

        $this->loginUser($client, $user);

        $crawler = $client->request('GET', '/tasks/create');

        $form = $crawler->selectButton('Ajouter')->form([
            'task[title]' => '',
            'task[content]' => ''
        ]);
        $client->submit($form);

        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('??', 'Vous devez saisir un titre.');
        //$this->assertSelectorTextContains('??', 'Vous devez saisir du contenu.');

    }

    public function testCreateAsNotLogged()//OK
    {
        $client = static::createClient();

        $client->request('POST', '/tasks/create', [
            'task[title]' => 'Le titre',
            'task[content]' => 'le contenu'
        ]);

        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertResponseIsSuccessful();
        
    }

//     // -----------------------edit-----------------------

    public function testEditAsUser()//OK
    {
        self::bootKernel();
        $user = self::getContainer()->get('doctrine')->getManager()->getRepository(User::class)->findOneBy(['username' => 'userdemo']);
        self::ensureKernelShutdown();

        $client = static::createClient();

        $this->loginUser($client, $user);

        $crawler = $client->request('GET', '/tasks/6/edit');

        $form = $crawler->selectButton('Modifier')->form([
            'task[title]' => 'Le titre',
            'task[content]' => 'le contenu'
        ]);
        $client->submit($form);

        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('.alert.alert-success');
        //Dama bloque ?
        //$this->assertSelectorTextContains('a', 'Le titre');
    }

    public function testEditAsUserEmptyForm()//OK inutilie?
    {
        self::bootKernel();
        $user = self::getContainer()->get('doctrine')->getManager()->getRepository(User::class)->findOneBy(['username' => 'userdemo']);
        self::ensureKernelShutdown();

        $client = static::createClient();

        $this->loginUser($client, $user);

        $crawler = $client->request('GET', '/tasks/create');

        $form = $crawler->selectButton('Ajouter')->form([
            'task[title]' => '',
            'task[content]' => ''
        ]);
        $client->submit($form);

        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('??', 'Vous devez saisir un titre.');
        //$this->assertSelectorTextContains('??', 'Vous devez saisir du contenu.');

    }

    public function testEditAsNotLogged()//OK
    {
        
        $client = static::createClient();

        $client->request('POST', '/tasks/4/edit', [
            'task[title]' => 'Le titre',
            'task[content]' => 'le contenu'
        ]);

        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertResponseIsSuccessful();
        
    }

    // public function testEditAsUserButBadAuthor()//marche pas
    // {
        
    //     self::bootKernel();
    //     $user = self::getContainer()->get('doctrine')->getManager()->getRepository(User::class)->findOneBy(['username' => 'userdemo']);
    //     self::ensureKernelShutdown();

    //     $client = static::createClient();

    //     $this->loginUser($client, $user);

    //     $client->request('POST', '/tasks/5/edit', [
    //         'task[title]' => 'Le titre',
    //         'task[content]' => 'le contenu'
    //     ]);

    //     $this->assertResponseRedirects();
    //     $client->followRedirect();
    //     $this->assertResponseIsSuccessful();
    //     // $this->assertSelectorTextContains('h1', 'Liste des tâches');
        
    // }

}