<?php
interface InterfaceDataGrid
{

    /**
     * @param InterfaceColumn $Column
     * @return InterfaceDataGrid
     */
    public function addColumn(InterfaceColumn $Column);

    /**
     * @return InterfaceColumn[]
     */
    public function getColumns();

    public function getAttributes();

    public function getAttributesAsString();

    public function getCaption();

    /**
     * @return array
     */
    public function getDataSet();

    public function hasAttributes();


    /**
     * @param $caption
     * @return InterfaceDataGrid
     */
    public function setCaption($caption);

    /**
     * @param array $attributes
     * @return InterfaceDataGrid
     */
    public function setAttributes($attributes = []);

    /**
     * @param array $dataSet
     * @return InterfaceDataGrid
     */
    public function setDataSet(array $dataSet);

    public function run();

}