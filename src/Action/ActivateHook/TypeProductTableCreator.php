<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Action\ActivateHook;

use Shayer\EduEssayPlugin\Action\ActionHookInterface;
use Shayer\EduEssayPlugin\Common\Database\ConnectionInterface;

class TypeProductTableCreator implements ActionHookInterface
{
	private const TABLE_NAME = 'shayer_essay_product_type';

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
	private function getCreateTableDdl(): string
	{
		return sprintf(
			"CREATE TABLE IF NOT EXISTS %s (
                id INT(11) UNSIGNED AUTO_INCREMENT,
                name_type VARCHAR(255) NOT NULL,
                coefficient DECIMAL(3, 1) NOT NULL,
   				min_count_symbols INT(11) NOT NULL,
    			min_count_pages INT(11) NOT NULL,
    			apply_coefficient_if_below_min TINYINT(1) NOT NULL DEFAULT 0,
                PRIMARY KEY (id)
            ) ENGINE=InnoDB;",
			$this->connection->getTableName(self::TABLE_NAME)
		);
	}
}
