<?php

declare(strict_types=1);

namespace wfm;

class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
    }

    public function errorHandler(
        int $errno,
        string $errstr,
        string $errfile,
        int $errline,
    ): void {
        $this->logError(
            $errstr,
            $errfile,
            $errline
        );
        $this->displayError(
            strval($errno),
            $errstr,
            $errfile,
            $errline
        );
    }

    public function fatalErrorHandler(): void
    {
        $error = error_get_last();
        if (!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            $this->logError(
                $error['message'],
                $error['file'],
                $error['line']
            );
            ob_end_clean();
            $this->displayError(
                strval($error['type']),
                $error['message'],
                $error['file'],
                $error['line']
            );
        } else {
            ob_end_flush();
        }
    }

    public function exceptionHandler(\Throwable $e): void
    {
        $this->logError(
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
        );
        $this->displayError(
            "Exception",
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $e->getCode(),
        );
    }

    protected function logError(
        string $message = '',
        string $file = '',
        int $line = 0,
    ): void {
        $filename = LOGS . '/errors.log';
        if (!is_dir(LOGS)) {
            mkdir(directory: LOGS, recursive: true);
        }
        $date = date("Y-m-d H:i:s");
        $content = sprintf("%s: %s; File %s; Line %d\n", $date, $message, $file, $line);
        file_put_contents($filename, $content, FILE_APPEND);
    }

    protected function displayError(
        string $errno,
        string $errstr = '',
        string $errfile = '',
        int $errline = 0,
        int $response = 500
    ): void {
        if ($response == 0) {
            $response = 404;
        }
        http_response_code($response);
        if ($response == 404 && DEBUG == 0) {
            require_once WWW . '/errors/404.php';
            die;
        }
        if (DEBUG == 1) {
            require WWW . '/errors/development.php';
        } else {
            require WWW . '/errors/production.php';
        }
        die;
    }
}
