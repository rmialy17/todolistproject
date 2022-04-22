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
        $users = [];

        //Users(2)
        $user= new User();
        $data2 = [
            "username" => ['admin','userdemo', 'anonymous'],
            "email" => ['admin@gmail.com', 'userdemo@gmail.com', 'annonymous@gmail.com'],
            "roles" => [['ROLE_ADMIN'],['ROLE_USER'],['ROLE_USER']]
        ];

        for ($i = 0; $i < count($data2['username']); $i++) {
            $user = new User();
            $user->setUsername($data2['username'][$i]);
            $user->setEmail($data2['email'][$i]);
            $user->setRoles($data2['roles'][$i]);
            $user->setPassword($this->passwordHasher->hashPassword($user, "#Demo0000"));
            $users[]=$user;
            $manager->persist($user);
        
        }



        $manager->flush();

        //Tasks(5)
     
        $today = new \DateTime();
       

        $data = [
            "title" => ['Tâche 1', 'Tâche 2', 'Tâche 3', 'Tâche 4', 'Tâche 5'],
            "content" => ['Faire le ménage', 'Faire les courses', 'Sortir les poubelles',
            'Faire un gâteau', 'Acheter une table'],
            "isDone" => [true, false, true, false, true]
            //  "user_id" => 
        ];
        // $count = 0;
        for ($i = 0; $i < count($data['title']); $i++) {
            $task = new Task();
            $task->setCreatedAt($today);
            $task->setTitle($data["title"][$i]);
            $task->setContent($data["content"][$i]);
            $task->toggle($data["isDone"][$i]);
         
       
            // if ($count < 2) {
                $task->setUser($users[random_int(0,2)]);  
                $users[]=$user; 
                $user->getUsername();
            // }
            // if($user == null){
            //     $user->setUsername('anonymous');
            // }
            $manager->persist($task);
          
        }

        $manager->flush();


      

    }
}
