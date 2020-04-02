<?php

# main class file for static site

class systemFunction {

    
    function showError($type, $message) {
        return '<div class="alert alert-' . $type . ' text-center" style="margin-top: 10px;margin-bottom: 10px;">' . $message . '</div>';
    }

    function cleanVar($variable, $type = 'string') {
        $cleanVar = trim($variable);


        return $cleanVar;
    }
    
    function combogen($c, $names, $select, $keyAsValue = false) {
        if (is_array($select)) {
            $s = $select;
        } else {
            $s = explode(',', $select);
        }

        $opt = '';

        if ($keyAsValue) {
            foreach ($c as $key => $value) {
                $opt .= '<option value="' . $key . '"';
                if ($key == $select || in_array($key, $s) || $value == $select || in_array($value, $s)) {
                    $opt .= ' selected="selected"';
                }
                $opt .= '>' . $value . '</option>';
            }
        } else {

            for ($i = 0; $i < count($c); $i++) {
                $opt .= '<option value="' . $c[$i] . '"';
                if ($c[$i] == $select || in_array($c[$i], $s)) {
                    $opt .= ' selected="selected"';
                }
                $opt .= '>' . $names[$i] . '</option>';
            }
        }

        return $opt;
    }
     function execute($statement, $paramVal, $isMultipleInsert = false) {

        if ($isMultipleInsert) {
            $statement = strtolower($statement);
            if (strpos($statement, 'values') !== FALSE) {
                $statement = substr($statement, 0, strpos($statement, 'values'));
            }
            $placeholders = '';
            $placeVals = array();
            $c = 0;
            foreach ($paramVal as $keysnVals) {
                $placeholders .= '(';
                foreach ($keysnVals as $v) {
                    $c++;
                    $placeholders .= ':key' . $c . ', ';
                    $placeVals [':key' . $c] = $v;
                }
                $placeholders = substr($placeholders, 0, -2);
                $placeholders .= '), ';
            }
            $placeholders = substr($placeholders, 0, -2);
            $statement .= ' values ' . $placeholders;
            $paramVal = $placeVals;
        }
        $queryPrepare = $pdocon->prepare($statement);
        #var_dump($statement);
        #var_dump($paramVal);
        if ($queryPrepare->execute($paramVal)) {
            return true;
        } else {
            return false;
        }
    }
     public function query($sql, $fetchAll = true, $params = array()) {
        $result = array();
        $pdocon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (count($params) > 0 && is_array($params)) {
            $statement = $pdocon->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $statement->execute($params);
        } else {
            $statement = $pdocon->query($sql);
        }
        if ($fetchAll == true) {
            $result = $statement->fetchAll();
        } else {
            $result = $statement->fetch();
        }

        return $result;
    }
    function getPageUrl($param, $defaultPage = 'index') {
        if (!empty($param)) {
            $param = $this->cleanVar($param);
        } else {
            $param = $defaultPage;
        }
        return $param;
    }

    public function excecuteonly($sql) {
        global $pdocon;
        $statement = $pdocon->prepare($sql);
        $statement->execute();
        $count = $statement->rowCount();
        return $count;
    }

    function validateMe($value, $type = 'string') {

        $r = false;

        $value = trim($value);

        if (strlen($value) > 0) {

            switch ($type) {

                case 'string' :
                    $r = is_string($value);
                    break;
                case 'number' :
                    $r = filter_var($value, FILTER_VALIDATE_INT);
                    break;
                case 'float' :
                    $r = filter_var($value, FILTER_VALIDATE_FLOAT);
                    break;
                case 'email' :
                    $r = filter_var($value, FILTER_VALIDATE_EMAIL);
                    break;
                case 'url' :
                    $r = filter_var($value, FILTER_VALIDATE_URL);
                    break;
                case 'ip' :
                    $r = filter_var($value, FILTER_VALIDATE_IP);
                    break;
                case 'date' :
                    $r = strtotime($value);
                    break;
            }
        }

        return $r;
    }

}
$sys = new systemFunction();
?>
