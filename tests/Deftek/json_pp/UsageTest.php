<?php

/**
 * json_pp - JSON Pretty Printer usage tests
 *
 * @copyright Deftek. Please see LICENSE.txt for complete copyright and license information.
 */

namespace Deftek\json_pp;

use PHPUnit\Framework\TestCase;

class UsageTest extends TestCase
{
    public function testPrettyPrintCompactJSON()
    {
        exec("{$this->getJSONPPCommand()} < {$this->getCompactJSONFile()}", $output, $exitCode);

        $this->assertSame(0, $exitCode);
        $this->assertSame(implode("\n", $output), file_get_contents($this->getPrettyPrintedJSONFile()));
    }

    public function testCompactPrettyPrintedJSON()
    {
        exec(
            "{$this->getJSONPPCommand()} {$this->getCompactJSONConfigOption()} < {$this->getPrettyPrintedJSONFile()}",
            $output,
            $exitCode
        );

        $this->assertSame(0, $exitCode);
        $this->assertSame(explode("\n", file_get_contents($this->getCompactJSONFile())), $output);
    }

    public function testErrorDecode()
    {
        exec("echo nope | {$this->getJSONPPCommand()} 2>&1", $output, $exitCode);

        $this->assertSame(3, $exitCode);
        $this->assertSame(
            [
                'Failed decoding input JSON',
                'Usage: json_pp [--config=/path/to/config.php]'
            ],
            $output
        );
    }

    /**
     * @return string
     */
    protected function getCompactJSONConfigOption()
    {
        return '--config=' . escapeshellarg(realpath(__DIR__ . '/config.compact.php'));
    }

    /**
     * @return string
     */
    protected function getCompactJSONFile()
    {
        return realpath(__DIR__ . '/compact.json');
    }

    /**
     * @return string
     */
    protected function getJSONPPCommand()
    {
        return escapeshellcmd(realpath(__DIR__ . '/../../../bin/json_pp'));
    }

    /**
     * @return string
     */
    protected function getPrettyPrintedJSONFile()
    {
        return realpath(__DIR__ . '/pretty-printed.json');
    }
}
