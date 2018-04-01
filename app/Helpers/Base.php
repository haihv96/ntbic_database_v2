<?php

function strToPath($str)
{
    $str = trim($str);
    $vi = mbStrSplit(' âấầậẩẫéèẽẹẻêếềểệễăắằẳặẵáàảạãđýỳỵỷỹúùụũủưứừửữựíìịỉĩóòõọỏôốồộổỗơởợờỡớÂẤẦẬẨẪÉÈẼẸẺÊẾỀẺỆỄĂĂẰẲẶẴÁÀẢẠÃĐÝỲỴỶỸÚÙỤŨỦƯỨỪỬỰỮÍÌỊỈĨÓÒÕỌỎÔỐỒỘỔỖƠỞỢỜỠỚ');
    $en = mbStrSplit('-aaaaaaeeeeeeeeeeeaaaaaaaaaaadyyyyyuuuuuuuuuuuiiiiioooooooooooooooooaaaaaaeeeeeeeeeeeaaaaaaaaaaadyyyyyuuuuuuuuuuuiiiiiooooooooooooooooo');
    return trim(preg_replace('/[^0-9A-Za-z-]/', '', strtolower(str_replace($vi, $en, $str))), '-');
}

function strNormalize($str)
{
    return str_replace('-', '', strToPath($str));
}

function mbStrSplit($str)
{
    return preg_split('/(?<!^)(?!$)/u', $str);
}

function assignObject($target, $source)
{
    $targetArray = $source->getFillable();
    foreach ($targetArray as $value) {
        $source[$value] = $target[$value];
    }

    return $source;
}
