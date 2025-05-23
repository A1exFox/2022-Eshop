<?php

declare(strict_types=1);

namespace app\models;

use wfm\Model;
use RedBeanPHP\R;

class AppModel extends Model
{
    // FIXME 
    // TODO make simple these methods
    public static function create_slug(string $table, string $field, string $str, int $id): string
    {
        $str = self::str2url($str);
        $res = R::findOne($table, "$field = ?", [$id]);
        if ($res) {
            $str = "$str-$id";
            $res = R::count($table, "$field = ?", [$str]);
            if ($res) {
                $str = self::create_slug($table, $field, $str, $id);
            }
        }
        return $str;
    }
    public static function str2url(string $str): string
    {
        $str = self::rus2translite($str);
        $str = strtolower($str);
        // FIXME optimize regex pattern
        $str = preg_replace("#[^-a-z0-9]+#u", '-', $str);
        $str = trim($str, '-');
        return $str;
    }
    public static function rus2translite(string $str): string
    {
        // FIXME move to static const, optimize $alphabet
        $alphabet = [
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'e',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'y',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'c',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'sch',
            'ь' => '\'',
            'ы' => 'y',
            'ъ' => '\'',
            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya',

            'А' => 'A',
            'Б' => 'B',
            'В' => 'V',
            'Г' => 'G',
            'Д' => 'D',
            'Е' => 'E',
            'Ё' => 'E',
            'Ж' => 'Zh',
            'З' => 'Z',
            'И' => 'I',
            'Й' => 'Y',
            'К' => 'K',
            'Л' => 'L',
            'М' => 'M',
            'Н' => 'N',
            'О' => 'O',
            'П' => 'P',
            'Р' => 'R',
            'С' => 'S',
            'Т' => 'T',
            'У' => 'U',
            'Ф' => 'F',
            'Х' => 'H',
            'Ц' => 'C',
            'Ч' => 'Ch',
            'Ш' => 'Sh',
            'Щ' => 'Sch',
            'Ь' => '\'',
            'Ы' => 'Y',
            'Ъ' => '\'',
            'Э' => 'E',
            'Ю' => 'Yu',
            'Я' => 'Ya',
        ];
        return strtr($str, $alphabet);
    }
}
