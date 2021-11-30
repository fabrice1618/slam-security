<?php


class ViewManager
{

    static array $blocks = array();

    static function view($file, $data = array())
    {
        $cached_file = self::cache($file);
        extract($data, EXTR_SKIP);
        echo $cached_file;
    }

    static function cache($file): string
    {
        $file = "./view/templates/" . $file . ".html";
        $code = self::includeFiles($file);
        return self::compileCode($code);
    }

    static function compileCode($code)
    {
        $code = self::compileBlock($code);
        $code = self::compileYield($code);
        $code = self::compileEscapedEchos($code); // html special char
        $code = self::compileEchos($code);
        return self::compilePHP($code);
    }

    static function includeFiles($file)
    {
        $code = file_get_contents($file);
        preg_match_all('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', $code, $matches, PREG_SET_ORDER);
        foreach ($matches as $value) {
            $code = str_replace($value[0], self::includeFiles($value[2]), $code);
        }
        $code = preg_replace('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', '', $code);
        return $code;
    }

    static function compilePHP($code)
    {
        return preg_replace('~\{%\s*(.+?)\s*\%}~is', '<?php $1 ?>', $code);
    }

    static function compileEchos($code)
    {
        return preg_replace('~\{{\s*(.+?)\s*\}}~is', '<?php echo $1 ?>', $code);
    }

    static function compileEscapedEchos($code)
    {
        return preg_replace('~\{{{\s*(.+?)\s*\}}}~is', '<?php echo htmlentities($1, ENT_QUOTES, \'UTF-8\') ?>', $code);
    }

    static function compileBlock($code)
    {
        preg_match_all('/{% ?block ?(.*?) ?%}(.*?){% ?endblock ?%}/is', $code, $matches, PREG_SET_ORDER);
        foreach ($matches as $value) {
            if (!array_key_exists($value[1], self::$blocks)) self::$blocks[$value[1]] = '';
            if (strpos($value[2], '@parent') === false) {
                self::$blocks[$value[1]] = $value[2];
            } else {
                self::$blocks[$value[1]] = str_replace('@parent', self::$blocks[$value[1]], $value[2]);
            }
            $code = str_replace($value[0], '', $code);
        }
        return $code;
    }

    static function compileYield($code)
    {
        foreach (self::$blocks as $block => $value) {
            $code = preg_replace('/{% ?yield ?' . $block . ' ?%}/', $value, $code);
        }
        $code = preg_replace('/{% ?yield ?(.*?) ?%}/i', '', $code);
        return $code;
    }

}

?>