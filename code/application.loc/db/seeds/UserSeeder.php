<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
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
        $faker = Faker\Factory::create('ru_RU');
        $data = [];

        // Ученики
        for ($i = 0; $i < 50; $i++) {
            $class = rand(1, 2);
            $data[] = [
                'login'         => $faker->userName,
                'password'      => sha1('password1'),
                'first_name'    => $faker->firstName,
                'last_name'     => $faker->lastName,
                'created_at'    => date('Y-m-d H:i:s'),
                'role_id'       => 2,
                'class_id'      => $class,
                'group_id'      => rand(0, 1) == 0 ? NULL : $class,
            ];
        }
        // Учителя
        for ($i = 0; $i < 2; $i++) {
            $data[] = [
                'login'         => $faker->userName,
                'password'      => sha1('password2'),
                'first_name'    => $faker->firstName,
                'last_name'     => $faker->lastName,
                'created_at'    => date('Y-m-d H:i:s'),
                'role_id'       => 1,
                'class_id'      => NULL,
                'group_id'      => NULL,
            ];
        }
        // 1 Ученик Иванов Иван
        $class = 1;
        $data[] = [
            'login'         => 'ii01',
            'password'      => sha1('password1'),
            'first_name'    => 'Иван',
            'last_name'     => 'Иванов',
            'created_at'    => date('Y-m-d H:i:s'),
            'role_id'       => 2,
            'class_id'      => $class,
            'group_id'      => $class,
        ];
        // 1 Ученик Семенова Маша
        $class = 2;
        $data[] = [
            'login'         => 'semenova.masha',
            'password'      => sha1('password1'),
            'first_name'    => 'Маша',
            'last_name'     => 'Семенова',
            'created_at'    => date('Y-m-d H:i:s'),
            'role_id'       => 2,
            'class_id'      => $class,
            'group_id'      => $class,
        ];
        // 1 Учитель Шипилевский Александр Семенович
        $data[] = [
            'login'         => 'ship01',
            'password'      => sha1('password2'),
            'first_name'    => 'Александр',
            'middle_name'   => 'Семенович',
            'last_name'     => 'Шипилевский',
            'created_at'    => date('Y-m-d H:i:s'),
            'role_id'       => 1,
            'class_id'      => NULL,
            'group_id'      => NULL,
        ];

        $data[] = [
            'login'         => 'teacher',
            'password'      => sha1('password2'),
            'first_name'    => 'Сергей',
            'middle_name'   => 'Борисович',
            'last_name'     => 'Школьников',
            'created_at'    => date('Y-m-d H:i:s'),
            'role_id'       => 1,
            'class_id'      => NULL,
            'group_id'      => NULL,
        ];

        $this->table('user')->insert($data)->saveData();
    }
}
