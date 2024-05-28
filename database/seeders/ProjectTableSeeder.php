<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Type;
use App\Functions\Helper as Help;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Project-1', 'Project-2', 'Project-3', 'Project-4', 'Project-5'];

        foreach($data as $item){
            $new_item = new Project();
            $new_item->type_id =Type::inRandomOrder()->first()->id;
            $new_item->title = $item;
            $new_item->slug = Help::generateSlug($item, Project::class);


            $new_item->save();
        }
    }
}
