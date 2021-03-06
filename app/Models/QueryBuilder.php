<?php
namespace App\Models;
use Aura\SqlQuery\QueryFactory;
use PDO;

class QueryBuilder {
    private $pdo, $queryFactory;
    public function __construct(PDO $pdo, QueryFactory $queryFactory){
        $this->pdo = $pdo;
        $this->queryFactory = $queryFactory;
    }

    public function selectAll($table, $id = null) {
        $select = $this->queryFactory->newSelect();
        $select
            ->cols(['*'])
            ->from($table)
            ->setPaging(3)
            ->page($id);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectOne($table, $id) {
        $select = $this->queryFactory->newSelect();
        $select
            ->cols(['*'])
            ->from($table)
            ->where('id = :id')
            ->bindValue('id', $id);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
    public function selectOneByEmail($table, $data) {
        $select = $this->queryFactory->newSelect();
        $select
            ->cols(['*'])
            ->from($table)
            ->where('email = :email')
            ->bindValue('email', $data['email']);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
    public function insert($table, $data) {
        $insert = $this->queryFactory->newInsert();
        $insert->into($table)
               ->cols($data);
        $sth = $this->pdo->prepare($insert->getStatement());
        $sth->execute($insert->getBindValues());

    }
    public function update($table, $id, $data) {
        $update = $this->queryFactory->newUpdate();
        $update
            ->table($table)
            ->cols($data)
            ->where('id = :id')
            ->bindValue('id', $id);
        $sth = $this->pdo->prepare($update->getStatement());
        $sth->execute($update->getBindValues());
    }

    public function delete($table, $id) {
        $delete = $this->queryFactory->newDelete();
        $delete
            ->from($table)
            ->where('id = :id')
            ->bindValue('id', $id);
        $sth = $this->pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());
    }

}