<?php

function stringToPath($string)
{
    $string = trim($string);
    $vi = mbStrSplit(' âấầậẩẫéèẽẹẻêếềểệễăắằẳặẵáàảạãđýỳỵỷỹúùụũủưứừửữựíìịỉĩóòõọỏôốồộổỗơởợờỡớÂẤẦẬẨẪÉÈẼẸẺÊẾỀẺỆỄĂĂẰẲẶẴÁÀẢẠÃĐÝỲỴỶỸÚÙỤŨỦƯỨỪỬỰỮÍÌỊỈĨÓÒÕỌỎÔỐỒỘỔỖƠỞỢỜỠỚ');
    $en = mbStrSplit('-aaaaaaeeeeeeeeeeeaaaaaaaaaaadyyyyyuuuuuuuuuuuiiiiioooooooooooooooooaaaaaaeeeeeeeeeeeaaaaaaaaaaadyyyyyuuuuuuuuuuuiiiiiooooooooooooooooo');
    return trim(preg_replace('/[^0-9A-Za-z-]/', '', strtolower(str_replace($vi, $en, $string))), '-');
}

function mbStrSplit($string)
{
    return preg_split('/(?<!^)(?!$)/u', $string);
}

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