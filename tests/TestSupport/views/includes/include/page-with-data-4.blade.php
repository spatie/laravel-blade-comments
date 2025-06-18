This is the start of the page

@php
if (!class_exists('ReportComponent')) {
    class ReportComponent
    {
        static function asSelectArrayForModal()
        {
            return ['test' => 'test'];
        }
    }
}
@endphp

@include('includes.include.include', ['components' => ReportComponent::asSelectArrayForModal(), 'version' => 'test'])

This is the end of the page
