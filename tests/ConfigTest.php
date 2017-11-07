<?php

namespace Noodlehaus;

use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-04-21 at 22:37:22.
 */
class ConfigTest extends TestCase
{
	/**
	 * @var Config
	 */
	protected $config;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{
	}

	/**
	 * @covers                   \Noodlehaus\Config::load()
	 * @covers                   \Noodlehaus\Config::getParser()
	 * @expectedException        \Noodlehaus\Exception\UnsupportedFormatException
	 * @expectedExceptionMessage Unsupported configuration format
	 */
	public function testLoadWithUnsupportedFormat()
	{
		$config = Config::load( __DIR__ . '/mocks/fail/error.lib' );
		// $this->markTestIncomplete('Not yet implemented');
	}

	/**
	 * @covers                   \Noodlehaus\Config::__construct()
	 * @covers                   \Noodlehaus\Config::getParser()
	 * @expectedException        \Noodlehaus\Exception\UnsupportedFormatException
	 * @expectedExceptionMessage Unsupported configuration format
	 */
	public function testConstructWithUnsupportedFormat()
	{
		$config = new Config( __DIR__ . '/mocks/fail/error.lib' );
	}

	/**
	 * @covers                   \Noodlehaus\Config::__construct()
	 * @covers                   \Noodlehaus\Config::getParser()
	 * @covers                   \Noodlehaus\Config::getPathFromArray()
	 * @covers                   \Noodlehaus\Config::getValidPath()
	 * @expectedException        \Noodlehaus\Exception\FileNotFoundException
	 * @expectedExceptionMessage Configuration file: [ladadeedee] cannot be found
	 */
	public function testConstructWithInvalidPath()
	{
		$config = new Config( 'ladadeedee' );
	}

	/**
	 * @covers            \Noodlehaus\Config::__construct()
	 * @covers            \Noodlehaus\Config::getParser()
	 * @covers            \Noodlehaus\Config::getPathFromArray()
	 * @covers            \Noodlehaus\Config::getValidPath()
	 * @expectedException \Noodlehaus\Exception\EmptyDirectoryException
	 */
	public function testConstructWithEmptyDirectory()
	{
		$config = new Config( __DIR__ . '/mocks/empty' );
	}

	/**
	 * @covers \Noodlehaus\Config::__construct()
	 * @covers \Noodlehaus\Config::getParser()
	 * @covers \Noodlehaus\Config::getPathFromArray()
	 * @covers \Noodlehaus\Config::getValidPath()
	 */
	public function testConstructWithArray()
	{
		$paths  = array( __DIR__ . '/mocks/pass/config.xml', __DIR__ . '/mocks/pass/config2.json' );
		$config = new Config( $paths );

		$expected = 'localhost';
		$actual   = $config->get( 'host' );

		$this->assertEquals( $expected, $actual );
	}

	/**
	 * @covers            \Noodlehaus\Config::__construct()
	 * @covers            \Noodlehaus\Config::getParser()
	 * @covers            \Noodlehaus\Config::getPathFromArray()
	 * @covers            \Noodlehaus\Config::getValidPath()
	 * @expectedException \Noodlehaus\Exception\FileNotFoundException
	 */
	public function testConstructWithArrayWithNonexistentFile()
	{
		$paths  = array( __DIR__ . '/mocks/pass/config.xml', __DIR__ . '/mocks/pass/config3.json' );
		$config = new Config( $paths );

		$expected = 'localhost';
		$actual   = $config->get( 'host' );

		$this->assertEquals( $expected, $actual );
	}

	/**
	 * @covers \Noodlehaus\Config::__construct()
	 * @covers \Noodlehaus\Config::getParser()
	 * @covers \Noodlehaus\Config::getPathFromArray()
	 * @covers \Noodlehaus\Config::getValidPath()
	 */
	public function testConstructWithArrayWithOptionalFile()
	{
		$paths  = array( __DIR__ . '/mocks/pass/config.xml', '?' . __DIR__ . '/mocks/pass/config2.json' );
		$config = new Config( $paths );

		$expected = 'localhost';
		$actual   = $config->get( 'host' );

		$this->assertEquals( $expected, $actual );
	}

