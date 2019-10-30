<?php

namespace App\Drinks;

class Model {

    private $db;
    private $table_name = 'drinks';

    public function __construct() {
        
        \App\App::$db->createTable(\App\App::table_name);
    }

    public function insert(Drink $drink) {
        return \App\App::$db->insertRow(\App\App::table_name, $drink->getData());
    }

    public function get($conditions) {
        $drinks = [];
        $rows = \App\App::$db->getRowsWhere(\App\App::table_name, $conditions);
        foreach ($rows as $row) {
            $row['id'] = $row['row_id'];
            $drinks[] = new Drink($row);
        }
        return $drinks;
    }

    /**
     * Update selected drink
     * @param \App\Drinks\Drink $drink
     * @return bool
     */
    public function update(Drink $drink): bool {
        return \App\App::$db->updateRow(\App\App::table_name, $drink->getID(), $drink->getData());
    }

    public function deleteDrink(Drink $drink) {
        $drink_array = $drink->getData();

        return \App\App::$db->deleteRow(\App\App::table_name, $drink_array['id']);
    }

    /**
     * @return bool
     * Funkcija istrina visus Drink objektus esancius lenteleje.
     */
    public function delete(Drink $drink): bool {
        return \App\App::$db->deleteRow(\App\App::table_name, $drink->getID());
    }

}
