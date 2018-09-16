<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class ConstrainsPostalcodeValidator
 * @package App\Validator\Constraints
 */
class ConstrainsPostalcodeValidator extends ConstraintValidator
{

    /**
     * @param mixed $value
     * @param Constraint|ConstrainsPostalcode $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (!preg_match('#^[0-9]{5}$#', $value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ postal_code }}', $value)
                ->addViolation();
        }
    }

}