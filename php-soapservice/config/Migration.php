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

    public function delete()
    {
        $tables = ['companies', 'holidays', 'services', 'service_categories', 'service_rates', 'service_request', 'users', 'work_orders'];
        echo "Started truncation...";
        foreach($tables as $table) {
            $this->getConnection()->exec("TRUNCATE TABLE {$table}");
        }
        echo "Done...";
    }
}
