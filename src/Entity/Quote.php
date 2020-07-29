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

    const TYPE_ABOUT_LIFE = 1;
    const TYPE_MOTIVATION = 2;
    const TYPE_OTHER = 3;

    const TYPES_AVAILABLE = [
        self::TYPE_ABOUT_LIFE => 'about_life',
        self::TYPE_MOTIVATION => 'motivations',
        self::TYPE_OTHER => 'other',
    ];

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
     * @Mapping\Column(type="integer",  nullable=false)
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
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param  int  $type
     */
    public function setType(int $type): void
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