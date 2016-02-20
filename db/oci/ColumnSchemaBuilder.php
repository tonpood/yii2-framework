<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\db\oci;

use yii\db\ColumnSchemaBuilder as AbstractColumnSchemaBuilder;

/**
 * ColumnSchemaBuilder is the schema builder for Oracle databases.
 *
 * @author Vasenin Matvey <vaseninm@gmail.com>
 * @since 2.0.6
 */
class ColumnSchemaBuilder extends AbstractColumnSchemaBuilder
{
    /**
     * @inheritdoc
     */
    protected function buildUnsignedString()
    {
        return $this->isUnsigned ? ' UNSIGNED' : '';
    }

    /**
     * @inheritdoc
     */
    protected function buildAfterString()
    {
        return $this->after !== null ? " AFTER ('{$this->after}')" : '';
    }

    /**
     * @inheritdoc
     */
    protected function buildFirstString()
    {
        return $this->isFirst ? ' FIRST' : '';
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        switch ($this->getTypeCategory()) {
            case self::CAT_PK:
                $format = '{type}{length}{pos}';
                break;
            case self::CAT_NUMERIC:
                $format = '{type}{length}{unsigned}{default}{notnull}{check}{pos}';
                break;
            default:
                $format = '{type}{length}{default}{notnull}{check}{pos}';
        }
        return $this->buildCompleteString($format);
    }
}
