<?php

declare(strict_types=1);

namespace Ravedok\Shared\Infrastructure\Symfony;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;

final class ValidationErrorToJsonSubscriber implements EventSubscriberInterface
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onException',
        ];
    }

    public function onException(ExceptionEvent $event): void
    {
        if (!$this->isValidationException($event)) {
            return;
        }

        if (!$this->isJsonRequest($event)) {
            return;
        }

        $response = $this->createJsonReponse($event);

        $event->setResponse($response);
    }

    private function isValidationException(ExceptionEvent $event): bool
    {
        $exception = $event->getThrowable();

        return $exception instanceof ValidationFailedException;
    }

    private function isJsonRequest(ExceptionEvent $event): bool
    {
        $request = $event->getRequest();

        return 'json' === $request->getContentType();
    }

    private function createJsonReponse(ExceptionEvent $event): Response
    {
        /** @var ValidationFailedException */
        $exception = $event->getThrowable();
        $violations = $exception->getViolations();

        $data = $this->serializer->serialize($violations, 'json', array_merge([
            'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
        ]));

        return new JsonResponse($data, Response::HTTP_BAD_REQUEST, [], true);
    }
}
