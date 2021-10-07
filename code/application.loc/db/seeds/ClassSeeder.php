<?php


use Phinx\Seed\AbstractSeed;

class ClassSeeder extends AbstractSeed
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
                'name'    => '1-А',
            ],[
                'id' => 2,
                'name'    => '1-Б',
            ]
        ];
        $table = $this->table('class');
        $table->insert($data)
            ->saveData();
    }
}
