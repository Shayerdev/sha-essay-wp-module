<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Common\Field;

class MetaField implements FieldInterface {
    /**
     * Return meta value
     * https://developer.wordpress.org/reference/functions/get_post_meta/
     * @param int $postId
     * @param string $slug
     * @param bool $single
     * @return string|bool|int
     */
    public function getValue(
        int $postId,
        string $slug,
        bool $single = true
    ): string|bool|int {
        return get_post_meta($postId, $slug, $single);
    }

    /**
     * Add value to meta
     * https://developer.wordpress.org/reference/functions/add_post_meta/
     * @param int $postId
     * @param string $slug
     * @param int|string|bool $value
     * @return bool
     */
    public function addValue(
        int $postId,
        string $slug,
        int|string|bool $value
    ): bool {
        return add_post_meta($postId, $slug, $value);
    }

    /**
     * Check exist value in meta
     *
     * @param int $postId
     * @param string $slug
     * @return bool
     */
    public function hasValue(
        int $postId,
        string $slug,
    ): bool {
        return !empty($this->getValue($postId, $slug));
    }

    /**
     * Update Meta Field
     * https://developer.wordpress.org/reference/functions/update_post_meta/
     * @param int $postId
     * @param string $slug
     * @param int|string|bool $value
     * @return bool
     */
    public function updateValue(
        int $postId,
        string $slug,
        int|string|bool $value
    ): bool {
        return update_post_meta($postId, $slug, $value);
    }

    /**
     * Delete Meta field
     * https://developer.wordpress.org/reference/functions/delete_post_meta/
     * @param int $postId
     * @param string $slug
     * @return bool
     */
    public function deleteValue(
        int $postId,
        string $slug,
    ): bool {
        return delete_post_meta($postId, $slug);
    }
}
