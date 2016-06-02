<?php
namespace SDataGrid\Interfaces;

interface InterfaceColumn
{

    public function getDisplayName();
    public function getValueName();
    public function getCallback();
    public function getHeaderAttributes();
    public function getBodyAttributes();

    public function getHeaderAttributesAsString();
    public function getBodyAttributesAsString();

    public function hasHeaderAttributes();
    public function hasBodyAttributes();
    public function hasCallback();

    public function isCounter();

    /**
     * @return InterfaceColumn
     */
    public function switchOnCounter();

    /**
     * @return InterfaceColumn
     */
    public function switchOffCounter();

    /**
     * @return InterfaceDataGrid
     */
    public function getDataGrid();

    /**
     * @param $displayName
     * @return InterfaceColumn
     */
    public function setDisplayName($displayName);

    /**
     * @param $valueName
     * @return InterfaceColumn
     */
    public function setValueName($valueName);

    /**
     * @param array $headerAttributes
     * @return InterfaceColumn
     */
    public function setHeaderAttributes($headerAttributes = []);

    /**
     * @param array $bodyAttributes
     * @return InterfaceColumn
     */
    public function setBodyAttributes($bodyAttributes = []);

    /**
     * @param InterfaceDataGrid $DataGrid
     * @return InterfaceColumn
     */
    public function setDataGrid(InterfaceDataGrid $DataGrid);

    /**
     * @param $callback
     * @return InterfaceColumn
     */
    public function setCallback($callback);

}