<?php

declare(strict_types=1);

namespace AppTest\Handler;

use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Mostefa\MicroEcommerce\Application\Handler\HomePageHandler;
use Mostefa\MicroEcommerce\Container\Application\Handler\HomePageHandlerFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;

class HomePageHandlerFactoryTest extends TestCase
{
    use ProphecyTrait;

    protected ObjectProphecy|ContainerInterface $container;

    protected function setUp(): void
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $router = $this->prophesize(RouterInterface::class);

        $this->container->get(RouterInterface::class)->willReturn($router);
    }

    public function testFactoryWithoutTemplate()
    {
        $factory = new HomePageHandlerFactory();
        $this->container->has(TemplateRendererInterface::class)->willReturn(false);
        $this->assertInstanceOf(HomePageHandlerFactory::class, $factory);
        $homePage = $factory($this->container->reveal());

        $this->assertInstanceOf(HomePageHandler::class, $homePage);
    }

    public function testFactoryWithTemplate()
    {
        $this->container->has(TemplateRendererInterface::class)->willReturn(true);
        $this->container
            ->get(TemplateRendererInterface::class)
            ->willReturn($this->prophesize(TemplateRendererInterface::class));

        $factory = new HomePageHandlerFactory();

        $homePage = $factory($this->container->reveal());

        $this->assertInstanceOf(HomePageHandler::class, $homePage);
    }
}
