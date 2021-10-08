<?php


use Phinx\Seed\AbstractSeed;

class LessonSeeder extends AbstractSeed
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
                'name'    => 'Математика',
            ],[
                'name'    => 'Русский язык',
            ],[
                'name'    => 'Рисование',
            ],[
                'name'    => 'Труд',
            ],[
                'name'    => 'Физкультура',
            ],[
                'name'    => 'Литература',
            ],[
                'name'    => 'Английский язык',
            ],[
                'name'    => 'Музыка',
            ],[
                'name'    => 'Религия',
            ],[
                'name'    => 'Компьютерный час',
            ]
        ];
        $table = $this->table('lesson');
        $table->insert($data)
            ->saveData();
    }
}
