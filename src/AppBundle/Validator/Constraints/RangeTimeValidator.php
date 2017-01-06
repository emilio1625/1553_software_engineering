<?php
/**
 * Copyright (c) 2017. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 6/01/17 01:01 AM
 *
 */

/**
 * Created by PhpStorm.
 * User: emilio1625
 * Date: 6/01/17
 * Time: 01:01 AM
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;


class RangeTimeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof RangeTime) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\Range');
        }

        if (null === $value) {
            return;
        }

        if (!$value instanceof \DateTimeInterface) {
            $this->context->buildViolation($constraint->invalidMessage)
                ->setParameter('{{ value }}', $this->formatValue($value, self::PRETTY_DATE))
                ->addViolation();

            return;
        }

        $min = $constraint->min;
        $max = $constraint->max;

        if (is_string($min)) {
            $min = new \DateTime('2000-00-00 ' . $min);
        }
        $unixMin = strtotime($min->format('H:i:s'));

        if (is_string($max)) {
            $max = new \DateTime('2000-00-00 ' . $max);
        }

        $unixMax = strtotime($max->format('H:i:s'));
        $unixValue = strtotime($value->format('H:i:s'));

        if (null !== $constraint->max && $unixValue > $unixMax) {
            $this->context->buildViolation($constraint->maxMessage)
                ->setParameter('{{ value }}', $this->formatValue($value, self::PRETTY_DATE))
                ->setParameter('{{ limit }}', $this->formatValue($max, self::PRETTY_DATE))
                ->addViolation();

            return;
        }

        if (null !== $constraint->min && $unixValue < $unixMin) {
            $this->context->buildViolation($constraint->minMessage)
                ->setParameter('{{ value }}', $this->formatValue($value, self::PRETTY_DATE))
                ->setParameter('{{ limit }}', $this->formatValue($min, self::PRETTY_DATE))
                ->addViolation();
        }
    }
}
