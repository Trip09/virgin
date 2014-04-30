<?php
/**
 * Created by PhpStorm.
 * User: christus
 * Date: 29/04/14
 * Time: 23:26
 */

namespace JoaoAlbuquerque\NewsGroupBundle\Manager;

use JoaoAlbuquerque\NewsGroupBundle\Entity\NewsGroupUser as EntityNewsGroupUser;
use Doctrine\ORM\EntityManager;

class NewsGroupUser
{
    /** @var \Doctrine\ORM\EntityRepository|null  */
    protected $em = null;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getEntityManager()
    {
        return $this->em;
    }

    /**
     * @param int $id
     * @return null|object
     */
    public function find($id)
    {
        return $this->em->getRepository('JoaoAlbuquerqueNewsGroupBundle:NewsGroupUser')->find($id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function remove($id)
    {
        $object = $this->find($id);
        if (null === $object) {
            return false;
        }

        $this->em->remove($object);
        $this->em->flush();

        return true;
    }

    /**
     * @param EntityNewsGroupUser $object
     */
    public function persist(EntityNewsGroupUser $object)
    {
        $this->em->persist($object);
        $this->em->flush();
    }


}