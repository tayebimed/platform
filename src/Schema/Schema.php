<?php

namespace Orchid\Platform\Schema;

use Orchid\Platform\Schema\Wrapper\MysqlWrapper;
use Orchid\Platform\Schema\Wrapper\PostgresWrapper;
use Orchid\Platform\Schema\Wrapper\SqliteWrapper;
use Orchid\Platform\Schema\Wrapper\SqlServerWrapper;

class Schema extends BaseSchema
{
    /**
     * @var
     */
    public $databaseWrapper;
    /**
     * @var array
     */
    public $headers = ['Field', 'Type', 'Null', 'Key', 'Default', 'Extra'];

    /**
     * Schema constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->switchWrapper();
    }

    public function switchWrapper()
    {
        $driverName = $this->database->getDriverName();
        switch ($driverName) {
            case 'mysql':
                $this->databaseWrapper = new MysqlWrapper($this);
                break;
            case 'sqlite':
                $this->headers = ['CID', 'Field', 'Type', 'Null', 'Key', 'Default'];
                $this->databaseWrapper = new SqliteWrapper($this);
                break;
            case 'pgsql':
                $this->headers = ['Field', 'Type', 'Null', 'Key', 'Default'];
                $this->databaseWrapper = new PostgresWrapper($this);
                break;
            case 'sqlsrv':
                $this->headers = ['Field', 'Type', 'Null', 'Key', 'Default', 'Char max len'];
                $this->databaseWrapper = new SqlServerWrapper($this);
                break;
            default:
                $this->databaseWrapper = new MysqlWrapper($this);
        }
    }
}
