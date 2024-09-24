<?php

namespace App\Validator;

use DateTime;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use UnexpectedValueException;

#[\Attribute]
class GreaterThanTodayValidator extends ConstraintValidator
{
    public function validate(mixed $endedAt, Constraint $constraint): void
    {
        if (!$endedAt instanceof DateTime) {
            throw new UnexpectedValueException($endedAt, DateTime::class);
        }

        if($endedAt < (new DateTime())){
            $this->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $endedAt->format('d/m/Y'))
                ->addViolation();
        }
    }
}
