<?php
namespace App\Http\Controllers\Api\V1;

trait EsTrait
{
    public function appendHighlightIntoResults($results, $esResults)
    {
        foreach ($results as $index => $result) {
            if ($esResults['highlight'][$index]) {
                foreach ($esResults['highlight'][$index] as $key => $highlight) {
                    $result->{$key} = $highlight;
                };
            }
        }
        return $results;
    }
}