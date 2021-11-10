<?php

class ViewManager
{
    /**
     * @throws Exception
     */
    public static function loadView(string $templateName, array $param): void
    {
        if (!file_exists($templateName)) {
            throw new Exception("view doesn't exist");
        }
        $templateContent = file_get_contents("./templates/" . $templateName . ".html");

        preg_match("{{.*?\}}",$templateContent,$match);
        if(sizeof($match) > sizeof($param))
        {
            throw new Exception("Wrong number of variables");
        }
        foreach ($param as $variableName => $variableContent) {
            $templateContent = str_replace("{{" . $variableName . "}}", $variableContent, $templateContent);
        }

        echo $templateContent;
    }
}