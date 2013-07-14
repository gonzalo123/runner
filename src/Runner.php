<?php

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Stack\StackedHttpKernel;

class Runner
{
    private $kernel;

    public function __construct(StackedHttpKernel $kernel)
    {
        $this->kernel = $kernel;
    }

    public function run(Request $request = null)
    {
        if (null === $request) {
            $request = Request::createFromGlobals();
        }

        $response = $this->kernel->handle($request);
        $response->send();
        $this->kernel->terminate($request, $response);
    }
}