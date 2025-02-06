<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $users = [
            ['steve.rogers@avengers.com', [], 'CAPTAIN$0n7ourL3fT$AMERICA', 'Rogers', 'Steve'],
            ['tony.stark@avengers.com', ['ROLE_USER', 'ROLE_ADMIN', 'ROLE_SUPER_ADMIN'], 'IRON$1loveU3000$MAN', 'Stark', 'Tony'],
            ['bruce.banner@avengers.com', ['ROLE_USER', 'ROLE_ADMIN'], 'THE$1amAlway5Angry$HULK', 'Banner', 'Bruce'],
            ['thor.odinson@avengers.com', [], 'THOR$Br1ngMEthanos!$KING', 'Odinson', 'Thor'],
            ['natasha.romanoff@avengers.com', ['ROLE_USER', 'ROLE_ADMIN'], 'BLACK$L3tmegoIts0K$WIDOW', 'Romanoff', 'Natasha'],
            ['clint.barton@avengers.com', [], 'HAWK$D0ntGIVEm3h0pe$EYE', 'Barton', 'Clint'],
            ['peter.parker@avengers.com', ['ROLE_USER', 'ROLE_ADMIN', 'ROLE_SUPER_ADMIN'], 'SPIDER$Fr1endlyN3ighborh00d$MAN', 'Parker', 'Peter'],
            ['stephen.strange@avengers.com', [], 'DOCTOR$Were1Nth3endgameNOW$STRANGE', 'Strange', 'Stephen'],
        ];

        foreach ($users as $userData) {
            $user = new User();
            $user->setEmail($userData[0]);
            $user->setRoles($userData[1]);
            $user->setFirstName($userData[4]);
            $user->setSurname($userData[3]);
            $hashedPassword = $this->passwordHasher->hashPassword($user, $userData[2]);
            $user->setPassword($hashedPassword);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
