<?php

declare( strict_types=1 );

namespace Shayer\EduEssayPlugin\Action\ActivateHook;

use Shayer\EduEssayPlugin\Action\ActionHookInterface;
use Shayer\EduEssayPlugin\Common\Database\ConnectionInterface;

class ProductCategoryTableCreator implements ActionHookInterface
{
	private const TABLE_NAME = 'shayer_essay_product_category';


	/**
	 * @param ConnectionInterface $connection
	 */
	public function __construct(
		private readonly ConnectionInterface $connection,
	) {
	}

	/**
	 * @return void
	 */
	public function run(): void
	{
		$this->connection->createTable($this->getCreateTableDdl());
	}

	/**
	 * @return string
	 */
	public function getCreateTableDdl(): string {
		return sprintf(
			"CREATE TABLE IF NOT EXISTS %s (
                id INT(11) UNSIGNED AUTO_INCREMENT,
                category_name VARCHAR(255) NOT NULL,
                PRIMARY KEY (id),
    			UNIQUE KEY unique_category_name (category_name)
            ) ENGINE=InnoDB;",
			$this->connection->getTableName(self::TABLE_NAME)
		);
	}
}
