<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Common\Database\Connection;

use Exception;
use Shayer\EduEssayPlugin\Common\Database\ConnectionInterface;
use wpdb;

/**
 * @SuppressWarnings(PHPMD)
 */
class MySQL implements ConnectionInterface
{
    /**
     * @return wpdb
     */
    public function getConnection(): wpdb
    {
        return self::getConnectionInstance();
    }

    /**
     * @return wpdb
     */
    public static function getConnectionInstance(): wpdb
    {
        global $wpdb;
        return $wpdb;
    }

    /**
     * @return string
     */
    public function getTablePrefix(): string
    {
        return $this->getConnection()->prefix;
    }

    /**
     * Returns table name with prefix
     *
     * @param string $tableName
     * @return string
     */
    public function getTableName(string $tableName): string
    {
        return $this->getTablePrefix() . $tableName;
    }

    /**
     * @param string $tableName
     * @return bool
     */
    public function isTableExists(string $tableName): bool
    {
        $tableName = $this->getTableName($tableName);
        $connection = $this->getConnection();
        $query = $connection->prepare('SHOW TABLES LIKE %s', $connection->esc_like($tableName));
        $name = $connection->get_var($query);

        return $name === $tableName;
    }

    /**
     * Creates table if the table does not exist.
     * Returns true if the table is created or exists in a database.
     *
     * @param string $ddl
     * @return bool|string
     */
    public function createTable(string $ddl): bool|string
    {
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($ddl);
        return $this->getConnection()->last_error;
    }

    /**
     * @param string $tableName
     * @param array $values
     * @param array|string $format
     * @return int
     * @throws Exception
     */
    public function insert(string $tableName, array $values, array|string $format = []): int
    {
        $connection = $this->getConnection();
        $connection->insert(
            $this->getTableName($tableName),
            $values,
            $format
        );

        if (!empty($connection->last_error)) {
            throw new Exception($connection->last_error);
        }

        return $connection->insert_id;
    }

    /**
     * @param string $tableName
     * @param array $value
     * @param array $where
     * @param array|null $format
     * @return bool|int|null
     * @throws Exception
     */
    public function update(
        string $tableName,
        array $value,
        array $where,
        array|null $format = null
    ): bool|int|null {
        $connection = $this->getConnection();
        $update = $connection->update(
            $this->getTableName($tableName),
            $value,
            $where,
            $format
        );

        if (!empty($connection->last_error)) {
            throw new Exception($connection->last_error);
        }

        return $update;
    }

    /**
     * @param string $tableName
     * @return array
     */
    public function getAll(string $tableName): array
    {
        $connection = $this->getConnection();
        return $connection->get_results(sprintf("SELECT * FROM %s", $this->getTableName($tableName)), ARRAY_A);
    }

    /**
     * @param string $productId
     * @param string $tableName
     * @return array
     */
    public function getOne(string $productId, string $tableName): array
    {
        $connection = $this->getConnection();
        $sql = $connection->prepare(
            "SELECT * FROM {$this->getTableName($tableName)} WHERE product_id = %s",
            $productId
        );
        $row = $connection->get_row($sql, ARRAY_A);
        return !empty($row) ? $row : [];
    }

    /**
     * Delete table
     *
     * @param string $tableName
     * @return bool
     */
    public function dropTable(string $tableName): bool
    {
        $connection = $this->getConnection();
        return $connection->query(
            sprintf("DROP TABLE IF EXISTS %s", $this->getTableName($tableName))
        );
    }

    /**
     * @param string $tableName
     * @return void
     */
    public function truncate(string $tableName): void
    {
        $connection = $this->getConnection();
        $connection->query(
            sprintf("TRUNCATE TABLE %s", $this->getTableName($tableName))
        );
    }

    /**
     * @param string $sql
     * @return void
     */
    public function query(string $sql): void
    {
        $connection = $this->getConnection();
        $connection->query($sql);
    }

    /**
     * @param string $sql
     * @param array $bind
     * @return string|null
     */
    public function fetchAggregate(string $sql, array $bind = []): ?string
    {
        $connection = $this->getConnection();
        $query = $connection->prepare($sql, $bind);
        return $connection->get_var($query);
    }

    /**
     * @param string $sql
     * @param array $bind
     * @return ?array
     */
    public function fetchAssoc(string $sql, array $bind = []): ?array
    {
        $connection = $this->getConnection();
        $query = $connection->prepare($sql, $bind);
        return $connection->get_results($query, ARRAY_A);
    }

    /**
     * @param string $sql
     * @param array $bind
     * @return array|null
     */
    public function fetchOne(string $sql, array $bind = []): ?array
    {
        $connection = $this->getConnection();
        $query = $connection->prepare($sql, $bind);
        return $connection->get_row($query, ARRAY_A);
    }

    /**
     * Delete
     *
     * @param string $tableName
     * @param array $where
     * @return void
     */
    public function delete(string $tableName, array $where = []): void
    {
        $connection = $this->getConnection();
        $connection->query(
            sprintf(
                'DELETE FROM %s WHERE 1 = 1',
                $this->getTableName($tableName),
            )
        );
    }

    /**
     * Start transaction
     *
     * @return void
     */
    public function start(): void
    {
        $connection = $this->getConnection();
        $connection->query('START TRANSACTION');
    }

    /**
     * Commit transaction
     *
     * @return void
     */
    public function commit(): void
    {
        $connection = $this->getConnection();
        $connection->query('COMMIT');
    }

    /**
     * Rollback transaction
     *
     * @return void
     */
    public function rollback(): void
    {
        $connection = $this->getConnection();
        $connection->query('ROLLBACK');
    }

    /**
     * Prepares a query string with a $bind array
     *
     * @param string $query
     * @param array $bind
     * @return string
     */
    public function prepare(string $query, array $bind): string
    {
        return (string) $this->getConnection()->prepare($query, $bind);
    }
}
