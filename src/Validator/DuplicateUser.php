<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class DuplicateUser extends Constraint
{
    public $message = 'Email : "{{ string }}" : already exists.';

    public function validatedBy()
    {
        return static::class.'Validator';
    }

    public function getTargets()
    {
        //return self::CLASS_CONSTRAINT;
        return self::PROPERTY_CONSTRAINT;
    }
}