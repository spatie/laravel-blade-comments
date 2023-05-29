<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class BladeComponentCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        return '/##BEGIN-COMPONENT-CLASS##@component\(\\\'([^\']+)\\\', *\\\'([^\']+)\\\', *(\[[^\]]*\])\)(.*?)@endComponentClass##END-COMPONENT-CLASS##/s';
    }

    public function replacement(): string
    {
        return '<!-- Start component \'$1\' \'$2\' -->$0<!-- End component \'$1\' \'$2\' -->';
    }
}
