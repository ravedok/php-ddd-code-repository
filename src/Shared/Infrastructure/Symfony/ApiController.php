<?php

namespace Ravedok\Shared\Infrastructure\Symfony;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class ApiController
{
    private ValidatorInterface $validator;
    private SerializerInterface $serializer;

    protected function getAndValidateDto(Request $request, string $dtoClassName): mixed
    {
        $dto = $this->serializer->deserialize($request->getContent(), $dtoClassName, 'json', [
            DenormalizerInterface::COLLECT_DENORMALIZATION_ERRORS => true,
        ]);

        $errors = $this->validator->validate($dto);

        if ($errors->count() > 0) {
            throw new ValidationFailedException($dto, $errors);
        }

        return $dto;
    }

    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }    
}
