<?php

namespace App\Model;

class Card
{
    /**
     * @var int
     */
    private $value;


    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $color;

    public function __toString()
    {
        return sprintf('%s de %s', $this->name, $this->color);
    }


    /**
     * @param string $value
     * @return Card
     */
    public function setValue(string $value): Card
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $name
     * @return Card
     */
    public function setName(string $name): Card
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $color
     * @return Card
     */
    public function setColor(string $color): Card
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }


}