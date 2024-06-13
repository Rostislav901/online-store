<?php

namespace App\Tests\Integration\ProductCatalog\Infrastructure\Repsitory;

use App\ProductCatalog\Application\Exception\ProductNotFoundException;
use App\ProductCatalog\Domain\Aggregate\Product\Entity\Product;
use App\ProductCatalog\Domain\Aggregate\Product\Enum\Currency;
use App\ProductCatalog\Domain\Aggregate\Product\Specification\Interface\ProductNameSpecificationInterface;
use App\ProductCatalog\Domain\Aggregate\Product\Specification\ProductSpecification;
use App\ProductCatalog\Infrastructure\Repository\ProductRepository;
use App\Shared\Domain\Specification\UlidSpecification;
use App\Shared\Domain\VO\UserUlid;
use App\Tests\Integration\AbstractRepositoryTest;

class ProductRepositoryTest extends AbstractRepositoryTest
{
    private readonly ProductRepository $productRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productRepository = $this->getRepositoryForEntity(Product::class);
    }

    public function testAddProduct(): void
    {
        $product = $this->createProduct();
        $this->productRepository->addProduct($product);

        $actual = $this->productRepository->findBy(['ulid' => $product->getUlid()]);

        $this->assertCount(1, $actual);

        $this->assertEquals('test-name', $actual[0]->getName());
        $this->assertEquals('EUR', $actual[0]->getCurrency()->value);
        $this->assertEquals($product, $actual[0]);
    }

    public function testFindOneByUlidThrowException(): void
    {
        $this->expectException(ProductNotFoundException::class);

        $this->productRepository->findOneByUlid('test-ulid');
    }

    public function testFindOneByUlid(): void
    {
        $product = $this->createProduct();

        $this->em->persist($product);
        $this->em->flush();

        $this->assertEquals($product, $this->productRepository->findOneByUlid($product->getUlid()));
    }

    public function testFindByCategoryIdSortByCreatedAtDESCWithEmptyProducts(): void
    {
        $actual = $this->productRepository->findByCategoryIdSortByCreatedAtDESC(777);

        $this->assertCount(0, $actual);
        $this->assertEquals([], $actual);
    }

    public function testFindByCategoryIdSortByCreatedAtDESC(): void
    {
        $product1 = $this->createProduct();
        $product1->setDescription('first');

        $this->em->persist($product1);
        $this->em->flush();
        sleep(3);

        $product2 = $this->createProduct();
        $product2->setDescription('second');

        $this->em->persist($product2);
        $this->em->flush();

        $actual = $this->productRepository->findByCategoryIdSortByCreatedAtDESC('2');

        $this->assertCount(2, $actual);
        $this->assertNotEquals($product1->getCreatedAt(), $product2->getCreatedAt());
        $this->assertEquals($product2, $actual[0]);
        $this->assertEquals($product1, $actual[1]);
    }

    public function testFindCountByCategoryIdWithEmptyProducts(): void
    {
        $this->assertEquals(0, $this->productRepository->findCountByCategoryId(2));
    }

    public function testFindCountByCategoryId(): void
    {
        $this->addFiveProductToDB();

        $this->assertEquals(5, $this->productRepository->findCountByCategoryId(2));
    }

    public function testFindByUserUlidThrowException(): void
    {
        $this->expectException(ProductNotFoundException::class);

        $this->productRepository->findByUserUlid('test-ulid');
    }

    public function testFindByUserUlid(): void
    {
        $product = $this->addFiveProductToDB();

        $actual = $this->productRepository->findByUserUlid('test-ulid');

        $this->assertCount(5, $actual);
        $this->assertEquals($product, $actual[count($actual) - 1]);
    }

    public function testFindCountByUserUlidWithEmptyProducts(): void
    {
        $this->assertEquals(0, $this->productRepository->findCountByUserUlid('test-ulid'));
    }

    public function testFindCountByUserUlid(): void
    {
        $product = $this->addFiveProductToDB();

        $actual = $this->productRepository->findByUserUlid('test-ulid');

        $this->assertCount(5, $actual);

        $this->assertEquals($product, $actual[count($actual) - 1]);
    }

    public function testFindProductBySearchEmptyProductsThrowException(): void
    {
        $this->expectException(ProductNotFoundException::class);

        $this->productRepository->findProductBySearch('test-search');
    }

    public function testFindProductBySearchThrowException(): void
    {
        $this->addFiveProductToDB();
        $this->expectException(ProductNotFoundException::class);

        $this->productRepository->findProductBySearch('test-search');
    }

    public function testFindProductBySearch(): void
    {
        $ulidSpecification = $this->createMock(UlidSpecification::class);
        $ulidSpecification->expects($this->once())
            ->method('satisfy')
            ->with('test-ulid');

        $productNameSpecification = $this->createMock(ProductNameSpecificationInterface::class);
        $productNameSpecification->expects($this->once())
            ->method('productNameInUserProductsIsUnique')
            ->with('test-search123', 'test-ulid');

        $productSpecification = $this->createMock(ProductSpecification::class);
        $productSpecification->expects($this->once())
            ->method('getNameSpecification')
            ->willReturn($productNameSpecification);

        $product = new Product(
            'test-search123',
            'test-description',
            12345,
            Currency::EUR,
            20,
            true,
            2,
            new UserUlid('test-ulid', $ulidSpecification),
            $productSpecification,
        );

        $this->em->persist($product);
        $this->addFiveProductToDB();

        $actual = $this->productRepository->findProductBySearch('test-search');

        $this->assertCount(1, $actual);
        $this->assertEquals($product, $actual[0]);
    }

    public function testExistByNameAndUserUlidReturnFalse(): void
    {
        $this->assertFalse($this->productRepository->existByNameAndUserUlid('test-name', 'test-ulid'));
    }

    public function testExistByNameAndUserUlidReturnTrue(): void
    {
        $this->addFiveProductToDB();

        $this->assertTrue($this->productRepository->existByNameAndUserUlid('test-name', 'test-ulid'));
    }

    public function testFindOneProductByUserUlidAndProductNameThrowException(): void
    {
        $this->expectException(ProductNotFoundException::class);

        $this->productRepository->findOneProductByUserUlidAndProductName('test-ulid', 'test-name');
    }

    public function testFindOneProductByUserUlidAndProductName(): void
    {
        $product = $this->createProduct();
        $this->em->persist($product);
        $this->em->flush();

        $actual = $this->productRepository->findOneProductByUserUlidAndProductName('test-ulid', 'test-name');
        $this->assertEquals($product, $actual);
    }

    public function testExistByUserUlidAndProductUlidReturnFalse(): void
    {
        $this->assertFalse($this->productRepository->existByUserUlidAndProductUlid('test-ulid', 'test-ulid'));
    }

    public function testExistByUserUlidAndProductUlidReturnTrue(): void
    {
        $product = $this->createProduct();
        $this->em->persist($product);
        $this->em->flush();

        $this->assertTrue($this->productRepository->existByUserUlidAndProductUlid('test-ulid', $product->getUlid()));
    }

    public function testFindByCategoryAndUserUlidThrowException(): void
    {
        $this->expectException(ProductNotFoundException::class);

        $this->productRepository->findByCategoryAndUserUlid(2, 'test-ulid');
    }

    public function testFindByCategoryAndUserUlid(): void
    {
        $product = $this->addFiveProductToDB();

        $actual = $this->productRepository->findByCategoryAndUserUlid(2, 'test-ulid');

        $this->assertCount(5, $actual);
        $this->assertEquals($product, $actual[count($actual) - 1]);
    }

    private function createProduct(): Product
    {
        $ulidSpecification = $this->createMock(UlidSpecification::class);
        $ulidSpecification->expects($this->once())
             ->method('satisfy')
             ->with('test-ulid');

        $productNameSpecification = $this->createMock(ProductNameSpecificationInterface::class);
        $productNameSpecification->expects($this->once())
             ->method('productNameInUserProductsIsUnique')
             ->with('test-name', 'test-ulid');

        $productSpecification = $this->createMock(ProductSpecification::class);
        $productSpecification->expects($this->once())
            ->method('getNameSpecification')
            ->willReturn($productNameSpecification);

        return new Product(
            'test-name',
            'test-description',
            12345,
            Currency::EUR,
            20,
            true,
            2,
            new UserUlid('test-ulid', $ulidSpecification),
            $productSpecification,
        );
    }

    private function addFiveProductToDB(): Product
    {
        for ($i = 0; $i < 5; ++$i) {
            $product = $this->createProduct();
            $this->em->persist($product);
        }
        $this->em->flush();

        return $product;
    }
}
