<?php
namespace SDataGrid\Interfaces;

interface InterfaceColumn
{

    /**
     * @return callable
     */
    public function getCallback();

    /**
     * @return callable
     */
    public function getFooterCallback();

    /**
     * @return string
     */
    public function getDisplayName();

    /**
     * @return string
     */
    public function getValueName();

    /**
     * @return array
     */
    public function getHeaderAttributes();

    /**
     * @return array
     */
    public function getBodyAttributes();

    /**
     * @return array
     */
    public function getFooterAttributes();

    /**
     * @return string
     */
    public function getHeaderAttributesAsString();

    /**
     * @return string
     */
    public function getBodyAttributesAsString();

    /**
     * @return string
     */
    public function getFooterAttributesAsString();

    /**
     * @return bool
     */
    public function hasHeaderAttributes();

    /**
     * @return bool
     */
    public function hasBodyAttributes();

    /**
     * @return bool
     */
    public function hasFooterAttributes();

    /**
     * @return bool
     */
    public function hasCallback();

    /**
     * @return bool
     */
    public function hasFooterCallback();

    /**
     * @return bool
     */
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
     * @param array $footerAttributes
     * @return InterfaceColumn
     */
    public function setFooterAttributes($footerAttributes = []);

    /**
     * @param InterfaceDataGrid $DataGrid
     * @return InterfaceColumn
     */
    public function setDataGrid(InterfaceDataGrid $DataGrid);

    /**
     * @param callable $callback
     * @return InterfaceColumn
     */
    public function setCallback(callable $callback);

    /**
     * @param callable $callback
     * @return InterfaceColumn
     */
    public function setFooterCallback(callable $callback);

}