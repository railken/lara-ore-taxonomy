<?php

namespace Railken\Amethyst\Attributes;

use Railken\Lem\Attributes\BelongsToAttribute;
use Railken\Lem\Contracts\EntityContract;

class TaxonomyAttribute extends BelongsToAttribute
{
    /**
     * Taxonomy parent name.
     *
     * @var string|null
     */
    protected $taxonomyName = null;

    /**
     * @var string
     */
    protected $relationManager = \Railken\Amethyst\Managers\TaxonomyManager::class;

    /**
     * Create a new instance.
     *
     * @param string $name
     * @param string $taxonomyName
     */
    public function __construct(string $name = null, string $taxonomyName = null)
    {
        $this->setTaxonomyName($taxonomyName);

        parent::__construct($name);
    }

    /**
     * Set taxonomy name.
     *
     * @param string $taxonomyName
     *
     * @return $this
     */
    public function setTaxonomyName(string $taxonomyName = null)
    {
        $this->taxonomyName = $taxonomyName;

        return $this;
    }

    /**
     * Get taxonomy name.
     *
     * @return string|null
     */
    public function getTaxonomyName()
    {
        return $this->taxonomyName;
    }

    /**
     * Create if doesn't exists a taxonomy given name.
     *
     * @param EntityContract $entity
     *
     * @return \Railken\Amethyst\Models\Taxonomy
     */
    public function getTaxonomy(EntityContract $entity)
    {
        return $this->getRelationManager($entity)->findOrCreateOrFail(['name' => $this->getTaxonomyName()])->getResource();
    }

    /**
     * Is a value valid ?
     *
     * @param EntityContract $entity
     * @param mixed          $value
     *
     * @return bool
     */
    public function valid(EntityContract $entity, $value)
    {
        if (!parent::valid($entity, $value)) {
            return false;
        }

        return ($this->getTaxonomyName() !== null && $value->parent_id === $this->getTaxonomy($entity)->id) || $this->getTaxonomyName() === null;
    }
}