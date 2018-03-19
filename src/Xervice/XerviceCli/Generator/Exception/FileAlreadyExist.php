<?php


namespace Xervice\XerviceCli\Generator\Exception;


use Xervice\Core\Exception\XerviceException;

class FileAlreadyExist extends XerviceException
{
    /**
     * FileAlreadyExist constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null)
    {
        $message = 'File already exist: ' . $message;
        parent::__construct($message, $code, $previous);
    }

}