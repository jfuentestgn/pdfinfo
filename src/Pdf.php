<?php
/**
 * Created by PhpStorm.
 * User: jfuentes
 * Date: 19/02/2018
 * Time: 20:24
 */

namespace JFuentesTgn\PdfInfo;

use Spatie\PdfToText\Exceptions\CouldNotExtractText;
use Spatie\PdfToText\Pdf as SpatiePdf;
use Symfony\Component\Process\Process;

class Pdf extends SpatiePdf
{
    protected $pdfinfoPath;

    public function __construct(string $pdfinfoPath = null, string $binPath = null)
    {
        $this->pdfinfoPath = $pdfinfoPath ?? '/usr/bin/pdfinfo';
        parent::__construct($binPath);
    }

    public function info() : array
    {
        $result = [];
        $process = new Process("{$this->pdfinfoPath} " . escapeshellarg($this->pdf));
        $process->run();
        if (!$process->isSuccessful()) {
            throw new CouldNotExtractText($process);
        }
        $output = $process->getOutput(); //trim($process->getOutput(), " \t\n\r\0\x0B\x0C");
        $lines = explode("\n", $output);
        foreach ($lines as $line) {
            $fields = explode(':', $line, 2);
            if (count($fields) == 2) {
                $key = strtolower(trim($fields[0]));
                $val = trim($fields[1]);
                $result[$key] = $val;
            }
        }

        return $result;
    }

    public static function getInfo(string $pdf, string $pdfinfoPath = null, string $binPath = null) : array
    {
        return (new static($pdfinfoPath, $binPath))
            ->setPdf($pdf)
            ->info();
    }
}