<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class RunnerTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function runStackedHttpKernel()
    {
        $app = $this->getStackedHttpKernelMock(new Response('ok'));
        $runner = new Runner($app);

        $request = Request::create('/');
        $runner->run($request);
    }

    private function getStackedHttpKernelMock(Response $response)
    {
        $app = $this->getMockBuilder('Stack\StackedHttpKernel')
            ->disableOriginalConstructor()
            ->getMock();
        $app->expects($this->any())
            ->method('handle')
            ->with($this->isInstanceOf('Symfony\Component\HttpFoundation\Request'))
            ->will($this->returnValue($response));

        $app->expects($this->any())
            ->method('terminate')
            ->with($this->isInstanceOf('Symfony\Component\HttpFoundation\Request'))
            ->will($this->returnValue($response));
        return $app;
    }
}
