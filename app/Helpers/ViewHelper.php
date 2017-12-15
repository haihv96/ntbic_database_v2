<?php

function randClassTable($index)
{
    return ['success', 'info', 'warning', 'danger'][$index % 4];
}
