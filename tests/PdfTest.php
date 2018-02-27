<?php

namespace JFuentesTgn\PdfInfo\Test;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Spatie\PdfToText\Exceptions\CouldNotExtractText;
use Spatie\PdfToText\Exceptions\PdfNotFound;
use JFuentesTgn\PdfInfo\Pdf;

class PdfTest extends PHPUnitTestCase
{
    protected $dummyPdf = __DIR__.'/testfiles/dummy.pdf';

    protected $pdfTitle = 'This is a dummy PDF';
    protected $pdfAuthor = 'phoyer';

    /** @test */
    public function test_it_can_extract_text_from_a_pdf()
    {
        $info = (new Pdf())
            ->setPdf($this->dummyPdf)
            ->info();
        $this->assertTrue(is_array($info));
        $this->assertEquals($this->pdfTitle, $info['title']);
        $this->assertEquals($this->pdfAuthor, $info['author']);
    }

    /** @test */
    public function it_provides_a_static_method_to_extract_text()
    {
        $info = Pdf::getInfo($this->dummyPdf);
        $this->assertTrue(is_array($info));
        $this->assertEquals($this->pdfTitle, $info['title']);
        $this->assertEquals($this->pdfAuthor, $info['author']);
    }

    /** @test */
    public function it_will_throw_an_exception_when_the_pdf_is_not_found()
    {
        $this->expectException(PdfNotFound::class);
        (new Pdf())
            ->setPdf('/no/pdf/here/dummy.pdf')
            ->info();
    }
    /** @test */
    public function it_will_throw_an_exception_when_the_binary_is_not_found()
    {
        $this->expectException(CouldNotExtractText::class);
        (new Pdf('/there/is/no/place/like/home/pdftotext'))
            ->setPdf($this->dummyPdf)
            ->info();
    }
}
