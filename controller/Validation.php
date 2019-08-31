<?php

/* very important
 * 
 * 
 *  *Validation ->checkitem($value,$key)
 * 
 *  *satization ->SantizeItem($value,$key)
 */

class Validation {

    function validate($data, $rules) {
        $valid = TRUE;
        foreach ($rules as $key => $rule) {
            $callbacks = explode('|', $rule);
            foreach ($callbacks as $callback) {
                $value = isset($data[$key]) ? $data[$key] : NULL;
                if (is_array($value)) {
                    foreach ($value as $val) {
                        if ($this->$callback($val, $key) == FALSE)
                            $valid = FALSE;
                    }
                } else {
                    if ($this->$callback($value, $key) == FALSE)
                        $valid = FALSE;
                }
            }
        }
        return $valid;
    }

    function checkstring($value, $key) {
       $validate=preg_match("^%$#!+=[0-9]'\"{},().:-$^", $value);
        if ($validate == TRUE){
            throw new Exception(":الاسم  يجب ان يتكون من حروف فقط!!");
        }
        return $validate;
    }

    function checktext($value, $key) {
        $pattern = "^[A-Za-z][أ-ي]^";
        $validate = preg_match($pattern, $value);
        if ($validate == TRUE)
            throw new Exception("يجب ان يكون صحيح خطا $key   ال..");

        return $validate;
    }

    function checkint($value, $key) {
        $validate = filter_var($value, FILTER_VALIDATE_INT);
        if ($validate == FALSE)
            throw new Exception($key ."يجب ادخال ارقام فقط فال ");

        return $validate;
    }

    function checkdate($value, $key) {
        if ($value < date('Y-m-d'))
            throw new Exception("خطا التاريخ يجب ان يكون صحيح!!");

        return $value;
    }

    function checkphone($value, $key) {
        if (strlen($value) != 11  || preg_match("^[A-Za-z][أ-ي]'\"{},().:-$^", $value) == TRUE) {
            throw new Exception("خطأ: أدخل الرقم بصوره صحيحه -_-..");
        }
        return $value;
    }

    function checkpassword($value, $key) {
        if (strlen($value) < 6) {
            throw new Exception("خطأ: الباسورد يجب ان لايقل عن 6 احرف او ارقام\n");
            if (preg_match("^%$#!+='\"{},().:-$^", $value) == TRUE) {
                throw new Exception("خطأ:الباسورد لا يجب ان يحتوي علي هذه العلامات !");
            }
            return $value;
        }
    }

    function checkemail($value, $key) {
        $validate = filter_var($value, FILTER_VALIDATE_EMAIL);
        if ($validate == FALSE || preg_match("^%$#!+='\"{},():$^", $value) == TRUE)
            throw new Exception("خطأ ادخل الايميل بصوره صحيحه!!");

        return $validate;
    }

    function checkurl($value, $key) {
        $validate = filter_var($value, FILTER_VALIDATE_URL);
        if ($validate == FALSE)
            throw new Exception("خطأ ادخل الرابط بصوره صحيحه !!");

        return $validate;
    }

    function checkip($value, $key) {
        $validate = filter_var($value, FILTER_VALIDATE_IP);
        if ($validate == FALSE)
            throw new Exception("ERROR: The $key Must be Valid ip..");

        return $validate;
    }

    function checkempty($value, $key) {
        $validate = empty($value);
        if ($validate == TRUE)
            throw new Exception("لا يجب ان يكون فارغ !! $key ");

        return $validate;
    }

    function checkimage($value, $key) {

        $img = explode(".", $value)[1];

        if ($img != 'jpg' || $img != 'png')
            throw new Exception("ERROR: There is an error in $value ..");

        return $validate;
    }

    function SantizeItem($value, $key) {
        $flag = NULL;
        switch ($key) {
            case email:
                $value = substr($value, 0, 250);
                $filter = FILTER_SANITIZE_EMAIL;
                break;
            case url:
                $filter = FILTER_SANITIZE_URL;
                break;
            case int:
                $filter = FILTER_SANITIZE_NUMBER_INT;
                break;

            default :
                $filter = FILTER_SANITIZE_STRING;
                $flag = FILTER_FLAG_NO_ENCODE_QUOTES;
                break;
        }
        $validate = filter_var($value, $filter, $flag);
        if ($validate == FALSE)
            throw new Exception("ERROR: The $key is invalid..");

        return $validate;
    }

}
