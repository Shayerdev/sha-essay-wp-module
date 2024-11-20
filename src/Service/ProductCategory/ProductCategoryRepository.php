<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Service\ProductCategory;

use Shayer\EduEssayPlugin\Common\Database\ConnectionInterface;
use Shayer\EduEssayPlugin\Controller\Rest\DTO\ProductCategoryDto;

class ProductCategoryRepository
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
	 * @param ProductCategoryDto $item
	 *
	 * @return void
	 */
	public function create(
		string $tableName,
		ProductCategoryDto $item,
	): void {
		$this->connection->insert($tableName, [
			'category_name' => $item->getName(),
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
