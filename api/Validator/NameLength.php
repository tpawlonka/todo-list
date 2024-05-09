<?php
namespace App\Validator;

use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Symfony\Component\Validator\Constraint;
use Symfony\Contracts\Translation\TranslatorInterface;

#[\Attribute]
class NameLength extends Constraint {

    public int $minLength;
    public int $maxLength;

    #[HasNamedArguments]
    public function __construct(int $minLength = 0, int $maxLength = 150, mixed $options = null, ?array $groups = null,
                                mixed $payload = null)
    {
        parent::__construct($options, $groups, $payload);
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }
}
