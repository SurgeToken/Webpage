<?php

namespace SurgePostgreSQL;

class PostgreSQL {
    
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function updateToken($symbol, $token_holders, $token_price) {

        // sql statement to update a row in the stock table
        $sql = 'UPDATE tokens '
                . 'SET token_holders = :token_holders, '
                . 'token_price = :token_price '
                . 'WHERE symbol = :symbol';

        $stmt = $this->pdo->prepare($sql);

        // bind values to the statement
        $stmt->bindValue(':token_holders', $token_holders);
        $stmt->bindValue(':token_price', $token_price);
        $stmt->bindValue(':symbol', $symbol);
        // update data in the database
        $stmt->execute();

        // return the number of row affected
        return $stmt->rowCount();
    }
}
?>