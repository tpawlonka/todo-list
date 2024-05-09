<?php
namespace App\Validator;

use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

#[\Attribute]
class NameLengthValidator extends ConstraintValidator {

    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof NameLength) {
            throw new UnexpectedTypeException($constraint, NameLength::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }


        if (strlen($value) <= $constraint->minLength) {
            $this->context
                ->buildViolation(new TranslatableMessage('name.len.min', [], 'validators'))
                ->setParameter('{{ string }}', (string)$constraint->minLength)
                ->addViolation();
        }

        if (strlen($value) > $constraint->maxLength) {
            $this->context
                ->buildViolation(new TranslatableMessage('name.len.max', [], 'validators'))
                ->setParameter('{{ string }}', (string)$constraint->maxLength)
                ->addViolation();
        }

    }
}
