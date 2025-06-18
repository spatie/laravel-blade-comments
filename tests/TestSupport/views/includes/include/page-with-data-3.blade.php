This is the start of the page

@php
$test = 'test';
$obj = new \stdClass();
$obj->report_format = 'test';
if (! class_exists('FindingLayoutFieldFormat')) {
    class FindingLayoutFieldFormat
    {
        const SECTION = 'section';
    }
}
@endphp


@include('includes.include.include', ['title' => $test ?? $document->file_name, 'inline' => $inline ?? false])

bla bla

@include('includes.include.include', ['model' => $test, 'actionInLine' => $test && $obj->report_format !== FindingLayoutFieldFormat::SECTION])

This is the end of the page
