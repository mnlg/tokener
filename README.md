# Tokener

Random token generator.

##How to install

Update your composer.json manifest to require the mnlg/tokener package (see below). Run composer install or composer update to update your local vendor folder.

    {
        "require": {
            "mnlg/tokener": "*"
        }
    }

##How to use

Using Tokener is rather simple, by default it will generate the tokens using an alphabet composed of upper and lower case leters and numbers. You can set your own alphabet too.

###Example

    $tokener = new \Mnlg\Tokener\Tokener();
    $token = $tokener->getToken(40); // get a 40 chars token
    echo $token; // ex. token: RmgKfLEBt7DcVNRtvZibTswkBLfrPYB5wIy4bnrS

###Alphabet

Tokener uses an alphabet to generate the tokens, the default alphabet generates tokens with upper and lower case letters plus numbers. This are the alphabet constants included with Tokener.

    Tokener::LOWER_CASE_LETTERS // abcdefghijklmnopqrstuvwxyz
    Tokener::UPPER_CASE_LETTERS // ABCDEFGHIJKLMNOPQRSTUVWXYZ
    Tokener::NUMBERS // 0123456789
    Tokener::SYMBOLS // !$%*&/=?-. 

To use one of this alphabets you can pass it to the Tokener constructor:

    $tokener = new Tokener(Tokener::NUMBERS); // generate number only tokens

The alphabet can also be changed once the Tokener object has been created using the `setAlphabet()` method:

    $tokener->setAlphabet(Tokener::LOWER_CASE_LETTERS . Tokener::UPPER_CASE_LETTERS);

Using custom alphabets is also possible by passing a custom string to the constructor or to the `setAlphabet()` method:

    $tokener->setAlphabet('abcd123'); // generate random tokens with this characters only

## License

All code in this repository is released under the MIT public license.

<http://opensource.org/licenses/MIT>