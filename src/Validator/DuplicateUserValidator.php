<?php

namespace App\Validator;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

// https://stackoverflow.com/questions/55971393/symfony-4-uniqueentity-constraint-doesnt-display-message-error
class DuplicateUserValidator extends ConstraintValidator
{
    private $em;

    /**
     * DuplicateUserValidator constructor.
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof DuplicateUser) {
            throw new UnexpectedTypeException($constraint, DuplicateUser::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            // throw this exception if your validator cannot handle the passed type so that it can be marked as invalid
            throw new UnexpectedValueException($value, 'string');

            // separate multiple types using pipes
            // throw new UnexpectedValueException($value, 'string|int');
        }


        /*
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ string }}', $value)
            ->addViolation()
        ;
        */


        /*
         $qb = $this->em->createQueryBuilder();

        $qb->select('u.email')
            ->from(User::class, 'u')
            ->where(User::class, 'u')
        ;

        $email = $qb->getQuery()->execute();

        if ($value == $email) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
         */
    }
}