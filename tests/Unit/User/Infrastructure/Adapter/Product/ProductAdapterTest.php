<?php

namespace App\Tests\Unit\User\Infrastructure\Adapter\Product;

use App\ProductCatalog\Application\UseCase\Query\Product\FindProductCountByUserUlid\FindProductCountByUserUlidQueryResult;
use App\User\Infrastructure\Adapter\Product\ProductAdapter;
use App\User\Infrastructure\Adapter\Product\ProductAPIByUserUlidInterface;
use PHPUnit\Framework\TestCase;

class ProductAdapterTest extends TestCase
{
    public function testGetProductCountDataByUserUlid()
    {
        $productApi = $this->createMock(ProductAPIByUserUlidInterface::class);

        $productApi->expects($this->once())
                   ->method('productCountByUserUlid')
                   ->with('testing')
                   ->willReturn(new FindProductCountByUserUlidQueryResult(111));

        $actual = (new ProductAdapter($productApi))->getProductCountDataByUserUlid('testing');

        $this->assertEquals(FindProductCountByUserUlidQueryResult::class, get_class($actual));
        $this->assertEquals(111, $actual->getCount());
    }
}
