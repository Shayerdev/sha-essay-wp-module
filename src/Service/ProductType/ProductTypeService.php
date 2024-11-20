<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Service\ProductType;

use Shayer\EduEssayPlugin\Common\Localize\LocalizeScriptSubscriber;
use Shayer\EduEssayPlugin\Controller\Rest\DTO\ProductTypeDto;
use Shayer\EduEssayPlugin\Service\GetValueServiceInterface;

class ProductTypeService implements GetValueServiceInterface, LocalizeScriptSubscriber
{
	private const TABLE_NAME = 'shayer_essay_product_type';

	/**
	 * Construct.
	 *
	 * @param ProductTypeRepository $productTypeRepository
	 */
	public function __construct(
		private readonly ProductTypeRepository $productTypeRepository
	) {
	}

	/**
	 * @return string[]
	 */
	public static function getLocalizeScript(): array
	{
		return [
			"essay_product_type" => ["sha-essay-main-script", "getListLocalize"]
		];
	}

	/**
	 * @return array
	 */
	public function getListLocalize(): array
	{
		$output = [];
		$list = $this->productTypeRepository->getAll(self::TABLE_NAME);

		if (empty($list)) {
			return $output;
		}

		foreach ($list as $item) {
			$output[] = [
				'id' => $item['id'],
				'label' => $item['name_type']
			];
		}

		return $output;
	}

	/**
	 * @return array
	 */
	public function getList(): array
	{
		return $this->productTypeRepository->getAll(self::TABLE_NAME);
	}

	/**
	 * @param ProductTypeDto[] $data
	 *
	 * @return void
	 */
	public function extract(array $data): void
	{
		$this->productTypeRepository->clear(self::TABLE_NAME);

		if (!empty($data)) {
			$this->mapRowsForInsert($data);
		}
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
	 * @param ProductTypeDto $item
	 *
	 * @return void
	 */
	private function createRow(ProductTypeDto $item): void
	{
		$this->productTypeRepository->create(self::TABLE_NAME, $item);
	}

	/**
	 * @return string|array|int|float
	 */
	public function getValue(): string|array|int|float
	{
		return json_encode($this->productTypeRepository->getAll(self::TABLE_NAME));
	}
}
