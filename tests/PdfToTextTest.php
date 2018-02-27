<?php
/**
 * Created by PhpStorm.
 * User: jfuentes
 * Date: 19/02/2018
 * Time: 21:45
 */

namespace JFuentesTgn\PdfInfo\Test;

use PHPUnit\Framework\TestCase;
use Spatie\PdfToText\Exceptions\CouldNotExtractText;
use Spatie\PdfToText\Exceptions\PdfNotFound;
use JFuentesTgn\PdfInfo\Pdf;


class PdfToTextTest extends TestCase
{
    protected $dummyPdf = __DIR__.'/testfiles/dummy.pdf';
    protected $dummyPdfText = 'This is a dummy PDF';


    /** @test */
    public function it_can_extract_text_from_a_pdf()
    {
        $text = (new Pdf())
            ->setPdf($this->dummyPdf)
            ->text();
        $this->assertSame($this->dummyPdfText, $text);
    }


    /** @test */
    public function it_provides_a_static_method_to_extract_text()
    {
        $this->assertSame($this->dummyPdfText, Pdf::getText($this->dummyPdf));
    }


    /** @test */
    public function it_can_hande_paths_with_spaces()
    {
        $pdfPath = __DIR__.'/testfiles/dummy with spaces in its name.pdf';
        $this->assertSame($this->dummyPdfText, Pdf::getText($pdfPath));
    }

    /** @test */
    public function it_can_hande_paths_with_single_quotes()
    {
        $pdfPath = __DIR__.'/testfiles/dummy\'s_file.pdf';
        $this->assertSame($this->dummyPdfText, Pdf::getText($pdfPath));
    }

    /** @test */
    public function it_will_throw_an_exception_when_the_pdf_is_not_found()
    {
        $this->expectException(PdfNotFound::class);
        (new Pdf())
            ->setPdf('/no/pdf/here/dummy.pdf')
            ->text();
    }

    /** @test */
    public function it_will_throw_an_exception_when_the_binary_is_not_found()
    {
        $this->expectException(CouldNotExtractText::class);
        (new Pdf('','/there/is/no/place/like/home/pdftotext'))
            ->setPdf($this->dummyPdf)
            ->text();
    }
}
