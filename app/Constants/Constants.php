<?php

namespace App\Constants;

class Constants
{
    const ACTIVE = 1;

    const IN_ACTIVE = 0;

    const PAID = 3;

    const DELIVERY = 2;

    const CANCEL = 4;

    const STATUS_ORDER = [
        self::IN_ACTIVE => 'Chưa xác nhận',
        self::ACTIVE    => 'Đã xác nhận',
        self::DELIVERY  => 'Đang giao',
        self::PAID      => 'Đã thanh toán',
        self::CANCEL    => 'Hủy đơn',
    ];

    const BUTTON_ORDER = [
        self::IN_ACTIVE => 'btn-primary',
        self::ACTIVE    => 'btn-info',
        self::DELIVERY  => 'btn-success',
    ];
}