	/**
	 * @covers \Noodlehaus\Config::__construct()
	 * @covers \Noodlehaus\Config::getParser()
	 * @covers \Noodlehaus\Config::getPathFromArray()
	 * @covers \Noodlehaus\Config::getValidPath()
	 */
	public function testConstructWithArrayWithOptionalNonexistentFile()
	{
		$paths  = array( __DIR__ . '/mocks/pass/config.xml', '?' . __DIR__ . '/mocks/pass/config3.json' );
		$config = new Config( $paths );

		$expected = 'localhost';
		$actual   = $config->get( 'host' );

		$this->assertEquals( $expected, $actual );
	}

	/**
	 * @covers \Noodlehaus\Config::__construct()
	 * @covers \Noodlehaus\Config::getParser()
	 * @covers \Noodlehaus\Config::getPathFromArray()
	 * @covers \Noodlehaus\Config::getValidPath()
	 */
	public function testConstructWithDirectory()
	{
		$config = new Config( __DIR__ . '/mocks/dir' );

		$expected = 'localhost';
		$actual   = $config->get( 'host' );

		$this->assertEquals( $expected, $actual );
	}

	/**
	 * @covers \Noodlehaus\Config::__construct()
	 * @covers \Noodlehaus\Config::getParser()
	 * @covers \Noodlehaus\Config::getPathFromArray()
	 * @covers \Noodlehaus\Config::getValidPath()
	 */
	public function testConstructWithYml()
	{
		$config = new Config( __DIR__ . '/mocks/pass/config.yml' );

		$expected = 'localhost';
		$actual   = $config->get( 'host' );

		$this->assertEquals( $expected, $actual );
	}

	/**
	 * @covers \Noodlehaus\Config::__construct()
	 * @covers \Noodlehaus\Config::getParser()
	 * @covers \Noodlehaus\Config::getPathFromArray()
	 * @covers \Noodlehaus\Config::getValidPath()
	 */
	public function testConstructWithYmlDist()
	{
		$config = new Config( __DIR__ . '/mocks/pass/config.yml.dist' );

		$expected = 'localhost';
		$actual   = $config->get( 'host' );

		$this->assertEquals( $expected, $actual );
	}

	/**
	 * @covers \Noodlehaus\Config::__construct()
	 * @covers \Noodlehaus\Config::getParser()
	 * @covers \Noodlehaus\Config::getPathFromArray()
	 * @covers \Noodlehaus\Config::getValidPath()
	 */
	public function testConstructWithEmptyYml()
	{
		$config = new Config( __DIR__ . '/mocks/pass/empty.yaml' );

		$expected = array();
		$actual   = $config->all();

		$this->assertEquals( $expected, $actual );
	}

	/**
	 * @covers       \Noodlehaus\Config::__construct()
	 * @covers       \Noodlehaus\Config::get()
	 * @dataProvider specialConfigProvider()
	 */
	public function testGetReturnsArrayMergedArray( $config )
	{
		$this->assertCount( 4, $config->get( 'servers' ) );
	}

	/**
	 * Provides names of example configuration files
	 */
	public function configProvider()
	{
		return array_merge(
			array(
				array( new Config( __DIR__ . '/mocks/pass/config-exec.php' ) ),
				array( new Config( __DIR__ . '/mocks/pass/config.ini' ) ),
				array( new Config( __DIR__ . '/mocks/pass/config.json' ) ),
				array( new Config( __DIR__ . '/mocks/pass/config.php' ) ),
				array( new Config( __DIR__ . '/mocks/pass/config.xml' ) ),
				array( new Config( __DIR__ . '/mocks/pass/config.yaml' ) )
			)
		);
	}

	/**
	 * Provides names of example configuration files (for array and directory)
	 */
	public function specialConfigProvider()
	{
		return array(
			array(
				new Config(
					array(
						__DIR__ . '/mocks/pass/config2.json',
						__DIR__ . '/mocks/pass/config.yaml'
					)
				),
				new Config( __DIR__ . '/mocks/dir/' )
			)
		);
	}
}
