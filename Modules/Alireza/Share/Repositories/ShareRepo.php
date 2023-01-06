<?php

namespace Alireza\Share\Repositories;

class ShareRepo
{
    public static function successMassage($title, $body = 'عملیات با موفقیت انجام شد'){
        return alert()->success($title, $body);

    }

}
