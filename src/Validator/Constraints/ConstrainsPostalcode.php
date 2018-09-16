<?php

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ConstrainsPostalcode extends Constraint
{

    public $message = "The postal code {{ postal_code }} is not valid format";

}