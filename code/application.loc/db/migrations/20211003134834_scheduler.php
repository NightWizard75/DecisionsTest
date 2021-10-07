<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Scheduler extends AbstractMigration
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
        $sql = 'CREATE TABLE "scheduler" (
                id SMALLSERIAL NOT NULL,
                weekday SMALLINT DEFAULT NULL,
                lesson1 SMALLINT DEFAULT NULL,
                lesson2 SMALLINT DEFAULT NULL,
                lesson3 SMALLINT DEFAULT NULL,
                lesson4 SMALLINT DEFAULT NULL,
                lesson5 SMALLINT DEFAULT NULL,
                lesson6 SMALLINT DEFAULT NULL,
                lesson7 SMALLINT DEFAULT NULL,
                lesson8 SMALLINT DEFAULT NULL,
                class_id SMALLINT DEFAULT NULL,
                group_id SMALLINT DEFAULT NULL,
                created_by SMALLINT DEFAULT NULL,
                created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
                updated_by SMALLINT DEFAULT NULL,
                updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL,
                PRIMARY KEY(id))';
        $this->execute($sql);
        $table = $this->table('scheduler');
        $table->addIndex('weekday')
            ->addForeignKey('created_by', 'user', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->addForeignKey('updated_by', 'user', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->addForeignKey('class_id', 'class', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->addForeignKey('group_id', 'group', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->addForeignKey('lesson1', 'lesson', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->addForeignKey('lesson2', 'lesson', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->addForeignKey('lesson3', 'lesson', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->addForeignKey('lesson4', 'lesson', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->addForeignKey('lesson5', 'lesson', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->addForeignKey('lesson6', 'lesson', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->addForeignKey('lesson7', 'lesson', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->addForeignKey('lesson8', 'lesson', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();
    }
}
