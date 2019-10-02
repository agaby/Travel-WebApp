<?php
/*
   Handles database access for the Country table. 

 */
class CountryDB {  
    
    private $pdo = null;
    
    private static $baseSQL = "SELECT * FROM Countries";
    private static $constraint = ' order by ISONumeric';
    
    public function __construct($connection) {
        $this->pdo = $connection;
    }      

    public function findById($id)
    {
        $sql = self::$baseSQL .  ' WHERE ISONumeric=? ';
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($id)); //Array($id))??
        return $statement;
        // return $statement->;

    }
    
    public function getAll()
    {
        $sql = self::$baseSQL . self::$constraint;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement;        
    }   
    
    public function getWithImages()
    {
        $sql = "SELECT CountryName, CountryCodeISO FROM Countries INNER JOIN ImageDetails ON Countries.ISO = ImageDetails.CountryCodeISO  GROUP BY Countries.CountryName, ImageDetails.CountryCodeISO" . self::$constraint;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement;        
    }     

}

?>