<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class User extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $sql = 'CREATE TABLE "user" (
                id SMALLSERIAL NOT NULL,
                login VARCHAR(32) NOT NULL,
                password VARCHAR(40) NOT NULL,
                first_name VARCHAR(32) NOT NULL,
                middle_name VARCHAR(32) DEFAULT NULL,
                last_name VARCHAR(32) NOT NULL,
                created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
                updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL,
                role_id SMALLINT DEFAULT NULL,
                class_id SMALLINT DEFAULT NULL,
                group_id SMALLINT DEFAULT NULL,
                PRIMARY KEY(id))';
        $this->execute($sql);
        $table = $this->table('user');
        $table->addIndex('login', ['unique' => true])
            ->addIndex('role_id')
            ->addForeignKey('role_id', 'role', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->addForeignKey('class_id', 'class', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->addForeignKey('group_id', 'group', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();
    }
}
