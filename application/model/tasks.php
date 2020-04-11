<?php

class Tasks extends Model
{

    public function addTask($params)
    {
        $this->db->query('INSERT INTO tasks (name, email, description) VALUES (:name, :email, :description)', $params);

        return $this->db->lastInsertId();
    }


    public function deleteTask($params)
    {
        $this->db->query('DELETE FROM tasks WHERE id = :id', $params);
    }


    public function getTask($params)
    {
        return $this->db->row('SELECT * FROM tasks WHERE id = :id', $params);
    }


    public function updateTask($params)
    {
        $fields = '';

        foreach ($params as $key => $value)
        {
            if ($key == 'id')
                continue;
            if ($fields != '')
                $fields .= ', ';

            $fields .= "$key = :$key";
        }

        $this->db->query("UPDATE tasks SET $fields WHERE id = :id", $params);
    }


    public function getTotalTasks()
    {
        return $this->db->column('SELECT COUNT(id) AS count_tasks FROM tasks');
    }


    public function getListTasks($params, $order = 'id', $sort = 'ASC')
    {
        return $this->db->rows("SELECT * FROM tasks ORDER BY $order $sort LIMIT :start, :max", $params);
    }

}