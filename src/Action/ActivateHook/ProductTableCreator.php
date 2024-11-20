<?php

declare( strict_types=1 );

namespace Shayer\EduEssayPlugin\Action\ActivateHook;

use Shayer\EduEssayPlugin\Action\ActionHookInterface;
use Shayer\EduEssayPlugin\Common\Database\ConnectionInterface;

class ProductTableCreator implements ActionHookInterface
{
	/**
	 * Product Table Name.
	 */
	private const TABLE_NAME = 'shayer_essay_product';

	/**
	 * Product Type Table name.
	 */
	private const TABLE_PRODUCT_TYPE = 'shayer_essay_product_type';

	/**
	 * Product Category Table name.
	 */
	private const TABLE_PRODUCT_CATEGORY = 'shayer_essay_product_category';

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
                product_name VARCHAR(255) NOT NULL,
    			product_active TINYINT(1) NOT NULL DEFAULT 1,
    			product_type_id INT(11) UNSIGNED,
            	product_category_id INT(11) UNSIGNED,
                PRIMARY KEY (id),
    			UNIQUE KEY unique_product_name (product_name),
    			CONSTRAINT fk_product_type FOREIGN KEY (product_type_id) REFERENCES %s(id) ON UPDATE CASCADE,
            	CONSTRAINT fk_product_category FOREIGN KEY (product_category_id) REFERENCES %s(id) ON UPDATE CASCADE
            ) ENGINE=InnoDB;",
			$this->connection->getTableName(self::TABLE_NAME),
			$this->connection->getTableName(self::TABLE_PRODUCT_TYPE),
			$this->connection->getTableName(self::TABLE_PRODUCT_CATEGORY),
		);
	}
}
