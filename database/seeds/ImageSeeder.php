<?php

use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{

    public function run()
    {
         $images = [
        'slider.slide_one_layer_one' => ['dest'=>'slides','img'=>'slide.jpg'],
        'slider.slide_two_layer_one' => ['dest'=>'slides','img'=>'slide2.jpg'],
        'home.smart_box_header' => ['dest'=>'boxes','img'=>'construction-about.png'],
        'home.wefix_box_header' => ['dest'=>'boxes','img'=>'logo-wefix.jpg'],
        'home.business_box_header' => ['dest'=>'boxes','img'=>'business-men.png'],
        'home.first_slogan_header' => ['dest'=>'icons','img'=>'icon4.png'],
        'home.second_slogan_header' => ['dest'=>'icons','img'=>'icon2.png'],
        'home.third_slogan_header' => ['dest'=>'icons','img'=>'icon3.png'],
        'about.company_header' => ['dest'=>'boxes','img'=>'about-img.jpg'],
    ];


        foreach ($images as $path => $value) {
            update_image($path , $value['dest'], $value['img'],true);
        }
    }
}
