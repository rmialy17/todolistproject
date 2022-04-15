<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        //Tasks(5)
        
        $today = new \DateTime();
        $user= new User();

        $data = [
            "title" => ['Tâche 1', 'Tâche 2', 'Tâche 3', 'Tâche 4', 'Tâche 5'],
            "content" => ['Faire le ménage', 'Faire les courses', 'Sortir les poubelles',
            'Faire un gâteau', 'Acheter une table'],
            "isDone" => [true, false, true, false, true]
        ];

        for ($i = 0; $i < count($data['title']); $i++) {
            $task = new Task();
            $task->setCreatedAt($today);
            $task->setTitle($data["title"][$i]);
            $task->setContent($data["content"][$i]);
            $task->toggle($data["isDone"][$i]);
            $task->setUser(null);
            if($user == null){
                $user->setUsername('anonymous');
            }
            $manager->persist($task);
          
        }

        $manager->flush();

        //Users(2)

        $data2 = [
            "username" => ['admin','userdemo'],
            "email" => ['admin@gmail.com', 'userdemo@gmail.com'],
            "roles" => [['ROLE_ADMIN'],['ROLE_USER']]
        ];

        for ($i = 0; $i < count($data2['username']); $i++) {
            $user = new User();
            $user->setUsername($data2['username'][$i]);
            $user->setEmail($data2['email'][$i]);
            $user->setRoles($data2['roles'][$i]);
            $user->setPassword($this->passwordHasher->hashPassword($user, "#Demo0000"));
            $manager->persist($user);
          
        }

        $manager->flush();

    }
}