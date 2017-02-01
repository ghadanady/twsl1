<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagSeeder extends Seeder
{

    protected $tags = [
        'رياضه',
        'فن',
        'فيديو',
        'مشاهير',
        'كوره',
        'سياسه',
        'فضاء',
        'غناء',
        'بورصه',
        'العملات',
        'الاقتصاد',
        'حرب',
        'عقارات',
        'سيارات',
        'انتخابات',
        'اذاعه',
        'موضه',
        'ثقافه',
        'تعليم',
        'اكاديمي',
        'وظائف',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->tags as $tag) {
            $t = new Tag;
            $t->name = $tag;
            $t->save();
        }
    }
}
