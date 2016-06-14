<?php
namespace SDataGrid\Interfaces;

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
     * @return InterfaceDataGrid
     */
    public function setCaption($caption);

    /**
     * @param array $attributes
     * @return InterfaceDataGrid
     */
    public function setAttributes(array $attributes = []);

    /**
     * @param array $dataSet
     * @return InterfaceDataGrid
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