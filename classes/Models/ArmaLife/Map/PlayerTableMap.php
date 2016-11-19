<?php

namespace Slimworks\Models\ArmaLife\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use Slimworks\Models\ArmaLife\Player;
use Slimworks\Models\ArmaLife\PlayerQuery;


/**
 * This class defines the structure of the 'players' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PlayerTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Slimworks.Models.ArmaLife.Map.PlayerTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'armalife';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'players';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Slimworks\\Models\\ArmaLife\\Player';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Slimworks.Models.ArmaLife.Player';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 26;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 26;

    /**
     * the column name for the uid field
     */
    const COL_UID = 'players.uid';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'players.name';

    /**
     * the column name for the aliases field
     */
    const COL_ALIASES = 'players.aliases';

    /**
     * the column name for the playerid field
     */
    const COL_PLAYERID = 'players.playerid';

    /**
     * the column name for the cash field
     */
    const COL_CASH = 'players.cash';

    /**
     * the column name for the bankacc field
     */
    const COL_BANKACC = 'players.bankacc';

    /**
     * the column name for the coplevel field
     */
    const COL_COPLEVEL = 'players.coplevel';

    /**
     * the column name for the mediclevel field
     */
    const COL_MEDICLEVEL = 'players.mediclevel';

    /**
     * the column name for the civ_licenses field
     */
    const COL_CIV_LICENSES = 'players.civ_licenses';

    /**
     * the column name for the cop_licenses field
     */
    const COL_COP_LICENSES = 'players.cop_licenses';

    /**
     * the column name for the med_licenses field
     */
    const COL_MED_LICENSES = 'players.med_licenses';

    /**
     * the column name for the civ_gear field
     */
    const COL_CIV_GEAR = 'players.civ_gear';

    /**
     * the column name for the cop_gear field
     */
    const COL_COP_GEAR = 'players.cop_gear';

    /**
     * the column name for the med_gear field
     */
    const COL_MED_GEAR = 'players.med_gear';

    /**
     * the column name for the civ_stats field
     */
    const COL_CIV_STATS = 'players.civ_stats';

    /**
     * the column name for the cop_stats field
     */
    const COL_COP_STATS = 'players.cop_stats';

    /**
     * the column name for the med_stats field
     */
    const COL_MED_STATS = 'players.med_stats';

    /**
     * the column name for the arrested field
     */
    const COL_ARRESTED = 'players.arrested';

    /**
     * the column name for the adminlevel field
     */
    const COL_ADMINLEVEL = 'players.adminlevel';

    /**
     * the column name for the donorlevel field
     */
    const COL_DONORLEVEL = 'players.donorlevel';

    /**
     * the column name for the blacklist field
     */
    const COL_BLACKLIST = 'players.blacklist';

    /**
     * the column name for the civ_alive field
     */
    const COL_CIV_ALIVE = 'players.civ_alive';

    /**
     * the column name for the civ_position field
     */
    const COL_CIV_POSITION = 'players.civ_position';

    /**
     * the column name for the playtime field
     */
    const COL_PLAYTIME = 'players.playtime';

    /**
     * the column name for the insert_time field
     */
    const COL_INSERT_TIME = 'players.insert_time';

    /**
     * the column name for the last_seen field
     */
    const COL_LAST_SEEN = 'players.last_seen';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Uid', 'Name', 'Aliases', 'Playerid', 'Cash', 'Bankacc', 'Coplevel', 'Mediclevel', 'CivLicenses', 'CopLicenses', 'MedLicenses', 'CivGear', 'CopGear', 'MedGear', 'CivStats', 'CopStats', 'MedStats', 'Arrested', 'Adminlevel', 'Donorlevel', 'Blacklist', 'CivAlive', 'CivPosition', 'Playtime', 'InsertTime', 'LastSeen', ),
        self::TYPE_CAMELNAME     => array('uid', 'name', 'aliases', 'playerid', 'cash', 'bankacc', 'coplevel', 'mediclevel', 'civLicenses', 'copLicenses', 'medLicenses', 'civGear', 'copGear', 'medGear', 'civStats', 'copStats', 'medStats', 'arrested', 'adminlevel', 'donorlevel', 'blacklist', 'civAlive', 'civPosition', 'playtime', 'insertTime', 'lastSeen', ),
        self::TYPE_COLNAME       => array(PlayerTableMap::COL_UID, PlayerTableMap::COL_NAME, PlayerTableMap::COL_ALIASES, PlayerTableMap::COL_PLAYERID, PlayerTableMap::COL_CASH, PlayerTableMap::COL_BANKACC, PlayerTableMap::COL_COPLEVEL, PlayerTableMap::COL_MEDICLEVEL, PlayerTableMap::COL_CIV_LICENSES, PlayerTableMap::COL_COP_LICENSES, PlayerTableMap::COL_MED_LICENSES, PlayerTableMap::COL_CIV_GEAR, PlayerTableMap::COL_COP_GEAR, PlayerTableMap::COL_MED_GEAR, PlayerTableMap::COL_CIV_STATS, PlayerTableMap::COL_COP_STATS, PlayerTableMap::COL_MED_STATS, PlayerTableMap::COL_ARRESTED, PlayerTableMap::COL_ADMINLEVEL, PlayerTableMap::COL_DONORLEVEL, PlayerTableMap::COL_BLACKLIST, PlayerTableMap::COL_CIV_ALIVE, PlayerTableMap::COL_CIV_POSITION, PlayerTableMap::COL_PLAYTIME, PlayerTableMap::COL_INSERT_TIME, PlayerTableMap::COL_LAST_SEEN, ),
        self::TYPE_FIELDNAME     => array('uid', 'name', 'aliases', 'playerid', 'cash', 'bankacc', 'coplevel', 'mediclevel', 'civ_licenses', 'cop_licenses', 'med_licenses', 'civ_gear', 'cop_gear', 'med_gear', 'civ_stats', 'cop_stats', 'med_stats', 'arrested', 'adminlevel', 'donorlevel', 'blacklist', 'civ_alive', 'civ_position', 'playtime', 'insert_time', 'last_seen', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Uid' => 0, 'Name' => 1, 'Aliases' => 2, 'Playerid' => 3, 'Cash' => 4, 'Bankacc' => 5, 'Coplevel' => 6, 'Mediclevel' => 7, 'CivLicenses' => 8, 'CopLicenses' => 9, 'MedLicenses' => 10, 'CivGear' => 11, 'CopGear' => 12, 'MedGear' => 13, 'CivStats' => 14, 'CopStats' => 15, 'MedStats' => 16, 'Arrested' => 17, 'Adminlevel' => 18, 'Donorlevel' => 19, 'Blacklist' => 20, 'CivAlive' => 21, 'CivPosition' => 22, 'Playtime' => 23, 'InsertTime' => 24, 'LastSeen' => 25, ),
        self::TYPE_CAMELNAME     => array('uid' => 0, 'name' => 1, 'aliases' => 2, 'playerid' => 3, 'cash' => 4, 'bankacc' => 5, 'coplevel' => 6, 'mediclevel' => 7, 'civLicenses' => 8, 'copLicenses' => 9, 'medLicenses' => 10, 'civGear' => 11, 'copGear' => 12, 'medGear' => 13, 'civStats' => 14, 'copStats' => 15, 'medStats' => 16, 'arrested' => 17, 'adminlevel' => 18, 'donorlevel' => 19, 'blacklist' => 20, 'civAlive' => 21, 'civPosition' => 22, 'playtime' => 23, 'insertTime' => 24, 'lastSeen' => 25, ),
        self::TYPE_COLNAME       => array(PlayerTableMap::COL_UID => 0, PlayerTableMap::COL_NAME => 1, PlayerTableMap::COL_ALIASES => 2, PlayerTableMap::COL_PLAYERID => 3, PlayerTableMap::COL_CASH => 4, PlayerTableMap::COL_BANKACC => 5, PlayerTableMap::COL_COPLEVEL => 6, PlayerTableMap::COL_MEDICLEVEL => 7, PlayerTableMap::COL_CIV_LICENSES => 8, PlayerTableMap::COL_COP_LICENSES => 9, PlayerTableMap::COL_MED_LICENSES => 10, PlayerTableMap::COL_CIV_GEAR => 11, PlayerTableMap::COL_COP_GEAR => 12, PlayerTableMap::COL_MED_GEAR => 13, PlayerTableMap::COL_CIV_STATS => 14, PlayerTableMap::COL_COP_STATS => 15, PlayerTableMap::COL_MED_STATS => 16, PlayerTableMap::COL_ARRESTED => 17, PlayerTableMap::COL_ADMINLEVEL => 18, PlayerTableMap::COL_DONORLEVEL => 19, PlayerTableMap::COL_BLACKLIST => 20, PlayerTableMap::COL_CIV_ALIVE => 21, PlayerTableMap::COL_CIV_POSITION => 22, PlayerTableMap::COL_PLAYTIME => 23, PlayerTableMap::COL_INSERT_TIME => 24, PlayerTableMap::COL_LAST_SEEN => 25, ),
        self::TYPE_FIELDNAME     => array('uid' => 0, 'name' => 1, 'aliases' => 2, 'playerid' => 3, 'cash' => 4, 'bankacc' => 5, 'coplevel' => 6, 'mediclevel' => 7, 'civ_licenses' => 8, 'cop_licenses' => 9, 'med_licenses' => 10, 'civ_gear' => 11, 'cop_gear' => 12, 'med_gear' => 13, 'civ_stats' => 14, 'cop_stats' => 15, 'med_stats' => 16, 'arrested' => 17, 'adminlevel' => 18, 'donorlevel' => 19, 'blacklist' => 20, 'civ_alive' => 21, 'civ_position' => 22, 'playtime' => 23, 'insert_time' => 24, 'last_seen' => 25, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('players');
        $this->setPhpName('Player');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Slimworks\\Models\\ArmaLife\\Player');
        $this->setPackage('Slimworks.Models.ArmaLife');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('uid', 'Uid', 'INTEGER', true, 12, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 32, null);
        $this->addColumn('aliases', 'Aliases', 'LONGVARCHAR', true, null, null);
        $this->addColumn('playerid', 'Playerid', 'VARCHAR', true, 64, null);
        $this->addColumn('cash', 'Cash', 'INTEGER', true, 100, 0);
        $this->addColumn('bankacc', 'Bankacc', 'INTEGER', true, 100, 0);
        $this->addColumn('coplevel', 'Coplevel', 'CHAR', true, null, '0');
        $this->addColumn('mediclevel', 'Mediclevel', 'CHAR', true, null, '0');
        $this->addColumn('civ_licenses', 'CivLicenses', 'LONGVARCHAR', true, null, null);
        $this->addColumn('cop_licenses', 'CopLicenses', 'LONGVARCHAR', true, null, null);
        $this->addColumn('med_licenses', 'MedLicenses', 'LONGVARCHAR', true, null, null);
        $this->addColumn('civ_gear', 'CivGear', 'LONGVARCHAR', true, null, null);
        $this->addColumn('cop_gear', 'CopGear', 'LONGVARCHAR', true, null, null);
        $this->addColumn('med_gear', 'MedGear', 'LONGVARCHAR', true, null, null);
        $this->addColumn('civ_stats', 'CivStats', 'VARCHAR', true, 32, '"[100,100,0]"');
        $this->addColumn('cop_stats', 'CopStats', 'VARCHAR', true, 32, '"[100,100,0]"');
        $this->addColumn('med_stats', 'MedStats', 'VARCHAR', true, 32, '"[100,100,0]"');
        $this->addColumn('arrested', 'Arrested', 'BOOLEAN', true, 1, false);
        $this->addColumn('adminlevel', 'Adminlevel', 'CHAR', true, null, '0');
        $this->addColumn('donorlevel', 'Donorlevel', 'CHAR', true, null, '0');
        $this->addColumn('blacklist', 'Blacklist', 'BOOLEAN', true, 1, false);
        $this->addColumn('civ_alive', 'CivAlive', 'BOOLEAN', true, 1, false);
        $this->addColumn('civ_position', 'CivPosition', 'VARCHAR', true, 64, '"[]"');
        $this->addColumn('playtime', 'Playtime', 'VARCHAR', true, 32, '"[0,0,0]"');
        $this->addColumn('insert_time', 'InsertTime', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('last_seen', 'LastSeen', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uid', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Uid', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? PlayerTableMap::CLASS_DEFAULT : PlayerTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Player object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PlayerTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PlayerTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PlayerTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PlayerTableMap::OM_CLASS;
            /** @var Player $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PlayerTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = PlayerTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PlayerTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Player $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PlayerTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(PlayerTableMap::COL_UID);
            $criteria->addSelectColumn(PlayerTableMap::COL_NAME);
            $criteria->addSelectColumn(PlayerTableMap::COL_ALIASES);
            $criteria->addSelectColumn(PlayerTableMap::COL_PLAYERID);
            $criteria->addSelectColumn(PlayerTableMap::COL_CASH);
            $criteria->addSelectColumn(PlayerTableMap::COL_BANKACC);
            $criteria->addSelectColumn(PlayerTableMap::COL_COPLEVEL);
            $criteria->addSelectColumn(PlayerTableMap::COL_MEDICLEVEL);
            $criteria->addSelectColumn(PlayerTableMap::COL_CIV_LICENSES);
            $criteria->addSelectColumn(PlayerTableMap::COL_COP_LICENSES);
            $criteria->addSelectColumn(PlayerTableMap::COL_MED_LICENSES);
            $criteria->addSelectColumn(PlayerTableMap::COL_CIV_GEAR);
            $criteria->addSelectColumn(PlayerTableMap::COL_COP_GEAR);
            $criteria->addSelectColumn(PlayerTableMap::COL_MED_GEAR);
            $criteria->addSelectColumn(PlayerTableMap::COL_CIV_STATS);
            $criteria->addSelectColumn(PlayerTableMap::COL_COP_STATS);
            $criteria->addSelectColumn(PlayerTableMap::COL_MED_STATS);
            $criteria->addSelectColumn(PlayerTableMap::COL_ARRESTED);
            $criteria->addSelectColumn(PlayerTableMap::COL_ADMINLEVEL);
            $criteria->addSelectColumn(PlayerTableMap::COL_DONORLEVEL);
            $criteria->addSelectColumn(PlayerTableMap::COL_BLACKLIST);
            $criteria->addSelectColumn(PlayerTableMap::COL_CIV_ALIVE);
            $criteria->addSelectColumn(PlayerTableMap::COL_CIV_POSITION);
            $criteria->addSelectColumn(PlayerTableMap::COL_PLAYTIME);
            $criteria->addSelectColumn(PlayerTableMap::COL_INSERT_TIME);
            $criteria->addSelectColumn(PlayerTableMap::COL_LAST_SEEN);
        } else {
            $criteria->addSelectColumn($alias . '.uid');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.aliases');
            $criteria->addSelectColumn($alias . '.playerid');
            $criteria->addSelectColumn($alias . '.cash');
            $criteria->addSelectColumn($alias . '.bankacc');
            $criteria->addSelectColumn($alias . '.coplevel');
            $criteria->addSelectColumn($alias . '.mediclevel');
            $criteria->addSelectColumn($alias . '.civ_licenses');
            $criteria->addSelectColumn($alias . '.cop_licenses');
            $criteria->addSelectColumn($alias . '.med_licenses');
            $criteria->addSelectColumn($alias . '.civ_gear');
            $criteria->addSelectColumn($alias . '.cop_gear');
            $criteria->addSelectColumn($alias . '.med_gear');
            $criteria->addSelectColumn($alias . '.civ_stats');
            $criteria->addSelectColumn($alias . '.cop_stats');
            $criteria->addSelectColumn($alias . '.med_stats');
            $criteria->addSelectColumn($alias . '.arrested');
            $criteria->addSelectColumn($alias . '.adminlevel');
            $criteria->addSelectColumn($alias . '.donorlevel');
            $criteria->addSelectColumn($alias . '.blacklist');
            $criteria->addSelectColumn($alias . '.civ_alive');
            $criteria->addSelectColumn($alias . '.civ_position');
            $criteria->addSelectColumn($alias . '.playtime');
            $criteria->addSelectColumn($alias . '.insert_time');
            $criteria->addSelectColumn($alias . '.last_seen');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(PlayerTableMap::DATABASE_NAME)->getTable(PlayerTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PlayerTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PlayerTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PlayerTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Player or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Player object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PlayerTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Slimworks\Models\ArmaLife\Player) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PlayerTableMap::DATABASE_NAME);
            $criteria->add(PlayerTableMap::COL_UID, (array) $values, Criteria::IN);
        }

        $query = PlayerQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PlayerTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PlayerTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the players table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PlayerQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Player or Criteria object.
     *
     * @param mixed               $criteria Criteria or Player object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PlayerTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Player object
        }

        if ($criteria->containsKey(PlayerTableMap::COL_UID) && $criteria->keyContainsValue(PlayerTableMap::COL_UID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PlayerTableMap::COL_UID.')');
        }


        // Set the correct dbName
        $query = PlayerQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PlayerTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PlayerTableMap::buildTableMap();
