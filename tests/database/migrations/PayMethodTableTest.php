<?php

class PayMethodTableTest extends TestCase{
    /** @var string $table pay_method*/
    protected $table = 'pay_methods';

    /** @var array $column nombres de los campos de la tabla*/
    protected $columns =[
        'id',
        'name'
    ];

    /**
    *   Verificar si existe una tabla en la base de datos
    *
    *   @return void
    */
    public function testCheckingForTable(){
        $this -> assertTrue(Schema::hasTable($this->table));
    }

    /**
    *   Verificar los campos de una tabla
    *
    *   @return void
    */

    public function testCheckingForColumnInATable(){
        for($i = 0; count($this->columns) > $i; $i++){
            $this->assertTrue(Schema::hasColumn($this->table, $this->columns[$i]));
        }
    }
}

?>