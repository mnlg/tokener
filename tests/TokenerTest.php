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
use Mnlg\Tokener\Tokener;

/**
 * Tokener tests.
 */
class TokenerTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test default alphabet.
     */
    public function testTokenerDefaultAlphabet()
    {
        $tokener = new Tokener();
        $this->assertEquals($tokener->getAlphabet(),
            Tokener::LOWER_CASE_LETTERS.Tokener::UPPER_CASE_LETTERS.Tokener::NUMBERS);
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
     */
    public function testTokenLength()
    {
        $length = 40;
        $tokener = new Tokener();
        $token = $tokener->getToken($length);
        $this->assertEquals(strlen($token), $length);
    }

    /**
     * Test token chars.
     */
    public function testTokenChars()
    {
        // token is upper case
        $tokener = new Tokener(Tokener::UPPER_CASE_LETTERS);
        $token = $tokener->getToken(40);
        $this->assertEquals($token, strtoupper($token));

        // token us lower case
        $tokener->setAlphabet(Tokener::LOWER_CASE_LETTERS);
        $token = $tokener->getToken(40);
        $this->assertEquals($token, strtolower($token));
    }

    /**
     * Test getToken with empty alphabet.
     */
    public function testGetTokenWithEmptyAlphabet()
    {
        $this->expectException(RuntimeException::class);
        $tokener = new Tokener();
        $tokener->setAlphabet('');
    }

    /**
     * Test new token with non string alphabet.
     */
    public function testGetTokenWithANonStringAlphabet()
    {
        $this->expectException(RuntimeException::class);
        $tokener = new Tokener(123456789);
    }
}
