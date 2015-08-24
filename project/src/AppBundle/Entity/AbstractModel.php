<?php

namespace AppBundle\Entity;

/**
 * Class AbstractModel
 */
abstract class AbstractModel
{
    protected $id;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $modifiedAt;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return $this
     */
    public function setModifiedAt()
    {
        $this->modifiedAt = new \DateTime();

        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * Set createdAt
     *
     * @return \DateTime
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
