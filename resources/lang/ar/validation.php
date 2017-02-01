<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute يجب ان يكون مقبولا.',
    'active_url'           => ':attribute يجب ان يكون رابط صالح للاستخدام',
    'after'                => ':attribute يجب ان يكون تاريخا يقع بعد :date.',
    'alpha'                => ':attribute يجب ان يحتوي علي حروف فقط.',
    'alpha_dash'           => ':attribute يجب ان يحتوي علي حروف و ارقام و شرطات فاصلة.',
    'alpha_num'            => ':attribute يجب ان يحتوي فقط علي حروف و ارقام.',
    'array'                => ':attribute يجب ان يكون مصفوفة',
    'before'               => ':attribute يجب ان يكون تاريخا يقع قبل  :date.',
    'between'              => [
        'numeric' => ':attribute يجب ان يكون قيمة محصورة بين :min و :max .',
        'file'    => ':attribute يجب ان يكون قيمة محصورة بين :min و :max كليوبايت.',
        'string'  => ':attribute يجب ان يكون قيمة محصورة بين :min و :max احرف.',
        'array'   => ':attribute يجب ان يكون قيمة محصورة بين :min و :max عناصر.',
    ],
    'boolean'              => ':attribute يجب ان يكون قيمة ترجيحيه يالايجاب او بالسلب',
    'confirmed'            => ':attribute غير مؤكد.',
    'date'                 => ':attribute يجب ان يكون تاريخ صالح',
    'date_format'          => ':attribute يجب ان يكون تاريخ مماثلا لهذه الصيغه ":format".',
    'different'            => ':attribute و :other يجب ان يكونا مختلفين',
    'digits'               => ':attribute يجب ان يتكون من :digits ارقام.',
    'digits_between'       => ':attribute يجب ان يتكون من عدد ارقام بين :min و :max ارقام.',
    'dimensions'           => ':attribute يجب ان يكون ابعاد صحيحة للصورة',
    'distinct'             => ':attribute يجب الا يحتوي علي قيم مكررة.',
    'email'                => ':attribute يجب ان يكون بريد الكتروني صالح.',
    'exists'               => ':attribute غير صالح.',
    'file'                 => ':attribute يجب ان يكون ملف صالح.',
    'filled'               => ':attribute لا يمكن ان يكون فارغا',
    'image'                => ':attribute يجب ان يكون صورة صالحة للاستخدام.',
    'in'                   => ':attribute المختار غير صالح للاستخدام.',
    'in_array'             => ':attribute يجب ان يكون عنصرا متواجد ضمن هذه العناصر :other.',
    'integer'              => ':attribute يجب ان يكون عدد صحيح.',
    'ip'                   => ':attribute يجب ان يكون عنوان IP صالح للاستخدام.',
    'json'                 => ':attribute يجب ان يكون نص JSON صالح للاستخدام.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => ':attribute يجب ان يكون قيمة علي الاقل بين :min و :max.',
        'file'    => ':attribute يجب ان يكون قيمة علي الاقل بين :min و :max كليوبايت.',
        'string'  => ':attribute يجب ان يكون قيمة علي الاقل بين :min و :max احرف.',
        'array'   => ':attribute يجب ان يكون قيمة علي الاقل بين :min و :max عناصر.',
    ],
    'not_in'               => ':attribute المختار يجب ان يكون صالح.',
    'numeric'              => ':attribute يجب ان يكون رقم صالح.',
    'present'              => ':attribute يجب ان يكون حاضرا.',
    'regex'                => ':attribute يجب ا يكون صيغة صالحه.',
    'required'             => ':attribute لا يمكن ان يكون فارغا.',
    'required_if'          => ':attribute مطلوبا عندما يكون  :other محققا ل :value.',
    'required_unless'      => ':attribute مطلوبا عندما يكون  :other غير محققا ل :values.',
    'required_with'        => ':attribute مطلوبا عندما تكون هذة ال :values حاضرة.',
    'required_with_all'    => ':attribute مطلوبا عندما تكون هذة ال :values حاضرة.',
    'required_without'     => ':attribute مطلوبا عندما تكون هذة ال :values غير حاضرة.',
    'required_without_all' => ':attribute مطلوبا عندما تكون هذة ال :values غير حاضرة.',
    'same'                 => ':attribute و :other يجب ان يكونا متاملثين.',
    'size'                 => [
        'numeric' => ':attribute يجب ان يكون قيمة مساوية :size.',
        'file'    => ':attribute يجب ان يكون قيمة مساوية :size كليوبايت.',
        'string'  => ':attribute يجب ان يكون قيمة مساوية :size احرف.',
        'array'   => ':attribute يجب ان يكون قيمة مساوية :size عناصر.',
    ],
    'string'               => ':attribute يجب ان يكون قيمة نصيه.',
    'timezone'             => ':attribute يجب ان يكون نطاق صحيح.',
    'unique'               => ':attribute تعتبر قيمة مخوذه مسبقا.',
    'uploaded'             => ':attribute يحتوي فشل في الرفع.',
    'url'                  => ':attribute يجب ان يكون رابط صالح للاستخدام.',
    'greater_than' => ':attribute لابد ان يكون قيمة اكبر من :field',
    'phone' => ':attribute يجب ان يكون رقم هاتف صالح للاستخدام.',
    'password' => ':attribute يجب ان يحتوي علي الاقل 8 حروف مكونة من حروف و ارقام.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'phone' => [
            'phone' => 'رقم الجوال ',
        ],
        'tel' => [
            'phone' => 'رقم الجوال ',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
