<?php

class CheckCaptcha {

    function showCaptcha($txtName = 'sagarCaptcha', $placeholder = true, $class='') {

        $words = array(
            'zero',
            'one',
            'two',
            'three',
            'four',
            'five',
            'six',
            'seven',
            'eight',
            'nine',
            'ten'
        );
        $sagar = mt_rand(0, 1);
        $dig1 = mt_rand(1, 10);
        $dig2 = mt_rand(0, 10);
        $sagartxt = '';

        switch ($sagar) {
            case 0:

                $result = $dig1 + $dig2;
                $sagartxt = '+';
                break;
            case 1:

                if ($dig1 < $dig2) {
                    $dig1 = mt_rand($dig2, 10);
                }

                $result = $dig1 - $dig2;
                $sagartxt = '-';
                break;
        }

        $view = '';

        $isWord = mt_rand(0, 2);
        if ($isWord <= 0) {
            $view .= $words[$dig1];
        } else {
            $view .= $dig1;
        }

        $view .= " $sagartxt ";

        if ($isWord == 1) {
            $view .= $words[$dig2];
        } else {
            $view .= $dig2;
        }

        if ($placeholder) {
            $view .="=?";
//            $view = '<label class="form-label rd-input-label" for="' . $txtName . '">' . $view . '</label>';
            $view = '<input type="text" placeholder="' . $view . '" value="" name="' . $txtName . '" data-constraints="@Required" id="' . $txtName . '" '.$class.' autocomplete="off" required class="form-control form-control-has-validation form-control-last-child"  >';
        } else {
            $view .="=?";
            $view = '<input type="text" value="" name="' . $txtName . '" id="' . $txtName . '" size="3" maxlength="3" class="form-control" required /> ';
        }

        $_SESSION[$txtName . 'result'] = $result;

        return $view;
    }

    function validCaptcha($txtName = 'sagarCaptcha') {
        if ($_POST[$txtName] != $_SESSION[$txtName . 'result']) {
            return false;
        } else {
            return true;
        }
    }

}

$chk = new CheckCaptcha();
?>