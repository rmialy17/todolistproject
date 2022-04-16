<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    private $user;

    public function getEntity(): User
    {        
        return (new User())
            ->setUsername('UserTest')
            ->setEmail('userTest@gmail.com')
            ->setPassword('usertest') // = 'usertest'
            ->setRoles(['ROLE_USER']);
    }

    public function assertHasErrors(User $user, int $nb = 0)
    {
        self::bootKernel();

        $errors=self::getContainer()->get('validator')->validate($user);
        $messages = [];
        
        /** @var ConstraintViolation $error */
        foreach ($errors as $error) {
            $messages[] = $error->getPropertyPath().' => '.$error->getMessage();
        }

        $this->assertCount($nb, $errors, implode(', ', $messages));
    }

    
    public function testId()
    {
        $this->assertSame(null, $this->getEntity()->getId());
    }

    public function testUsername()
    {
        $this->assertSame('UserTest', $this->getEntity()->getUsername());
    }

    public function testPassword()
    {
        $this->assertSame('usertest', $this->getEntity()->getPassword());
    }

    public function testEmail()
    {
        $this->assertSame('userTest@gmail.com', $this->getEntity()->getEmail());
    }

    public function testRole()
    {
        $this->assertSame(['ROLE_USER'], $this->getEntity()->getRoles());
    }

    public function testTask()
    {
        $this->assertEmpty($this->getEntity()->getTasks());        
    }
    
    public function testAddTask()
    {
        $task = new Task;
        $task->setTitle('TitleTest');
        $task->setContent('This is the ContentTest');
        $user = $this->getEntity();
        $task->setUser($user);
        $this->assertCount(1, $user->addTask($task)->getTasks());

    }

    public function testRemoveTask()
    {
        $task = new Task;
        $user = $this->getEntity();
        $task->setUser($user);
        $this->assertCount(1, $user->addTask($task)->getTasks());
        $this->assertCount(0, $user->removeTask($task)->getTasks());
        $this->assertSame(null, $task->getUser());
    }

    public function testSalt()
    {
        $this->assertSame(null, $this->getEntity()->getSalt());
    }



    
    public function testInvalidUniqueUsernameEntity() 
    {  
        //Nom existant dans la fixture
        $this->assertHasErrors($this->getEntity()->setUserName("userdemo"), 1);
    }

    public function testInvalidUniqueEmailEntity() 
    {  
         //Email existant dans la fixture
        $this->assertHasErrors($this->getEntity()->setEmail("userdemo@gmail.com"), 1);
    }

    public function testBlankUsernameEntity()
    {
        $this->assertHasErrors($this->getEntity()->setUsername(''), 1); //Nom vide 
    }

    public function testInvalidFormatEmailEntity()
    {
        $this->assertHasErrors($this->getEntity()->setEmail('userdemo@gmail.com'), 1);
    }

    public function testBlankEmailEntity()
    {
        $this->assertHasErrors($this->getEntity()->setEmail(''), 1); //Email vide
    }


    
}