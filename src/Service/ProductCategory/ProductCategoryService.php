<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Service\ProductCategory;

use Shayer\EduEssayPlugin\Common\Localize\LocalizeScriptSubscriber;
use Shayer\EduEssayPlugin\Controller\Rest\DTO\ProductCategoryDto;
use Shayer\EduEssayPlugin\Service\GetValueServiceInterface;

class ProductCategoryService implements GetValueServiceInterface, LocalizeScriptSubscriber
{
	private const TABLE_NAME = 'shayer_essay_product_category';

	/**
	 * Construct.
	 *
	 * @param ProductCategoryRepository $productCategoryRepository
	 */
	public function __construct(
		private readonly ProductCategoryRepository $productCategoryRepository
	) {
	}

	/**
	 * @return string[]
	 */
	public static function getLocalizeScript(): array
	{
		return [
			"essay_product_category" => ["sha-essay-main-script", "getListLocalize"]
		];
	}

	/**
	 * @param ProductCategoryDto[] $data
	 *
	 * @return void
	 */
	public function extract(array $data): void
	{
		$this->productCategoryRepository->clear(self::TABLE_NAME);

		if (!empty($data)) {
			$this->mapRowsForInsert($data);
		}
	}

	/**
	 * @return array
	 */
	public function getList(): array
	{
		return $this->productCategoryRepository->getAll(self::TABLE_NAME);
	}

	/**
	 * @return array
	 */
	public function getListLocalize(): array
	{
		$output = [];
		$list = $this->productCategoryRepository->getAll(self::TABLE_NAME);

		if (empty($list)) {
			return $output;
		}

		foreach ($list as $item) {
			$output[] = [
				'id' => $item['id'],
				'label' => $item['category_name']
			];
		}

		return $output;
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
	 * @param ProductCategoryDto $item
	 *
	 * @return void
	 */
	private function createRow(ProductCategoryDto $item): void
	{
		$this->productCategoryRepository->create(self::TABLE_NAME, $item);
	}

	/**
	 * @return string|array|int|float
	 */
	public function getValue(): string|array|int|float
	{
		return json_encode($this->productCategoryRepository->getAll(self::TABLE_NAME));
	}
}
