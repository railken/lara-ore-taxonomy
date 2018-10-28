<?php

namespace Railken\Amethyst\Schemas;

use Railken\Amethyst\Managers\TaxonomyManager;
use Railken\Lem\Attributes;
use Railken\Lem\Schema;

class TaxonomySchema extends Schema
{
    /**
     * Get all the attributes.
     *
     * @var array
     */
    public function getAttributes()
    {
        return [
            Attributes\IdAttribute::make(),
            Attributes\TextAttribute::make('name')
                ->setUnique(true)
                ->setRequired(true),
            Attributes\LongTextAttribute::make('description'),
            Attributes\LongTextAttribute::make('notes'),
            Attributes\BooleanAttribute::make('enabled'),
            Attributes\BelongsToAttribute::make('parent_id')
                ->setRelationName('parent')
                ->setRelationManager(TaxonomyManager::class),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}