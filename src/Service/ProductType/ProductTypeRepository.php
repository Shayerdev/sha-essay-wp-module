<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Service\ProductType;

use Shayer\EduEssayPlugin\Common\Database\ConnectionInterface;
use Shayer\EduEssayPlugin\Controller\Rest\DTO\ProductTypeDto;
use Shayer\EduEssayPlugin\Controller\Rest\DTO\VariationDeadlineDto;

class ProductTypeRepository
{
	/**
	 * Construct.
	 *
	 * @param ConnectionInterface $connection
	 */
	public function __construct(
		private readonly ConnectionInterface $connection
	) {
	}

	/**
	 * @param string $tableName
	 *
	 * @return array
	 */
	public function getAll(string $tableName): array
	{
		$tableName = $this->connection->getTableName($tableName);
		$sql = "SELECT * FROM %i ORDER BY id DESC";
		return $this->connection->fetchAssoc($sql, [$tableName]);
	}

	/**
	 * @param string $tableName
	 * @param ProductTypeDto $item
	 *
	 * @return void
	 */
	public function create(
		string $tableName,
		ProductTypeDto $item,
	): void {
		$this->connection->insert($tableName, [
			'name_type' => $item->getTypeName(),
			'coefficient' => $item->getCoefficient(),
			'min_count_symbols' => $item->getMinCountSymbols(),
			'min_count_pages' => $item->getMinCountPages(),
			'apply_coefficient_if_below_min' => $item->getApplyCoefficientIfBelowMin(),
		]);
	}

	/**
	 * @param string $tableName
	 *
	 * @return void
	 */
	public function clear(string $tableName): void
	{
		$this->connection->truncate($tableName);
	}
}
