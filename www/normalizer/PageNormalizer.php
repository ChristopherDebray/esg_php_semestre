<?php
namespace App\normalizer;

use App\core\Logger;

class PageNormalizer
{
  public function normalize(Page $data)
  {
    
  }

  public static function getGroupContentDataByKey(array $data, string $group)
  {
    $result = [];
    $isNestedData = false;

    // Regroupe les contenu en fonction du group spécifié, par exemple content-quote-info & content-quote-author seront groupé par -quote-
    foreach ($data as $key => $value) {
      if (strpos('-'.$key.'-', $group) !== false) {
        $keyAsArray = explode('-', $key);

        if (count($keyAsArray) > 3) {
          $isNestedData = true;
          $result[$keyAsArray[1].'-'.$keyAsArray[2]][$keyAsArray[3]] = $value;
        } else {
          $result[$keyAsArray[count($keyAsArray)-1]] = $value;
        }
      }
    }

    return $isNestedData ? array_values($result) : $result;
  }

  public function getNestedGroupContentDataByKey(array $data, string $group)
  {
    $results= [];
    foreach ($data as $key => $value) {
      if (strpos('-'.$key.'-', $group) !== false) {
        $keyAsArray = explode('-', $key);

        $results[$keyAsArray[1].'-'.$keyAsArray[2]][$keyAsArray[3]] = $value;
      }
    }

    return array_values($results);
  }
}