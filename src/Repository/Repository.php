<?php

namespace App\Repository;

use Exception;

class Repository
{
    protected $tablename = null;

    protected $columnId = "id";

    /* Functions */
    protected function processSingleResult($result)
    {
        if (!$result) {
            throw new Exception($result->error);
        }

        $row = $result->fetch_object();

        $result->close();

        return $row;
    }

    protected function processMultipleResults($result)
    {
        if (!$result) {
            throw new Exception($result->error);
        }

        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }

        $result->close();

        return $rows;
    }
}
