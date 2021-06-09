<?php

namespace Application\config;

use Application\config\MysqlDBAdapter;

class Migration extends MysqlDBAdapter
{
    const FILE_PATH = './schema.sql';

    public function getSql()
    {
        $file = file_get_contents(self::FILE_PATH);
    }
}
