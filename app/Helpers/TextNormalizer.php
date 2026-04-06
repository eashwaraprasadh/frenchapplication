<?php

namespace App\Helpers;

class TextNormalizer
{
    /**
     * Normalize and compare strings with support for French special characters
     * Handles accented characters (é, è, ê, ë, à, ù, etc.)
     */
    public static function compare($userAnswer, $correctAnswer)
    {
        $userNormalized = self::normalize($userAnswer);
        $correctNormalized = self::normalize($correctAnswer);
        
        return $userNormalized === $correctNormalized;
    }

    /**
     * Normalize a string by converting to lowercase and removing accents
     * Supports French and other European languages
     */
    public static function normalize($string)
    {
        if (empty($string)) {
            return '';
        }

        // Convert to lowercase
        $string = mb_strtolower($string, 'UTF-8');
        
        // Remove extra whitespace
        $string = trim($string);
        $string = preg_replace('/\s+/', ' ', $string);
        
        // Normalize accented characters
        $string = preg_replace_callback('/./u', function($matches) {
            $char = $matches[0];
            $map = [
                // French accents
                'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a',
                'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
                'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
                'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o',
                'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u',
                'ý' => 'y', 'ÿ' => 'y',
                'ñ' => 'n',
                'ç' => 'c',
                'æ' => 'ae', 'œ' => 'oe',
                // Uppercase versions
                'À' => 'a', 'Á' => 'a', 'Â' => 'a', 'Ã' => 'a', 'Ä' => 'a', 'Å' => 'a',
                'È' => 'e', 'É' => 'e', 'Ê' => 'e', 'Ë' => 'e',
                'Ì' => 'i', 'Í' => 'i', 'Î' => 'i', 'Ï' => 'i',
                'Ò' => 'o', 'Ó' => 'o', 'Ô' => 'o', 'Õ' => 'o', 'Ö' => 'o',
                'Ù' => 'u', 'Ú' => 'u', 'Û' => 'u', 'Ü' => 'u',
                'Ý' => 'y', 'Ÿ' => 'y',
                'Ñ' => 'n',
                'Ç' => 'c',
                'Æ' => 'ae', 'Œ' => 'oe'
            ];
            return $map[$char] ?? $char;
        }, $string);
        
        return $string;
    }

    /**
     * Check if a string contains French special characters
     */
    public static function hasFrenchCharacters($string)
    {
        $frenchChars = ['à', 'á', 'â', 'ã', 'ä', 'å', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 
                       'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'ñ', 'ç', 'æ', 'œ',
                       'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï',
                       'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'Ÿ', 'Ñ', 'Ç', 'Æ', 'Œ'];
        
        foreach ($frenchChars as $char) {
            if (strpos($string, $char) !== false) {
                return true;
            }
        }
        
        return false;
    }
}

