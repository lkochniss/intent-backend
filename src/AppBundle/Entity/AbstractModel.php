<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AbstractModel
 */
abstract class AbstractModel
{
    /**
     * @var Integer
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     */
    private $modifiedAt;

    /**
     * @return integer
     */
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
     * @return \DateTime
     */
    public function getModifiedAt() : \DateTime
    {
        return $this->modifiedAt;
    }

    /**
     * @return $this
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param String|null $value
     * @return String
     */
    protected function stringTransform($value) : ?String
    {
        return $value ?: '';
    }

    /**
     * @param \DateTime $value
     * @return \DateTime
     */
    protected function datetimeTransform($value) : ?\DateTime
    {
        return $value ?: new \DateTime();
    }

    /**
     * @param $value
     * @return int
     */
    protected function integerTransform($value) : int
    {
        return $value ?: 0;
    }
}
