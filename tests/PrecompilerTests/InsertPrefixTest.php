<?php

use Spatie\BladeComments\BladeCommentsPrecompiler;

it('can add a prefix to comments', function () {

    config(['blade-comments.prefix' => 'BLADE_COMMENT_PREFIX']);

    $output = BladeCommentsPrecompiler::insertPrefix('<!-- Start of comment -->');

    $this->assertEquals($output, '<!-- BLADE_COMMENT_PREFIX Start of comment -->');
});
