<?php

namespace SurgePostgreSQL;

class PostgreSQL {
    
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    //update function
    public function updateToken($token_symbol, $token_holders) {

        // sql statement to update a row in the stock table
        $sql = 'UPDATE tokens '
                . 'SET token_holders = :token_holders '
                . 'WHERE token_symbol = :token_symbol';

        $stmt = $this->pdo->prepare($sql);

        // bind values to the statement
        $stmt->bindValue(':token_holders', $token_holders);
        $stmt->bindValue(':token_symbol', $token_symbol);

        // update data in the database
        $stmt->execute();

        // return the number of row affected
        return $stmt->rowCount();
    }

    public function updateFarm($farm_symbol, $farm_holders) {

        // sql statement to update a row in the stock table
        $sql = 'UPDATE farms '
                . 'SET farm_holders = :farm_holders '
                . 'WHERE farm_symbol = :farm_symbol';

        $stmt = $this->pdo->prepare($sql);

        // bind values to the statement
        $stmt->bindValue(':farm_holders', $farm_holders);
        $stmt->bindValue(':farm_symbol', $farm_symbol);

        // update data in the database
        $stmt->execute();

        // return the number of row affected
        return $stmt->rowCount();
    }

    //read function
    public function all() {
        $stmt = $this->pdo->query('SELECT token_address, token_holders, token_symbol '
                . 'FROM tokens '
                . 'ORDER BY token_id');
        $tokens = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $tokens[] = [
                'token_address' => $row['token_address'],
                'token_symbol' => $row['token_symbol'],
                'token_holders' => $row['token_holders']
                
            ];
        }
        return $tokens;
    }
}
?>