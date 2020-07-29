<?php

namespace App\Entity\Traits;

use DateTime;
use Doctrine\ORM\Mapping;

/**
 *
 * @Mapping\HasLifecycleCallbacks()
 */
trait CreatedAtTrait
{
    /**
     * @var DateTime
     *
     * @Mapping\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @Mapping\PrePersist
     */
    public function setCreatedAt(): void
    {
        $this->createdAt = new DateTime();
    }
}