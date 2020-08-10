<?php
namespace Tests;


use Config\Config;
use Config\Params\Parameter;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{

    public function testGetParametersConnect(): void
    {
      $parameters = new Parameter();
      $config = new  Config();
      $this->assertCount(1, $parameters->parametersConnectBdd());
      $this->assertCount(4, $config->getParametersConnect());
      $connectBdd = $config->getParametersConnect();
      var_dump($connectBdd['host']);
    }
}
