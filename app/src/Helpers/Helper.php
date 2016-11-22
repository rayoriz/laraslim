<?php
/**
 * Setup the container
 */

if (!function_exists('initiateClasses')) {
    function initiateClasses($path)
    {
        $fqcns = array();

        $di = new RecursiveDirectoryIterator($path);
        foreach (new RecursiveIteratorIterator($di) as $filename => $file) {

            if (!is_dir($filename) && $file->getFileName() !== "Middleware.php") {
                $content = file_get_contents($file->getRealPath());
                $tokens = token_get_all($content);
                $namespace = '';
                for ($index = 0; isset($tokens[$index]); $index++) {
                    if (!isset($tokens[$index][0])) {
                        continue;
                    }
                    if (T_NAMESPACE === $tokens[$index][0]) {
                        $index += 2; // Skip namespace keyword and whitespace
                        while (isset($tokens[$index]) && is_array($tokens[$index])) {
                            $namespace .= $tokens[$index++][1];
                        }
                    }
                    if (T_CLASS === $tokens[$index][0]) {
                        $index += 2; // Skip class keyword and whitespace
                        $fqcns[] = $namespace.'\\'.$tokens[$index][1];
                    }
                }
            }
        }

        return $fqcns;
    }
}
