<?php
use SDataGrid\Classes\Column;
use SDataGrid\Classes\DataGrid;
use SDataGrid\Interfaces\InterfaceColumn;

class DataGridTest extends PHPUnit_Framework_TestCase
{

    public function testAddColumn()
    {
        $DataGrid = new DataGrid();
        $this->assertSame($DataGrid, $DataGrid->addColumn(new Column()));
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
        $this->assertTrue($DataGrid->getColumns()[0] instanceof InterfaceColumn);
    }

}