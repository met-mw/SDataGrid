<?php


use SDataGrid\Classes\Column;
use SDataGrid\Classes\DataGrid;

class DataGridColumnTest extends PHPUnit_Framework_TestCase
{

    public function testGetters()
    {
        $DataGrid = new DataGrid();
        $Column = new Column($DataGrid);
        $Column->setHeaderAttributes(['test_attribute1' => 'test_data1', 'test_attribute2' => 'test_data2'])
            ->setBodyAttributes(['test_attribute1' => 'test_data1', 'test_attribute2' => 'test_data2'])
            ->setFooterAttributes(['test_attribute1' => 'test_data1', 'test_attribute2' => 'test_data2'])
            ->setCallback(function ($number, $data) {})
            ->setFooterCallback(function ($data) {})
            ->setDisplayName('test_column_name')
            ->setValueName('test_column_value_name');

        $this->assertEquals(['test_attribute1' => 'test_data1', 'test_attribute2' => 'test_data2'], $Column->getHeaderAttributes());
        $this->assertEquals(['test_attribute1' => 'test_data1', 'test_attribute2' => 'test_data2'], $Column->getBodyAttributes());
        $this->assertEquals(['test_attribute1' => 'test_data1', 'test_attribute2' => 'test_data2'], $Column->getFooterAttributes());
        $this->assertEquals('test_attribute1="test_data1" test_attribute2="test_data2"', $Column->getHeaderAttributesAsString());
        $this->assertEquals('test_attribute1="test_data1" test_attribute2="test_data2"', $Column->getBodyAttributesAsString());
        $this->assertEquals('test_attribute1="test_data1" test_attribute2="test_data2"', $Column->getFooterAttributesAsString());

        $this->assertEquals('test_column_name', $Column->getDisplayName());
        $this->assertEquals('test_column_value_name', $Column->getValueName());
        $this->assertSame($DataGrid, $Column->getDataGrid());

        $this->assertTrue(is_callable($Column->getCallback()));
        $this->assertTrue(is_callable($Column->getFooterCallback()));
    }

    public function testHasMethods()
    {
        $DataGrid = new DataGrid();
        $Column = new Column($DataGrid);
        $Column->setHeaderAttributes(['test_attribute1' => 'test_data1', 'test_attribute2' => 'test_data2'])
            ->setBodyAttributes(['test_attribute1' => 'test_data1', 'test_attribute2' => 'test_data2'])
            ->setFooterAttributes(['test_attribute1' => 'test_data1', 'test_attribute2' => 'test_data2'])
            ->setCallback(function ($number, $data) {})
            ->setFooterCallback(function ($data) {})
            ->setDisplayName('test_column_name')
            ->setValueName('test_column_value_name');

        $this->assertTrue($Column->hasHeaderAttributes());
        $this->assertTrue($Column->hasBodyAttributes());
        $this->assertTrue($Column->hasFooterCallback());
        $this->assertTrue($Column->hasCallback());
        $this->assertTrue($Column->hasFooterCallback());
    }

    public function testCallbacks() {
        $self = $this;

        $DataGrid = new DataGrid();
        $Column = new Column($DataGrid);
        $Column->setCallback(function ($number, $data) use ($self) {
                $self->assertEquals(2, func_num_args());
                $self->assertTrue(is_integer($number));
                $self->assertTrue($number > 0);
                $self->assertTrue(is_array($data));
            })
            ->setFooterCallback(function ($data) use ($self) {
                $self->assertEquals(1, func_num_args());
                $self->assertTrue(is_array($data));
            });

        $callback = $Column->getCallback();
        $callback(1, []);
        $footerCallback = $Column->getFooterCallback();
        $footerCallback([]);
    }

    public function testExceptions()
    {
        $Column = new Column();

        $throw = false;
        try {
            $Column->setDisplayName(10);
        } catch(InvalidArgumentException $e) {
            $throw = true;
        }
        if (!$throw) {
            $this->fail('Set display name exception is not thrown.');
        }

        $throw = false;
        try {
            $Column->setValueName(10);
        } catch(InvalidArgumentException $e) {
            $throw = true;
        }
        if (!$throw) {
            $this->fail('Set value name exception is not thrown.');
        }

        $throw = false;
        try {
            $Column->setCallback(function () {});
        } catch(InvalidArgumentException $e) {
            $throw = true;
        }
        if (!$throw) {
            $this->fail('Set callback exception is not thrown.');
        }

        $throw = false;
        try {
            $Column->setFooterCallback(function () {});
        } catch(InvalidArgumentException $e) {
            $throw = true;
        }
        if (!$throw) {
            $this->fail('Set footer callback exception is not thrown.');
        }
    }

}