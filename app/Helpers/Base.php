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

function assignObject(array $attrs, $target, $source)
{
    foreach ($attrs as $attr) {
        $source[$attr] = $target[$attr];
    }

    return $source;
}