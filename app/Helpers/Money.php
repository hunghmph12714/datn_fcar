<?php

if (!function_exists('currency_format')) {
    function currency_format($product, $suffix = ' VNĐ')
    {
        if (!empty($product)) {
            return number_format($product, 0, ',', '.') . "{$suffix}";
        }
    }
}