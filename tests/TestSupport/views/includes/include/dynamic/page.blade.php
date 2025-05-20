This is the start of the page

@php
    $test = 'test';
    $obj = new \stdClass();
    $obj->report_format = 'test';

    class CustomFieldType
    {
        static function getHtmlEditBlade($type)
        {
            return 'includes.include.include';
        }
    }


    $customField = new \stdClass();
    $customField->type = 'test';
    $customField->customName = 'test';
    $newVersion = new \stdClass();
    $oldVersion = new \stdClass();
    $oldVersion->test = 'test';
@endphp



@include(CustomFieldType::getHtmlEditBlade($customField->type), [
    'model' => $newVersion,
    'compareTo' => $oldVersion->{$customField->customName}
])

bla

@include('includes.include.include')


This is the end of the page
