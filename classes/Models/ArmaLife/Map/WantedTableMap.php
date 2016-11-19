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
use Slimworks\Models\ArmaLife\Wanted;
use Slimworks\Models\ArmaLife\WantedQuery;


/**
 * This class defines the structure of the 'wanted' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class WantedTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Slimworks.Models.ArmaLife.Map.WantedTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'armalife';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'wanted';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Slimworks\\Models\\ArmaLife\\Wanted';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Slimworks.Models.ArmaLife.Wanted';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the wantedID field
     */
    const COL_WANTEDID = 'wanted.wantedID';

    /**
     * the column name for the wantedName field
     */
    const COL_WANTEDNAME = 'wanted.wantedName';

    /**
     * the column name for the wantedCrimes field
     */
    const COL_WANTEDCRIMES = 'wanted.wantedCrimes';

    /**
     * the column name for the wantedBounty field
     */
    const COL_WANTEDBOUNTY = 'wanted.wantedBounty';

    /**
     * the column name for the active field
     */
    const COL_ACTIVE = 'wanted.active';

    /**
     * the column name for the insert_time field
     */
    const COL_INSERT_TIME = 'wanted.insert_time';

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
        self::TYPE_PHPNAME       => array('Id', 'Name', 'Crimes', 'Bounty', 'Active', 'InsertTime', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'crimes', 'bounty', 'active', 'insertTime', ),
        self::TYPE_COLNAME       => array(WantedTableMap::COL_WANTEDID, WantedTableMap::COL_WANTEDNAME, WantedTableMap::COL_WANTEDCRIMES, WantedTableMap::COL_WANTEDBOUNTY, WantedTableMap::COL_ACTIVE, WantedTableMap::COL_INSERT_TIME, ),
        self::TYPE_FIELDNAME     => array('wantedID', 'wantedName', 'wantedCrimes', 'wantedBounty', 'active', 'insert_time', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'Crimes' => 2, 'Bounty' => 3, 'Active' => 4, 'InsertTime' => 5, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'crimes' => 2, 'bounty' => 3, 'active' => 4, 'insertTime' => 5, ),
        self::TYPE_COLNAME       => array(WantedTableMap::COL_WANTEDID => 0, WantedTableMap::COL_WANTEDNAME => 1, WantedTableMap::COL_WANTEDCRIMES => 2, WantedTableMap::COL_WANTEDBOUNTY => 3, WantedTableMap::COL_ACTIVE => 4, WantedTableMap::COL_INSERT_TIME => 5, ),
        self::TYPE_FIELDNAME     => array('wantedID' => 0, 'wantedName' => 1, 'wantedCrimes' => 2, 'wantedBounty' => 3, 'active' => 4, 'insert_time' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
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
        $this->setName('wanted');
        $this->setPhpName('Wanted');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Slimworks\\Models\\ArmaLife\\Wanted');
        $this->setPackage('Slimworks.Models.ArmaLife');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('wantedID', 'Id', 'VARCHAR', true, 64, null);
        $this->addColumn('wantedName', 'Name', 'VARCHAR', true, 32, null);
        $this->addColumn('wantedCrimes', 'Crimes', 'LONGVARCHAR', true, null, null);
        $this->addColumn('wantedBounty', 'Bounty', 'INTEGER', true, 100, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', true, 1, false);
        $this->addColumn('insert_time', 'InsertTime', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? WantedTableMap::CLASS_DEFAULT : WantedTableMap::OM_CLASS;
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
     * @return array           (Wanted object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = WantedTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WantedTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WantedTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WantedTableMap::OM_CLASS;
            /** @var Wanted $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WantedTableMap::addInstanceToPool($obj, $key);
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
            $key = WantedTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WantedTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Wanted $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WantedTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WantedTableMap::COL_WANTEDID);
            $criteria->addSelectColumn(WantedTableMap::COL_WANTEDNAME);
            $criteria->addSelectColumn(WantedTableMap::COL_WANTEDCRIMES);
            $criteria->addSelectColumn(WantedTableMap::COL_WANTEDBOUNTY);
            $criteria->addSelectColumn(WantedTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(WantedTableMap::COL_INSERT_TIME);
        } else {
            $criteria->addSelectColumn($alias . '.wantedID');
            $criteria->addSelectColumn($alias . '.wantedName');
            $criteria->addSelectColumn($alias . '.wantedCrimes');
            $criteria->addSelectColumn($alias . '.wantedBounty');
            $criteria->addSelectColumn($alias . '.active');
            $criteria->addSelectColumn($alias . '.insert_time');
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
        return Propel::getServiceContainer()->getDatabaseMap(WantedTableMap::DATABASE_NAME)->getTable(WantedTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(WantedTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(WantedTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new WantedTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Wanted or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Wanted object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WantedTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Slimworks\Models\ArmaLife\Wanted) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WantedTableMap::DATABASE_NAME);
            $criteria->add(WantedTableMap::COL_WANTEDID, (array) $values, Criteria::IN);
        }

        $query = WantedQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WantedTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WantedTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the wanted table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return WantedQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Wanted or Criteria object.
     *
     * @param mixed               $criteria Criteria or Wanted object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WantedTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Wanted object
        }


        // Set the correct dbName
        $query = WantedQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // WantedTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
WantedTableMap::buildTableMap();
