<?php

namespace Symfony\UX\DataTables\Model;

class DataTable
{
    private ?string $id;

    private array $options = [];

    private array $attributes = [];

    public function __construct(
        ?string $id = null
    ) {
        $this->id = $id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    

    /**
     * Get the value of options
     */ 
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the value of options
     *
     * @return  self
     */ 
    public function setOptions($options): static
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get the value of attributes
     */ 
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Set the value of attributes
     *
     * @return  self
     */ 
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function getDataController(): ?string
    {
        return $this->attributes['data-controller'] ?? null;
    }
}
