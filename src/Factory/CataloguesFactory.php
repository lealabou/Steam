<?php

namespace App\Factory;

use App\Entity\Catalogues;
use App\Repository\CataloguesRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Catalogues>
 *
 * @method static Catalogues|Proxy createOne(array $attributes = [])
 * @method static Catalogues[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Catalogues|Proxy find(object|array|mixed $criteria)
 * @method static Catalogues|Proxy findOrCreate(array $attributes)
 * @method static Catalogues|Proxy first(string $sortedField = 'id')
 * @method static Catalogues|Proxy last(string $sortedField = 'id')
 * @method static Catalogues|Proxy random(array $attributes = [])
 * @method static Catalogues|Proxy randomOrCreate(array $attributes = [])
 * @method static Catalogues[]|Proxy[] all()
 * @method static Catalogues[]|Proxy[] findBy(array $attributes)
 * @method static Catalogues[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Catalogues[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CataloguesRepository|RepositoryProxy repository()
 * @method Catalogues|Proxy create(array|callable $attributes = [])
 */
final class CataloguesFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'Titre' => self::faker()->text(),
            'Description' => self::faker()->text(),
            'image' => self::faker()->text(),
            'categorie' => self::faker()->text(),
            'Date' => self::faker()->randomNumber(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Catalogues $catalogues) {})
        ;
    }

    protected static function getClass(): string
    {
        return Catalogues::class;
    }
}
