<?php


class ViewManager
{

    static array $blocks = array();

    static function view($file, $data = array())
    {
        $file = "./view/templates/" . $file . ".html";
        $code = self::includeFiles($file);
        $code = self::compileCode($code);
        extract($data, EXTR_SKIP);
        echo $code;
    }

    static function compileCode($code): string
    {
        $code = self::compileYield($code);
        $code = self::compileEscapedEchos($code); // html special char
        $code = self::compileEchos($code);
        return self::compilePHP($code);
    }

    static function includeFiles($file): string
    {
        $code = file_get_contents($file);
        preg_match_all('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', $code, $matches, PREG_SET_ORDER);
        foreach ($matches as $value) {
            $code = str_replace($value[0], self::includeFiles($value[2]), $code);
        }
        return preg_replace('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', '', $code);
    }

    static function compilePHP($code): string
    {
        return preg_replace('~\{%\s*(.+?)\s*\%}~is', '<?php $1 ?>', $code);
    }

    static function compileEchos($code): string
    {
        return preg_replace('~\{{\s*(.+?)\s*\}}~is', '<?php echo $1 ?>', $code);
    }

    static function compileEscapedEchos($code): array|string|null
    {
        return preg_replace('~\{{{\s*(.+?)\s*\}}}~is', '<?php echo htmlentities($1, ENT_QUOTES, \'UTF-8\') ?>', $code);
    }

    static function compileYield($code): string
    {
        foreach (self::$blocks as $block => $value) {
            $code = preg_replace('/{% ?yield ?' . $block . ' ?%}/', $value, $code);
        }
        return preg_replace('/{% ?yield ?(.*?) ?%}/i', '', $code);
    }

}

