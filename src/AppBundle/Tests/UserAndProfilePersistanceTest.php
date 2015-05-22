<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Entity\User;

class UserAndProfilePersistanceTest extends KernelTestCase
{
    public function testProfileIsSavedWithUser()
    {
        static::bootKernel();

        $objectManager = $this->getObjectManager();
        $username = 'test'.time();

        $user = new User($username);

        $user->createProfile();
        $profile = $user->getProfile();
        $this->assertInstanceOf('AppBundle\Entity\UserProfile', $profile);

        /**
         * Here happens the exception:
         *
         * Doctrine\ORM\ORMInvalidArgumentException:
         * The given entity of type 'AppBundle\Entity\UserProfile'
         * (AppBundle\Entity\UserProfile@0000000004f21b78000000015b828b83)
         * has no identity/no id values set. It cannot be added to the identity map.
         */
        $objectManager->persist($user);

        // this isn't even executed:
        $objectManager->persist($profile);

        $objectManager->flush();

        $this->assertUserHasProfile($user, $username);

        $foundUser = $this->findUser($username);
        $this->assertUserHasProfile($foundUser, $username);
    }

    private function assertUserHasProfile(User $user, $expectedUsername)
    {
        $this->assertSame($expectedUsername, $user->getUsername());

        $profile = $user->getProfile();

        $this->assertInstanceOf('AppBundle\Entity\UserProfile', $profile);
        $this->assertSame($user->getId(), $profile->getId());
        $this->assertSame($user->getUsername(), $profile->getUsername());
    }

    private function findUser($username)
    {
        return $this->getObjectManager()
            ->getRepository('AppBundle:User')
            ->findOneByUsername($username);
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    private function getObjectManager()
    {
        return static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }
}
