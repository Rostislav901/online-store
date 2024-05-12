<?php

namespace App\ProductCatalog\Infrastructure\Repository;

use App\ProductCatalog\Application\Exception\CategoryNotFoundException;
use App\ProductCatalog\Domain\Aggregate\Category\Category;
use App\ProductCatalog\Domain\Repository\CategoryRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

class CategoryRepository extends NestedTreeRepository implements CategoryRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new ClassMetadata(Category::class));
    }

    public function getCategoryByTitle(string $categoryTitle): Category
    {
        $category = $this->findOneBy(['title' => $categoryTitle]);

        return null === $category ? throw new CategoryNotFoundException() : $category;
    }

    public function getAllCategories(): array
    {
        $res = $this->findAll();

        return [] !== $res ? $res : throw new CategoryNotFoundException();
    }

    public function getChildCategory(Category $category): array
    {
        return $this->children($category, true);
    }

    public function getCategoryById(int $id): Category
    {
        return $this->findOneBy(['id' => $id]);
    }
}
