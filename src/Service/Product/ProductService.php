<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Service\Product;

use Shayer\EduEssayPlugin\Controller\Rest\DTO\ProductCategoryDto;
use Shayer\EduEssayPlugin\Controller\Rest\DTO\ProductDto;
use Shayer\EduEssayPlugin\Service\GetValueServiceInterface;

class ProductService implements GetValueServiceInterface
{
	private const TABLE_NAME = 'shayer_essay_product';

	/**
	 * Construct.
	 *
	 * @param ProductRepository $productRepository
	 */
	public function __construct(
		private readonly ProductRepository $productRepository
	) {
	}

	/**
	 * @param ProductDto[] $data
	 *
	 * @return void
	 */
	public function extract(array $data): void
	{
		$this->productRepository->clear(self::TABLE_NAME);

		if (!empty($data)) {
			$this->mapRowsForInsert($data);
		}
	}

	/**
	 * Get list.
	 *
	 * @return array
	 */
	public function getList(): array
	{
		return $this->productRepository->getAll(self::TABLE_NAME);
	}

	/**
	 * @param array $data
	 *
	 * @return void
	 */
	private function mapRowsForInsert(array $data): void
	{
		foreach ($data as $item) {
			$this->createRow($item);
		}
	}

	/**
	 * @param ProductDto $item
	 *
	 * @return void
	 */
	private function createRow(ProductDto $item): void
	{
		$this->productRepository->create(self::TABLE_NAME, $item);
	}

	/**
	 * @return string|array|int|float
	 */
	public function getValue(): string|array|int|float {
		return json_encode($this->productRepository->getAll(self::TABLE_NAME));
	}
}
