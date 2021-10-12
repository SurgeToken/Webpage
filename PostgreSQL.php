<?php

namespace SurgePostgreSQL;

class PostgreSQL {
    
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    //update function
    public function updateToken($token_symbol, $token_holders, $token_price, $token_price_underlying) {

        // sql statement to update a row in the stock table
        $sql = 'UPDATE tokens '
                . 'SET token_holders = :token_holders, '
                . 'token_price = :token_price, '
                . 'token_price_underlying = :token_price_underlying '
                . 'WHERE token_symbol = :token_symbol';

        $stmt = $this->pdo->prepare($sql);

        // bind values to the statement
        $stmt->bindValue(':token_holders', $token_holders);
        $stmt->bindValue(':token_price', $token_price);
        $stmt->bindValue(':token_price_underlying', $token_price_underlying);
        $stmt->bindValue(':token_symbol', $token_symbol);

        // update data in the database
        $stmt->execute();

        // return the number of row affected
        return $stmt->rowCount();
    }

    //read function
    public function all() {
        $stmt = $this->pdo->query('SELECT token_address, token_price, token_holders, token_symbol '
                . 'FROM tokens '
                . 'ORDER BY token_id');
        $tokens = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $tokens[] = [
                'token_address' => $row['token_address'],
                'token_symbol' => $row['token_symbol'],
                'token_holders' => $row['token_holders'],
                'token_price' => $row['token_price']
                
            ];
        }
        return $tokens;
    }
}
?>