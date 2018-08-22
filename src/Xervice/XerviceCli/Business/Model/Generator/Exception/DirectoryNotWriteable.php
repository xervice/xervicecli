<?php


namespace Xervice\XerviceCli\Business\Model\Generator\Exception;


use Xervice\Core\Exception\XerviceException;

class DirectoryNotWriteable extends XerviceException
{
    /**
     * DirectoryNotWriteable constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null)
    {
        $message = 'Directory is not writeable: ' . $message;
        parent::__construct($message, $code, $previous);
    }

}