<?php


namespace Controller;
use Helper\DB;

class Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function fromJson($data)
    {
        return json_decode($data,true);
    }

    public function toJson($data)
    {
        return json_encode($data);
    }
}