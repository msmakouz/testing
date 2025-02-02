<?php

declare(strict_types=1);

namespace Spiral\Testing\Traits;

use Spiral\Exceptions\ExceptionHandlerInterface;
use Spiral\Exceptions\ExceptionRendererInterface;
use Spiral\Exceptions\Verbosity;

trait InteractsWithExceptions
{
    protected function withoutExceptionHandling(): void
    {
        $this->getContainer()->bind(
            ExceptionHandlerInterface::class,
            new class implements ExceptionHandlerInterface {
                public function register(): void
                {
                }

                public function handleGlobalException(\Throwable $e): void
                {
                }

                public function getRenderer(?string $format = null): ?ExceptionRendererInterface
                {
                    return $this;
                }

                public function render(
                    \Throwable $exception,
                    ?Verbosity $verbosity = Verbosity::BASIC,
                    string $format = null,
                ): string {
                    throw $exception;
                }

                public function canRender(string $format): bool
                {
                    return true;
                }

                public function report(\Throwable $exception,): void
                {
                    throw $exception;
                }
            }
        );
    }
}
