<?php

namespace JoaoAlbuquerque\NewsGroupBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsGroup
 */
class NewsGroup
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $email;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return NewsGroup
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @var \DateTime
     */
    private $created_at;


    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return NewsGroup
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        if (null === $this->getCreatedAt()) {
            $this->created_at = new \DateTime();
        }
    }

}
