<?php

use Illuminate\Database\Seeder;
use App\TranslationPrefix;

class ClearApp extends Seeder
{
    protected $prefixs = [
        'validation',
        'unit',
        'messages',
    ];
    public function run()
    {
            $prefixs = App\TranslationPrefix::where('name' ,'<>', $this->prefixs[0])
            ->where('name' ,'<>', $this->prefixs[1])
            ->where('name' ,'<>', $this->prefixs[2])->get();

            foreach ($prefixs as $prefix) {
                $fields = $prefix->fields();
                foreach ($fields as $field) {
                    $field->translarions()->delete();
                }
                $fields->delete();
                $prefix->delete();
            }

    }
}
