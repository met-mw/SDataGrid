<?php
namespace SDataGrid;

interface ColumnInterface
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
     * @return <string, string>[]
     */
    public function getHeaderAttributes();

    /**
     * @return <string, string>[]
     */
    public function getBodyAttributes();

    /**
     * @return <string, string>[]
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
     * @return DataGridInterface
     */
    public function getDataGrid();

    /**
     * @param string $displayName
     * @return ColumnInterface
     */
    public function setDisplayName($displayName);

    /**
     * @param string $valueName
     * @return ColumnInterface
     */
    public function setValueName($valueName);

    /**
     * @param <string, string>[] $headerAttributes
     * @return ColumnInterface
     */
    public function setHeaderAttributes(array $headerAttributes = []);

    /**
     * @param <string, string>[] $bodyAttributes
     * @return ColumnInterface
     */
    public function setBodyAttributes(array $bodyAttributes = []);

    /**
     * @param <string, string>[] $footerAttributes
     * @return ColumnInterface
     */
    public function setFooterAttributes(array $footerAttributes = []);

    /**
     * @param DataGridInterface $DataGrid
     * @return ColumnInterface
     */
    public function setDataGrid(DataGridInterface $DataGrid);

    /**
     * @param callable(@param int $number, @param array $data) $callback
     * @return ColumnInterface
     */
    public function setCallback(callable $callback);

    /**
     * @param callable(@param int $number, @param array $data) $callback
     * @return ColumnInterface
     */
    public function setFooterCallback(callable $callback);

}