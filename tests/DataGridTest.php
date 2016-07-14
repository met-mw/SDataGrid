<?php
use SDataGrid\Column;
use SDataGrid\ColumnInterface;
use SDataGrid\DataGrid;

class DataGridTest extends PHPUnit_Framework_TestCase
{

    public function testAddColumn()
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

        $this->assertSame($DataGrid, $DataGrid->addColumn($Column));
        $this->assertSame($Column, $DataGrid->getColumns()[0]);

        $this->assertTrue($Column->hasHeaderAttributes());
        $this->assertTrue($Column->hasBodyAttributes());
        $this->assertTrue($Column->hasFooterAttributes());
        $this->assertTrue($Column->hasCallback());
        $this->assertTrue($Column->hasFooterCallback());

        $this->assertTrue(is_callable($Column->getCallback()));
        $this->assertTrue(is_callable($Column->getFooterCallback()));
    }

    public function testSettings()
    {
        $DataGrid = new DataGrid();
        $this->assertSame($DataGrid, $DataGrid->setCaption('test_caption'));
        $this->assertSame($DataGrid, $DataGrid->setDataSet([['test_data_row1'], ['test_data_row2']]));
        $this->assertSame($DataGrid, $DataGrid->setAttributes(['test_attribute1' => 'test_attribute_data1', 'test_attribute2' => 'test_attribute_data2']));
    }

    public function testGetters()
    {
        $DataGrid = new DataGrid([['test_data_row1'], ['test_data_row2']], 'test_caption');
        $DataGrid->setAttributes(['test_attribute1' => 'test_attribute_data1', 'test_attribute2' => 'test_attribute_data2'])
            ->addColumn(new Column())
            ->addColumn(new Column())
            ->addColumn(new Column());

        $this->assertEquals('test_caption', $DataGrid->getCaption());
        $this->assertEquals([['test_data_row1'], ['test_data_row2']], $DataGrid->getDataSet());
        $this->assertEquals(['test_attribute1' => 'test_attribute_data1', 'test_attribute2' => 'test_attribute_data2'], $DataGrid->getAttributes());
        $this->assertEquals('test_attribute1="test_attribute_data1" test_attribute2="test_attribute_data2"', $DataGrid->getAttributesAsString());
        $this->assertEquals(3, sizeof($DataGrid->getColumns()));
        $this->assertTrue($DataGrid->getColumns()[0] instanceof ColumnInterface);
    }

    public function testHasMethods()
    {
        $DataGrid = new DataGrid([['test_data_row1'], ['test_data_row2']], 'test_caption');
        $DataGrid->setAttributes(['test_attribute1' => 'test_attribute_data1', 'test_attribute2' => 'test_attribute_data2']);

        $this->assertTrue($DataGrid->hasCaption());
        $this->assertTrue($DataGrid->hasAttributes());
    }

    public function testExceptions()
    {
        $DataGrid = new DataGrid();
        $throw = false;
        try {
            $DataGrid->setCaption(10);
        } catch (InvalidArgumentException $e) {
            $throw = true;
        }
        if (!$throw) {
            $this->fail('Set caption exception is not thrown.');
        }
    }

    public function testRender()
    {
        $DataGrid = new DataGrid();

        $DOMDocument = new DOMDocument();
        $DOMDocument->validateOnParse = false;
        $DOMDocument->loadHTML($DataGrid->get());
        $ul = $DOMDocument->getElementsByTagName('table')->item(0);
        $this->assertEquals('table', $ul->localName);
    }

}