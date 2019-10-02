<?php
/*
   Handles database access for the Image Details table. 

 */
 class ImageDB {  
    
    private $pdo = null;
    
    private static $baseSQL = "SELECT * FROM ImageDetails";
    private static $constraint = ' ORDER BY ImageID';
    
    public function __construct($connection) {
        $this->pdo =  $connection;
    }      

    public function findById($id)
    {
        $sql = self::$baseSQL .  ' WHERE ImageID=? ';
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($id));
        return $statement;
        // return $statement->_____________;
    }
    
    public function getAll()
    {
        $sql = self::$baseSQL . self::$constraint;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement;        
    }  
    
    
    public function findByCountry($country)
    {
        $sql = self::$baseSQL .  ' WHERE CountryCodeISO = ? '; //....
        $results = DatabaseHelper::runQuery($this->pdo, $sql, Array($country)); //...
        return $results->fetchAll();
    }    
    
    public function findByContinent($continent)
    {
        $sql = self::$baseSQL .  ' WHERE ContinentCode = ? ';
        $results = DatabaseHelper::runQuery($this->pdo, $sql, array($continent));
        
        return $results->fetchAll();
    }      
    
    public function findLikeTitle($title)
    {
        $sql = self::$baseSQL .  ' WHERE Title LIKE ? ';
        $filter = '%' . $title . '%';
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($filter)); // Array($title))??
        return $statement->fetchAll();
    }       

}

?>