<?php

function convertHtmlToText($element)
{
    return trim(
        str_replace(["\n", "\r"], "", strip_tags(
                $element->ownerDocument->saveHTML($element),
                '<p><br><strong><b><img>'
            )
        )
    );
}