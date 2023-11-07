<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;

class ImageMaliciousDetectionRule implements Rule
{
    protected $malicious_keywords = [
        '\\/bin\\/bash',
        '__HALT_COMPILER',
        'Guzzle',
        'Laravel',
        'Monolog',
        'PendingRequest',
        '\\<script',
        'ThinkPHP',
        'phar',
        'phpinfo',
        '\\<\\?php',
        '\\$_GET',
        '\\$_POST',
        '\\$_SESSION',
        '\\$_REQUEST',
        'whoami',
        'python',
        'composer',
        'passthru',
        'shell_exe',
        'PHPShell',
        'FilesMan',
    ];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function passes($attribute, $value)
    {
        if ($value instanceof UploadedFile) {
            return ! preg_match('/('.implode('|', $this->malicious_keywords).')/im', $value->get());
        }

        if (! request()->hasFile($attribute)) {
            return true;
        }

        return ! preg_match('/('.implode('|', $this->malicious_keywords).')/im', request()->file($attribute)->get());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The system detected a malicious content in the attachment. Kindly check if your attachment is from the original sources';
    }
}
