<?php
use SkateHub\Enviroment;

class EnviromentTest extends PHPUnit_Framework_TestCase
{
    public function _enviromentVars()
    {
        return array(
            array('APPLICATION_ENVIROMENT', 'test', 'getName'),
            array('APPLICATION_SALT', 'test', 'getSalt'),
            array('APPLICATION_DB_HOST', 'test', 'getDatabaseHost'),
            array('APPLICATION_DB_USER', 'test', 'getDatabaseUser'),
            array('APPLICATION_DB_PASSWD', 'test', 'getDatabasePasswd'),
            array('APPLICATION_DB_NAME', 'test', 'getDatabaseName'),
            array('APPLICATION_DB_DRIVER', 'test', 'getDatabaseDriver')
        );
    }

    /**
     * @dataProvider _enviromentVars
     */
    public function testEnviromentConstantDeclarationAndUsage($name, $value, $method)
    {
        putenv("$name=$value");
        $this->assertEquals($value, getenv($name), 'Enviroment not set correctly');
        $object = new Enviroment();
        $this->assertEquals($value, $object->$method(), "$method returing something different from expected");
    }

    public function testGetDatabaseEnviromentWithoutArguments()
    {
        foreach ($this->_enviromentVars() as $args) {
            list($name, $value) = $args;
            putenv("$name=$value");
        }
        $env = new Enviroment;
        $obj = $env->getDatabase();
        $this->assertInstanceOf('StdClass', $obj);
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testGetInvalidMethod()
    {
        $env = new Enviroment;
        $env->NonEcsiste();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetInvalidDatabaseEnviromentOption()
    {
        $env = new Enviroment;
        $env->getDatabase('non ecsiste!');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetInvalidDatabaseEnviromentOptionFromMagicMethod()
    {
        $env = new Enviroment;
        $env->getDatabaseNonEcsiste();
    }
}