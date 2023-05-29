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
<<<<<<< HEAD
        return '<!-- Start component \'$1\' \'$2\' -->$0<!-- End component \'$1\' \'$2\' -->';
=======
        return '<!-- Start component $1 $2 -->$0<!-- End component $1 $2 -->';
>>>>>>> 4d81f252acfe549e75e34eb55e0ce123f9ac1d18
    }
}
