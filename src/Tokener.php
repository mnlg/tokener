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

namespace Mnlg\Tokener;

/**
 * Random token generator class.
 */
class Tokener
{
    /**
     * Lowercase letters alphabet.
     *
     * @const string
     */
    const LOWER_CASE_LETTERS = 'abcdefghijklmnopqrstuvwxyz';

    /**
     * Uppercase letters alphabet.
     *
     * @const string
     */
    const UPPER_CASE_LETTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * Numbers alphabet.
     *
     * @const string
     */
    const NUMBERS = '0123456789';

    /**
     * Symbols alphabet.
     *
     * @const string
     */
    const SYMBOLS = '!$%*&/=?-.+:';

    /**
     * Current alphabet variable.
     *
     * @var string
     */
    protected $alphabet;

    /**
     * Constructor sets the alphabet to generate the codes.
     *
     * @param string $alphabet
     */
    public function __construct(?string $alphabet = null)
    {
        if ($alphabet === null) {
            $alphabet = self::LOWER_CASE_LETTERS.self::UPPER_CASE_LETTERS.self::NUMBERS;
        }

        $this->setAlphabet($alphabet);
    }

    /**
     * Set the alphabet to generate the codes.
     *
     * @param string $alphabet
     *
     * @throws RuntimeException
     */
    public function setAlphabet(string $alphabet): void
    {
        if (empty($alphabet)) {
            throw new \RuntimeException('Alphabet must be a non empty string');
        }

        $this->alphabet = $alphabet;
    }

    /**
     * Return the current alphabet.
     *
     * @return string
     */
    public function getAlphabet(): string
    {
        return $this->alphabet;
    }

    /**
     * Generate a token with the specified length and alphabet.
     *
     * @param int $length
     *
     * @return string
     */
    public function getToken(int $length): string
    {
        $token = '';
        $maxAlphabetIndex = strlen($this->alphabet) - 1;
        for ($i = 0; $i < $length; ++$i) {
            $token .= $this->alphabet[random_int(0, $maxAlphabetIndex)];
        }

        return $token;
    }
}
