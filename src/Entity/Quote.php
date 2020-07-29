<?php


namespace App\Entity;


use App\Entity\Traits\CreatedAtTrait;
use App\Entity\Traits\UpdatedAtTrait;
use Doctrine\ORM\Mapping;

/**
 * @Mapping\Table(name="quotes")
 * @Mapping\Entity(repositoryClass="App\Repository\QuoteRepository")
 * @Mapping\HasLifecycleCallbacks()
 *
 */
class Quote
{
    use CreatedAtTrait, UpdatedAtTrait;

    /**
     * @Mapping\Column(name="id", type="bigint", unique=true)
     * @Mapping\Id
     * @Mapping\GeneratedValue
     */
    private $id;

    /**
     * @Mapping\Column(type="string", length=50, nullable=true)
     */
    private $author;

    /**
     * @Mapping\Column(type="string", length=10, nullable=false)
     */
    private $type;

    /**
     * @Mapping\Column(type="string", length=500, nullable=false)
     */
    private $text;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param  int  $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }


    /**
     * @param  string  $author
     */
    public function setAuthor(?string $author = null): void
    {
        $this->author = $author;
    }


    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param  string  $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param  string  $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }


}