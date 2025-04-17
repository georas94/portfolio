<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
#[\Attribute] class BurkinaPhone extends Constraint
{
    public string $message = 'Le numéro "{{ value }}" n\'est pas un numéro burkinabè valide.';
}