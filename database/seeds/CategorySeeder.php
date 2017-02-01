<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{

    protected $categories = [
        // Main Categories
        ['name' => ['mobiles' , 'تليفونات محموله'] , 'active' => 1  , 'parent_id' =>0 ], // id = 1
        ['name' => ['decoration' , 'زينه يدويه'] , 'active' => 1  , 'parent_id' =>0 ], // id = 2
        ['name' => ['electronices' , 'الكترونيات'] , 'active' => 1  , 'parent_id' =>0 ], // id = 3
        ['name' => ['accessories' , 'اكسسورارات'] , 'active' => 1  , 'parent_id' =>0 ], // id = 4
        ['name' => ['furniture' , 'اثاث منزلي'] , 'active' => 1  , 'parent_id' =>0 ], // id = 5

        // Sub Categories
        ['name' => ['samsung' , 'سامسونج'] , 'active' => 1  , 'parent_id' =>1 ], // id = 6
        ['name' => ['toshiba' , 'توشيبا'] , 'active' => 1  , 'parent_id' =>1 ], // id = 7
        ['name' => ['rings' , 'اقراط'] , 'active' => 1  , 'parent_id' =>5 ], // id = 8
        ['name' => ['beds' , 'سرائر'] , 'active' => 1  , 'parent_id' =>4 ], // id = 9
        ['name' => ['chairs' , 'كراسي'] , 'active' => 1  , 'parent_id' =>4 ], // id = 10
        ['name' => ['infinix' , 'انفنكس'] , 'active' => 1  , 'parent_id' =>1 ], // id = 11
        ['name' => ['deep freazer' , 'مبردات'] , 'active' => 1  , 'parent_id' =>3 ], // id = 12
        ['name' => ['toys' , 'العاب'] , 'active' => 1  , 'parent_id' =>5 ], // id = 13
        ['name' => ['stones' , 'احجار كريمه'] , 'active' => 1  , 'parent_id' =>4 ], // id = 14
        ['name' => ['deskes' , 'صحون'] , 'active' => 1  , 'parent_id' =>5 ], // id = 15
        ['name' => ['websites' , 'مواقع الكترونيه'] , 'active' => 1  , 'parent_id' =>3 ], // id = 16
        ['name' => ['apps' , 'تطبيقات'] , 'active' => 1  , 'parent_id' =>3 ], // id = 17
        ['name' => ['cars' , 'سيارات'] , 'active' => 1  , 'parent_id' =>4 ], // id = 18
        ['name' => ['pets' , 'حيوانات اليفه'] , 'active' => 1  , 'parent_id' =>5 ], // id = 19

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
            $cat = new Category;
            $cat->parent_id = $category['parent_id'];
            $cat->active = $category['active'];
            $cat->name = $category['name'][1];
            $cat->slug = $this->generateSlug($category['name'][1]);
            $cat->save();

            // //create translation for english
            // $cat->details()->create([
            //     'name' => $category['name'][0],
            //     'slug' => $this->generateSlug($category['name'][0]),
            //     'locale_id' => 1,
            //     ]) ;
            //
            // //create translation for arabic
            // $cat->details()->create([
            //     'name' => $category['name'][1],
            //     'slug' => $this->generateSlug($category['name'][1]),
            //     'locale_id' => 2,
            //     ]) ;

        }
    }

    protected function generateSlug($title)
    {
        return $temp = slugify($title);
    }

}
