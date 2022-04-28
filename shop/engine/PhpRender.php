<?php

namespace app\engine;

use app\interfaces\IRender;

class PhpRender implements IRender
{
    /**
     * @param $template  - название шаблона страницы
     * @param $params  - ассоциативный массив с данными, которые нужно передать в шаблон. Имена ключей соответствуют именам переменных, доступных в шаблоне
     * @return false|string
     */
    public function renderTemplate($template, $params = [])
    {
        //Сохраняем вывод скрипта в буфере
        ob_start();

        /*Импортируем данные из ассоциативного массива в переменные,
        имена которых соответствуют ключам элементов массива*/
        extract($params);

        //Собираем путь до файла с шаблоном страницы и подключаем его
        include VIEWS_DIR.$template.'.php';

        /*  Заканчиваем буферизацию вывода, возвращаем накопленное содержимое буфера вывода и очищаем буфер */
        return ob_get_clean();
    }
}