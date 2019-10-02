<?php 
class ContinentDB {  
    
    private $pdo = null;
    
    private static $baseSQL = "SELECT * FROM Continents";
    private static $constraint = ' order by ContinentCode'; //not sure
    
    public function __construct($connection) {
        $this->pdo = $connection;
    }      

    public function findById($id)
    {
        $sql = self::$baseSQL .  ' WHERE ContinentCode=? ';
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($id)); //Array($id))??
        return $statement;
        
    }
    
    public function getAll()
    {
        $sql = self::$baseSQL . self::$constraint; //msh fahma eh da
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return  $statement;        
    }    

}

?>