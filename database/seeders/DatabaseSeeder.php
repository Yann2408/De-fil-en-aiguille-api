<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Inspiration;
use App\Models\Pattern;
use App\Models\Person_measurement;
use App\Models\Project;
use App\Models\Tissu;
use App\Models\tissuType;
use App\Models\ToBuyList;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->_datas();
    }

    private function _datas()
    {
        $user = new User;
        $user->firstname = "Yann";
        $user->lastname = "Malfer";
        $user->email = "yann.malfer@gmail.com";
        $user->password = Hash::make('1234');
        $user->is_superadmin = true;
        $user->save();

        $tissuType = new tissuType;
        $tissuType->name = "jean";
        $tissuType->save();

        $tissu = new Tissu;
        $tissu->name = "Nom du tissu";
        $tissu->material = "coton";
        $tissu->weight = 300; // g/m2
        $tissu->laize = 2; // (largeur en m)
        $tissu->price = 10; // (en euros/m et en euros/10cm)
        $tissu->stock = 1; // (en m)
        $tissu->by_on = "mercerie Dupont";
        $tissu->scrap = true;
        $tissu->pre_wash = false;
        $tissu->oekotex = true;
        $tissu->bio = true;
        $tissu->rating = 4;
        $tissu->comment = "Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Provident voluptas id eum aperiam, iure delectus corrupti cum facere nemo earum
                            asperiores officiis autem voluptates suscipit ipsum doloribus repudiandae minima! Debitis!";
        $tissu->user_id = $user->id;
        $tissu->tissu_type_id = $tissuType->id;
        $tissu->save();

        $pattern = new Pattern;
        $pattern->name = "Nom du patron";
        $pattern->brand = "marque du patron";
        $pattern->support = "pdf";
        $pattern->clothing_type = "chemise";
        $pattern->silhouette = "grand";
        $pattern->rating = "3.5";
        $pattern->comment = "Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Provident voluptas id eum aperiam, iure delectus corrupti cum facere nemo earum
                            asperiores officiis autem voluptates suscipit ipsum doloribus repudiandae minima! Debitis!";
        $pattern->user_id = $user->id;
        $pattern->save();

        $personMeasurements = new Person_measurement;
        $personMeasurements->firstname = "Albert";
        $personMeasurements->lastname = "Dupont";
        $personMeasurements->chest = 40;
        $personMeasurements->height = 170;
        $personMeasurements->bust = 50;
        $personMeasurements->waist = 45;
        $personMeasurements->hips = 60;
        $personMeasurements->arm = 20;
        $personMeasurements->user_id = $user->id;
        $personMeasurements->save();

        $project = new Project;
        $project->name = "Nom du projet";
        $project->status = "in_progress";
        $project->size = 40;
        $project->target = "moi";
        $project->wire = "bleu";
        $project->needle = "aiguille longue";
        $project->point = "point normal";
        $project->comment = "Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Provident voluptas id eum aperiam, iure delectus corrupti cum facere nemo earum
                            asperiores officiis autem voluptates suscipit ipsum doloribus repudiandae minima! Debitis!";
        $project->user_id = $user->id;
        $project->pattern_id = $pattern->id;
        $project->person_measurement_id = $personMeasurements->id;
        $project->save();

        $project->tissus()->attach($tissu->id);

        $inspiration = new Inspiration;
        $inspiration->description = "Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Provident voluptas id eum aperiam, iure delectus corrupti cum facere nemo earum
                                    asperiores officiis autem voluptates suscipit ipsum doloribus repudiandae minima! Debitis!";
        $inspiration->user_id = $user->id;
        $inspiration->save();

        $category1 = new Category;
        $category1->name = "tissu";
        $category1->user_id = $user->id;
        $category1->save();

        $category2 = new Category;
        $category2->name = "aiguille";
        $category2->user_id = $user->id;
        $category2->save();

        $category3 = new Category;
        $category3->name = "fils";
        $category3->user_id = $user->id;
        $category3->save();

        $toBuyList = new ToBuyList;
        $toBuyList->name = "tissu bleu";
        $toBuyList->quantity = 3;
        $toBuyList->shop = "mercerie du centre ville";
        $toBuyList->category_id = $category1->id;
        $toBuyList->user_id = $user->id;
        $toBuyList->save();

    }
}
