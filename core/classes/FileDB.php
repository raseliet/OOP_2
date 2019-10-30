<?php

namespace Core;

class FileDB {
	private $file_name;
	private $data;
	public function __construct($file_name) {
		$this->file_name = $file_name;
		$this->load();
	}
	/**
	 * Loads data array from file to $this->data
	 */
	public function load() {
		$this->data = file_to_array($this->file_name);
	}
	/**
	 * Saves $this->data array to file
	 * @return bool
	 */
	public function save(): bool {
		return array_to_file($this->data, $this->file_name);
	}
	public function getData() {
		if ($this->data == null) {
			$this->load();
		}
		return $this->data;
	}
	public function setData($data_array) {
		$this->data = $data_array;
	}
	/**
	 * Check if table exists
	 * @param string $table_name
	 * @return boolean
	 */
	public function tableExists(string $table_name) {
		if (isset($this->data[$table_name])) {
			return true;
		}
		return false;
	}
	/**
	 * Create a table
	 * @param string $table_name
	 * @return boolean
	 */
	public function createTable($table_name) {
		if (!$this->tableExists($table_name)) {
			$this->data[$table_name] = [];
			return true;
		}
		return false;
	}
	/**
	 * Delete table from database
	 * @param string $table_name
	 * @return boolean
	 */
	public function dropTable($table_name) {
		unset($this->data[$table_name]);
		return true;
	}
	/**
	 * Delete all table content
	 * @param string $table_name
	 * @return boolean
	 */
	public function truncateTable($table_name) {
		if ($this->tableExists($table_name)) {
			$this->data[$table_name] = [];
			return true;
		}
		return false;
	}
	/**
     * Ši f-ja į pasirinktą Table, nauju arba nurodytu indeksu įdeda row masyvą.
     * @param string $table
     * @param array $row
     * @return bool|int
     */
    public function insertRow($table_name, $row, $row_id = null) {
        if ($row_id !== null) {
            if (!isset($this->data[$table_name][$row_id])) {
                $this->data[$table_name][$row_id] = $row;
                return $row_id;
            }
            return false;
        } else {
            $this->data[$table_name][] = $row;
            // surandame pask. indeksa
            end($this->data[$table_name]);
            $row_id = key($this->data[$table_name]);
            return $row_id;
        }
	}
	/**
	 * Check if row exists in table
	 * @param string $table
	 * @param int $row_id
	 * @return boolean
	 */
	public function rowExists(string $table, int $row_id): bool {
		if (isset($this->data[$table][$row_id])) {
			return true;
		}
		return false;
	}
	/**
	 * Update row content in a given row_id
	 * @param string $table
	 * @param int $row_id
	 * @param array $row
	 * @return boolean
	 */
	public function updateRow(string $table, int $row_id, array $row): bool {
		if ($this->rowExists($table, $row_id)) {
			$this->data[$table][$row_id] = $row;
			return true;
		}
		
		return false;
	}
	
	/**
	 * Create a row it it doesn't exist in table
	 * @param string $table
	 * @param int $row_id
	 * @param array $row
	 * @return boolean
	 */
	public function insertRowIfNotExists(string $table, int $row_id, array $row): bool {
		if (!$this->rowExists($table, $row_id)) {
			return $this->insertRow($table, $row, $row_id); // insertRow function returns boolean
		}
		
		return false;
	}
	
	/**
	 * Delete row from table
	 * @param string $table
	 * @param int $row_id
	 * @return boolean
	 */
	public function deleteRow(string $table, int $row_id) {
		if ($this->rowExists($table, $row_id)) {
			unset($this->data[$table][$row_id]);
			return true;
		}
		
		return false;
	}
	public function getRowsWhere(string $table, array $conditions) {
		$rows = [];
		
		foreach ($this->data[$table] as $row_id => $row) {
			$success = true;
			
			foreach ($conditions as $condition_id => $condition) {
				if ($row[$condition_id] !== $condition) {
					$success = false;
					break;
				}
			}
			if ($success) {
				$row['row_id'] = $row_id;
				$rows[$row_id] = $row;
			}
		}
		return $rows;
	}
	public function __destruct() {
		$this->save();
	}
	
}

