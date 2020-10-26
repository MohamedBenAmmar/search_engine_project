<?php


namespace Entities;


class SearchQuery
{
private int $id;
private string $content;
private array $criterias;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return array
     */
    public function getCriterias(): array
    {
        return $this->criterias;
    }

    /**
     * @param array $criterias
     */
    public function setCriterias(array $criterias): void
    {
        $this->criterias = $criterias;
    }



}