<?php

class Db
{
    protected $db;

    public function __construct()
    {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::
                ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME .
            ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        if (!empty($params))
        {
            foreach ($params as $key => $val)
            {
                if (is_int($val))
                {
                    $type = PDO::PARAM_INT;
                } else
                {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':' . $key, $val, $type);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function rows($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll();
    }

    public function row($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetch();
    }

    public function column($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }

    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }

}