<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Inspiration;
use App\Models\Pattern;
use App\Models\Person_measurement;
use App\Models\Project;
use App\Models\Tissu;
use App\Models\TissuType;
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

        $tissuType = new TissuType;
        $tissuType->name = "jean";
        $tissuType->save();

        $tissuType2 = new TissuType;
        $tissuType2->name = "coton";
        $tissuType2->save();

        $tissu = new Tissu;
        $tissu->name = "Tissu 1";
        $tissu->material = "coton";
        $tissu->weight = 300; // g/m2
        $tissu->laize = 2; // (largeur en cm)
        $tissu->price = 10; // (en euros/m et en euros/10cm)
        $tissu->stock = 1; // (en m)
        $tissu->by_on = "mercerie Dupont";
        $tissu->pre_wash = false;
        $tissu->oekotex = true;
        $tissu->bio = true;
        $tissu->rating = 4.5;
        $tissu->comment = "Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Provident voluptas id eum aperiam, iure delectus corrupti cum facere nemo earum
                            asperiores officiis autem voluptates suscipit ipsum doloribus repudiandae minima! Debitis!";
        $tissu->user_id = $user->id;
        $tissu->tissu_type_id = $tissuType->id;
        $tissu->save();

        $tissu2 = new Tissu;
        $tissu2->name = "tissu 2";
        $tissu2->material = "coton";
        $tissu2->weight = 300; // g/m2
        $tissu2->laize = 2; // (largeur en m)
        $tissu2->price = 10; // (en euros/m et en euros/10cm)
        $tissu2->stock = 0; // (en m)
        $tissu2->by_on = "mercerie Dupont";
        $tissu2->pre_wash = false;
        $tissu2->oekotex = true;
        $tissu2->bio = true;
        $tissu2->rating = 4;
        $tissu2->comment = "Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Provident voluptas id eum aperiam, iure delectus corrupti cum facere nemo earum
                            asperiores officiis autem voluptates suscipit ipsum doloribus repudiandae minima! Debitis!";
        $tissu2->user_id = $user->id;
        $tissu2->tissu_type_id = $tissuType2->id;
        $tissu2->save();

        $tissu3 = new Tissu;
        $tissu3->name = "tissu 3";
        $tissu3->material = "coton";
        $tissu3->weight = 300; // g/m2
        $tissu3->laize = 3; // (largeur en m)
        $tissu3->price = 10; // (en euros/m et en euros/10cm)
        $tissu3->stock = 5; // (en m)
        $tissu3->by_on = "mercerie Dupont";
        $tissu3->pre_wash = false;
        $tissu3->oekotex = true;
        $tissu3->bio = true;
        $tissu3->rating = 3;
        $tissu3->comment = "Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Provident voluptas id eum aperiam, iure delectus corrupti cum facere nemo earum
                            asperiores officiis autem voluptates suscipit ipsum doloribus repudiandae minima! Debitis!";
        $tissu3->user_id = $user->id;
        $tissu3->tissu_type_id = $tissuType2->id;
        $tissu3->save();

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
