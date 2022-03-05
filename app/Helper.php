<?php

namespace App;

use App\Models\InputFormTypes;

class Helper
{

    public static function check_input_choice($id)
    {
        return InputFormTypes::where("id", $id)->where("choice", 1)->exists();
    }
}