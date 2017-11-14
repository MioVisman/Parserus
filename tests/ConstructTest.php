<?php

class ConstructTest extends PHPUnit\Framework\TestCase
{
    public function testInit()
    {
        $text = "\tHello\n\tWorld!";
        $html = '&nbsp; &nbsp; Hello<br>&nbsp; &nbsp; World!';
        $xhtml = '&#160; &#160; Hello<br />&#160; &#160; World!';

        $parser = new Parserus();
        $this->assertEquals($html, $parser->parse($text)->getHTML());

        $parser = new Parserus(ENT_HTML401);
        $this->assertEquals($html, $parser->parse($text)->getHTML());

        $parser = new Parserus(ENT_XML1);
        $this->assertEquals($xhtml, $parser->parse($text)->getHTML());

        $parser = new Parserus(ENT_XHTML);
        $this->assertEquals($xhtml, $parser->parse($text)->getHTML());

        $parser = new Parserus(ENT_HTML5);
        $this->assertEquals($html, $parser->parse($text)->getHTML());

        $parser = new Parserus(224);
        $this->assertEquals($html, $parser->parse($text)->getHTML());
    }
}
