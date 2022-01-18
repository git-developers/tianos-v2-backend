<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Money;
use App\Entity\Profile;
use App\Entity\Game;
use App\Entity\Card;
use App\Entity\CardPattern;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Util\CardUtil;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //$money->setRealValue(array_rand(Money::REAL_VALUE, 1));

        // ==================================
        $o1 = new Profile();
        $o1->setCode(Profile::PLAYER);
        $o1->setName(Profile::PLAYER);
        $manager->persist($o1);

        $o2 = new Profile();
        $o2->setCode(Profile::ADMIN);
        $o2->setName(Profile::ADMIN);
        $manager->persist($o2);


        // ==================================
        $roles = [];
        $roles[] = 'ROLE_USER';
        $roles[] = User::ROLE_TIANOS;

        $o = new User();
        $o->setName("Name");
        $o->setLastName("LastName");
        $o->setEmail("tianos_admin@tianos.com");
        $o->setProfile($o2);
        $o->setUsername('tianos_admin');
        $o->setPassword(123456);
        $o->setRoles([
            'ROLE_USER',
            'ROLE_ADMIN',
        ]);
        $manager->persist($o);

        $o = new User();
        $o->setName("Player 1");
        $o->setLastName("LastName 1");
        $o->setEmail("player-1@tianos.com");
        $o->setProfile($o1);
        $o->setUsername(uniqid());
        $o->setPassword(123456);
        $o->setRoles($roles);
        $manager->persist($o);

        $o = new User();
        $o->setName("Player 2");
        $o->setLastName("LastName 2");
        $o->setEmail("player-2@tianos.com");
        $o->setProfile($o1);
        $o->setUsername(uniqid());
        $o->setPassword(123456);
        $o->setRoles($roles);
        $manager->persist($o);

        $o = new User();
        $o->setName("Player 3");
        $o->setLastName("LastName 3");
        $o->setEmail("player-3@tianos.com");
        $o->setProfile($o1);
        $o->setUsername(uniqid());
        $o->setPassword(123456);
        $o->setRoles($roles);
        $o->setMoney($m4);
        $manager->persist($o);

        $o = new User();
        $o->setName("Player 4");
        $o->setLastName("LastName 4");
        $o->setEmail("player-4@tianos.com");
        $o->setProfile($o1);
        $o->setUsername(uniqid());
        $o->setPassword(123456);
        $o->setRoles($roles);
        $manager->persist($o);
    }
}
