<?php

namespace Application\config;
class Migration extends MysqlDBAdapter
{
    const FILE_PATH = '../config/schema.sql';

    public function run()
    {
        echo "Started SQL dump...\n";
        $file = file_get_contents(self::FILE_PATH);
        try{
            $this->getConnection()->exec($file);
            echo "Done...\n";
        } catch(\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
