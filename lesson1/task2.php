<?php
class Db {
    protected $tableName;
    protected $params = [];

    public function table($table){
        $this->tableName = $table;
        return $this;
    }
    public function getOne($id){
        return "SELECT * FROM  $this->tableName WHERE id = $id <br>";
    }
    public function getAll(){
        $sql = "SELECT * FROM  $this->tableName";

        if (!empty ($this->params)){
            $sql .= " WHERE ";
            foreach ($this->params as $value){
                $sql .= $value['param'] . " = " . $value['value'];
                if ($value != end($this->params)){
                    $sql .= " AND ";
                }
            }
        }
        return $sql . "<br>";
    }
    public function where($param, $value){
       $this -> params[] = [
           'param' => $param,
           'value' => $value
       ];
       return $this;
    }
    public function andWhere($param, $value){
        $this->andWhere = " AND $param = $value";
    }
}
$db= new Db();

echo $db->table('product')->getOne(1);
echo $db->table('product')->getAll();

echo $db->table('product')->where('name', 'Alex')->where('session', 123)->where('id', 5)->getAll();
