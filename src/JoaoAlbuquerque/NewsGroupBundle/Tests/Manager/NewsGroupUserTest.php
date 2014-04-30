<?php
/**
 * Created by PhpStorm.
 * User: christus
 * Date: 29/04/14
 * Time: 23:26
 */

namespace JoaoAlbuquerque\NewsGroupBundle\Tests\Manager;

use JoaoAlbuquerque\NewsGroupBundle\Manager\NewsGroupUser;
use JoaoAlbuquerque\NewsGroupBundle\Tests\KernelAwareTest;

class NewsGroupUserTest extends KernelAwareTest
{
    private $id = null;

    public function setUp()
    {
        parent::setUp();
    }

    public function getManagerObject()
    {
        return new NewsGroupUser($this->entityManager);
    }

    public function testPersist()
    {
        $object = new \JoaoAlbuquerque\NewsGroupBundle\Entity\NewsGroupUser();
        $object->setEmail(microtime() . "-test@test.com");

        $managerObject = $this->getManagerObject();
        $managerObject->persist($object);
        $this->assertGreaterThan('0', $object->getId());
        $this->id = $object->getId();
    }

    public function testRemove()
    {
        $this->testPersist();
        $this->assertTrue($this->getManagerObject()->remove($this->id));
        $this->assertFalse($this->getManagerObject()->remove(0));
    }

    public function testFind()
    {
        $this->testPersist();
        $this->assertInstanceOf(
            '\JoaoAlbuquerque\NewsGroupBundle\Entity\NewsGroupUser'
            , $this->getManagerObject()->find($this->id)
        );
    }

    public function testAll()
    {
        $this->testPersist();
        $this->testFind();
        $this->testRemove();
    }

}