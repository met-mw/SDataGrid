<?php
namespace SDataGrid\Interfaces;

interface InterfaceColumn
{

    /**
     * @return callable(@param int $number, @param array $data)
     */
    public function getCallback();

    /**
     * @return callable(@param int $number, @param array $data)
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
     * @return array<string, string>
     */
    public function getHeaderAttributes();

    /**
     * @return array<string, string>
     */
    public function getBodyAttributes();

    /**
     * @return array<string, string>
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
     * @return InterfaceDataGrid
     */
    public function getDataGrid();

    /**
     * @param string $displayName
     * @return InterfaceColumn
     */
    public function setDisplayName($displayName);

    /**
     * @param string $valueName
     * @return InterfaceColumn
     */
    public function setValueName($valueName);

    /**
     * @param array<string, string> $headerAttributes
     * @return InterfaceColumn
     */
    public function setHeaderAttributes(array $headerAttributes = []);

    /**
     * @param array<string, string> $bodyAttributes
     * @return InterfaceColumn
     */
    public function setBodyAttributes(array $bodyAttributes = []);

    /**
     * @param array<string, string> $footerAttributes
     * @return InterfaceColumn
     */
    public function setFooterAttributes(array $footerAttributes = []);

    /**
     * @param InterfaceDataGrid $DataGrid
     * @return InterfaceColumn
     */
    public function setDataGrid(InterfaceDataGrid $DataGrid);

    /**
     * @param callable(@param int $number, @param array $data) $callback
     * @return InterfaceColumn
     */
    public function setCallback(callable $callback);

    /**
     * @param callable(@param int $number, @param array $data) $callback
     * @return InterfaceColumn
     */
    public function setFooterCallback(callable $callback);

}