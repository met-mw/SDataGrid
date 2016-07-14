<?php
namespace SDataGrid;

interface DataGridInterface
{

    /**
     * @param ColumnInterface $Column
     * @return DataGridInterface
     */
    public function addColumn(ColumnInterface $Column);

    /**
     * @return ColumnInterface[]
     */
    public function getColumns();

    /**
     * @return array
     */
    public function getAttributes();

    /**
     * @return string
     */
    public function getAttributesAsString();

    /**
     * @return string
     */
    public function getCaption();

    /**
     * @return array
     */
    public function getDataSet();

    /**
     * @return bool
     */
    public function hasAttributes();

    /**
     * @return bool
     */
    public function hasCaption();


    /**
     * @param $caption
     * @return DataGridInterface
     */
    public function setCaption($caption);

    /**
     * @param array $attributes
     * @return DataGridInterface
     */
    public function setAttributes(array $attributes = []);

    /**
     * @param array $dataSet
     * @return DataGridInterface
     */
    public function setDataSet(array $dataSet = []);

    /**
     * @return void
     */
    public function render();

    /**
     * @return string
     */
    public function get();

}