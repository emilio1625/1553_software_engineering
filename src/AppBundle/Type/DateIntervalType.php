<?php
/**
 * Copyright (c) 2017. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 4/01/17 02:40 PM
 *
 */

/**
 * Created by PhpStorm.
 * User: emilio1625
 * Date: 4/01/17
 * Time: 02:40 PM
 */

namespace AppBundle\Type;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;


/**
 * Type that maps interval string to a PHP DateInterval Object.
 */
class DateIntervalType extends Type
{
    const DATEINTERVAL = 'dateinterval';

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::DATEINTERVAL;
    }

    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $fieldDeclaration['length'] = 20;
        $fieldDeclaration['fixed']  = true;
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }
        if ($value instanceof \DateInterval) {
            return 'P'
                . str_pad($value->y, 4, '0', STR_PAD_LEFT) . '-'
                . $value->format('%M-%DT%H:%I:%S');
        }
        throw ConversionException::conversionFailed($value, $this->getName());
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value || $value instanceof \DateInterval) {
            return $value;
        }
        try {
            return new \DateInterval($value);
        } catch (\Exception $exception) {
            throw ConversionException::conversionFailedFormat($value, $this->getName(), 'PY-m-dTH:i:s');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
