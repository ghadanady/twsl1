<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsSeeder extends Seeder
{

    protected $keys = [
        'facebook',
        'youtupe',
        'google-plus',
        'whats-up',
        'about-us',
        'sales',
        'services',
        'our-goal',
        'map-location',
        'address',
        'email',
    ];
    protected $en_values = [
        'facebook',
        'youtupe',
        'google-plus',
        '00201097556008',
        'It To Make A Type Specimen Book. It Has Survived Not Only Five Centuries, But Also The Leap Into Electronic Typesetting, Remaining Essentially Unchanged. It Was Popularised In',
        '00201097556008',
        'It To Make A Type Specimen Book. It Has Survived Not Only Five Centuries, But Also The Leap Into Electronic',
        'It To Make A Type Specimen Book. It Has Survived Not Only Five Centuries, But Also The Leap Into Electronic Typesetting, Remaining Essentially Unchanged. It Was Popularised In',
        '40.75198|-73.96978',
        '60 Tala Menoufeia, Egypt',
        '7ossamsh@gmail.com',
    ];

    protected $ar_values = [
        'facebook',
        'youtupe',
        'google-plus',
        '00201097556008',
        'نسعى لنجعل حياة عملائنا أكثر سهولة والمحافظة على قيمة وجمال وسلامة ممتلكاتهم وصيانتها عن طريق خدماتنا المستمرة لهم',
        '00201097556008',
        'نقدم أنواع مختلفة من الصيانة والتي تتضمن الخدمات الفورية والدورية والطارئة من أجل الوفاء باحتياجاتكم بطريقة شاملة ومتخصصة وآمنة',
        'نحن مؤسسة متخصصة في صيانة المباني والممتلكات ,ونقوم بتقديم خدمات فورية ذات جودة عالية مع الاهتمام بأدق التفاصيل ، كما يمكننا القيام بجميع خدمات الصيانة لممتلكاتكم عن طريق فريقنا المتخصص من فنين ومهندسين مما يساعدك في العمل والعيش بشكل أفضل',
        '40.75198|-73.96978',
        'السعودية الرياض خالد بن الوليد',
        '7ossamsh@gmail.com',
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $counter = 0;

        foreach ($this->keys as $key) {
            $setting = new Setting;

            $setting->key = $key;
            $setting->ar_value = $this->ar_values[$counter];
            $setting->en_value = $this->en_values[$counter];

            $counter++;
            $setting->save();
        }
    }
}
