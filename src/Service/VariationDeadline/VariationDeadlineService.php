<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Service\VariationDeadline;

use Shayer\EduEssayPlugin\Controller\Rest\DTO\VariationDeadlineDto;
use Shayer\EduEssayPlugin\Service\GetValueServiceInterface;

class VariationDeadlineService implements GetValueServiceInterface
{
	private const TABLE_NAME = 'shayer_essay_deadline_table_variation_by_count_page';

	/**
	 * Construct.
	 *
	 * @param VariationDeadlineRepository $variationDeadlineRepository
	 */
	public function __construct(
		private readonly VariationDeadlineRepository $variationDeadlineRepository
	) {
	}

	/**
	 * @param VariationDeadlineDto[] $data
	 *
	 * @return void
	 */
	public function extract(array $data): void
	{
		$this->variationDeadlineRepository->clear(self::TABLE_NAME);

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
	 * @param VariationDeadlineDto $item
	 *
	 * @return void
	 */
	private function createRow(VariationDeadlineDto $item): void
	{
		$this->variationDeadlineRepository->create(self::TABLE_NAME, $item);
	}

	/**
	 * @return string|array|int|float
	 */
	public function getValue(): string|array|int|float {
		return json_encode($this->variationDeadlineRepository->getAll(self::TABLE_NAME));
	}
}
