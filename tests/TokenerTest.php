<?php
/**
 * MIT LICENSE.
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace Tests;

use Mnlg\Tokener\Tokener;
use PHPUnit\Framework\TestCase;

/**
 * Tokener tests.
 */
class TokenerTest extends TestCase
{
    /**
     * Test default alphabet.
     */
    public function testTokenerDefaultAlphabet()
    {
        $tokener = new Tokener();
        $this->assertEquals(
            $tokener->getAlphabet(),
            Tokener::LOWER_CASE_LETTERS.Tokener::UPPER_CASE_LETTERS.Tokener::NUMBERS
        );
    }

    /**
     * Test custom alphabet.
     */
    public function testTokenerCustomAlphabet()
    {
        $alphabet = 'foo';
        $tokener = new Tokener($alphabet);
        $this->assertEquals($tokener->getAlphabet(), $alphabet);
    }

    /**
     * Test setAlphabet.
     */
    public function testSetAlphabet()
    {
        $tokener = new Tokener();
        $tokener->setAlphabet(Tokener::NUMBERS);
        $this->assertEquals($tokener->getAlphabet(), Tokener::NUMBERS);
    }

    /**
     * Test token length.
     * 
     * @dataProvider lengthProvider
     */
    public function testTokenLength(int $length)
    {
        $tokener = new Tokener();
        $token = $tokener->getToken($length);
        $this->assertEquals($length, strlen($token));
    }

    /**
     * Test token chars.
     */
    public function testTokenChars()
    {
        $length = 40;

        $tokener = new Tokener(Tokener::UPPER_CASE_LETTERS);
        $token = $tokener->getToken($length);
        $this->assertEquals($token, strtoupper($token));

        $tokener->setAlphabet(Tokener::LOWER_CASE_LETTERS);
        $token = $tokener->getToken($length);
        $this->assertEquals($token, strtolower($token));
    }

    /**
     * Test getToken with empty alphabet.
     */
    public function testGetTokenWithEmptyAlphabet()
    {
        $this->expectException(\RuntimeException::class);
        $tokener = new Tokener();
        $tokener->setAlphabet('');
    }

    /**
     * Test new token with an empty string alphabet.
     */
    public function testGetTokenWithEmptyStringAlphabet()
    {
        $this->expectException(\RuntimeException::class);
        $tokener = new Tokener('');
    }

    /**
     * Provide token lengths.
     */
    public function lengthProvider(): array
    {
        return [[10], [15], [40], [21], [7]];
    }
}
