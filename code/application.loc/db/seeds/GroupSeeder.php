<?php


use Phinx\Seed\AbstractSeed;

class GroupSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name'    => 'Продленка 1-А',
            ],[
                'id' => 2,
                'name'    => 'Продленка 1-Б',
            ]
        ];
        $table = $this->table('group');
        $table->insert($data)
            ->saveData();
    }
}
