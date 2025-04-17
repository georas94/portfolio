<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class BurkinaPhoneValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        // Nettoyer le numéro (supprimer espaces et indicatifs)
        $cleaned = preg_replace('/[^0-9]/', '', $value);
        $cleaned = preg_replace('/^226/', '0', $cleaned); // Convertit +226 en 0
        // Validation des numéros BF (70-79 suivis de 6 chiffres)
        if (!preg_match('/^((\+226|226|0)[567][0-9]{7}|[567][0-9]{7})$/', $cleaned)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}