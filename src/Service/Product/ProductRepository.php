<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Service\Product;

use Shayer\EduEssayPlugin\Common\Database\ConnectionInterface;
use Shayer\EduEssayPlugin\Controller\Rest\DTO\ProductDto;

class ProductRepository
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
	 * @param ProductDto $item
	 *
	 * @return void
	 */
	public function create(
		string $tableName,
		ProductDto $item,
	): void {
		$this->connection->insert($tableName, [
			'product_name' => $item->getName(),
			'product_active' => $item->getActive(),
			'product_type_id' => $item->getTypeId(),
			'product_category_id' => $item->getCategoryId(),
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
