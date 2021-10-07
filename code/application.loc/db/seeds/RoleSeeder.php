<?php


use Phinx\Seed\AbstractSeed;

class RoleSeeder extends AbstractSeed
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
                'name'    => 'Учитель',
            ],[
                'id' => 2,
                'name'    => 'Ученик',
            ]
        ];
        $table = $this->table('role');
        $table->insert($data)
            ->saveData();
    }
}
