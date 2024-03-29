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
use Slimworks\Models\ArmaLife\Container;
use Slimworks\Models\ArmaLife\ContainerQuery;


/**
 * This class defines the structure of the 'containers' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ContainerTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Slimworks.Models.ArmaLife.Map.ContainerTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'armalife';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'containers';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Slimworks\\Models\\ArmaLife\\Container';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Slimworks.Models.ArmaLife.Container';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id field
     */
    const COL_ID = 'containers.id';

    /**
     * the column name for the pid field
     */
    const COL_PID = 'containers.pid';

    /**
     * the column name for the classname field
     */
    const COL_CLASSNAME = 'containers.classname';

    /**
     * the column name for the pos field
     */
    const COL_POS = 'containers.pos';

    /**
     * the column name for the inventory field
     */
    const COL_INVENTORY = 'containers.inventory';

    /**
     * the column name for the gear field
     */
    const COL_GEAR = 'containers.gear';

    /**
     * the column name for the dir field
     */
    const COL_DIR = 'containers.dir';

    /**
     * the column name for the active field
     */
    const COL_ACTIVE = 'containers.active';

    /**
     * the column name for the owned field
     */
    const COL_OWNED = 'containers.owned';

    /**
     * the column name for the insert_time field
     */
    const COL_INSERT_TIME = 'containers.insert_time';

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
        self::TYPE_PHPNAME       => array('Id', 'Pid', 'Classname', 'Pos', 'Inventory', 'Gear', 'Dir', 'Active', 'Owned', 'InsertTime', ),
        self::TYPE_CAMELNAME     => array('id', 'pid', 'classname', 'pos', 'inventory', 'gear', 'dir', 'active', 'owned', 'insertTime', ),
        self::TYPE_COLNAME       => array(ContainerTableMap::COL_ID, ContainerTableMap::COL_PID, ContainerTableMap::COL_CLASSNAME, ContainerTableMap::COL_POS, ContainerTableMap::COL_INVENTORY, ContainerTableMap::COL_GEAR, ContainerTableMap::COL_DIR, ContainerTableMap::COL_ACTIVE, ContainerTableMap::COL_OWNED, ContainerTableMap::COL_INSERT_TIME, ),
        self::TYPE_FIELDNAME     => array('id', 'pid', 'classname', 'pos', 'inventory', 'gear', 'dir', 'active', 'owned', 'insert_time', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Pid' => 1, 'Classname' => 2, 'Pos' => 3, 'Inventory' => 4, 'Gear' => 5, 'Dir' => 6, 'Active' => 7, 'Owned' => 8, 'InsertTime' => 9, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'pid' => 1, 'classname' => 2, 'pos' => 3, 'inventory' => 4, 'gear' => 5, 'dir' => 6, 'active' => 7, 'owned' => 8, 'insertTime' => 9, ),
        self::TYPE_COLNAME       => array(ContainerTableMap::COL_ID => 0, ContainerTableMap::COL_PID => 1, ContainerTableMap::COL_CLASSNAME => 2, ContainerTableMap::COL_POS => 3, ContainerTableMap::COL_INVENTORY => 4, ContainerTableMap::COL_GEAR => 5, ContainerTableMap::COL_DIR => 6, ContainerTableMap::COL_ACTIVE => 7, ContainerTableMap::COL_OWNED => 8, ContainerTableMap::COL_INSERT_TIME => 9, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'pid' => 1, 'classname' => 2, 'pos' => 3, 'inventory' => 4, 'gear' => 5, 'dir' => 6, 'active' => 7, 'owned' => 8, 'insert_time' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->setName('containers');
        $this->setPhpName('Container');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Slimworks\\Models\\ArmaLife\\Container');
        $this->setPackage('Slimworks.Models.ArmaLife');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addPrimaryKey('pid', 'Pid', 'VARCHAR', true, 32, null);
        $this->addColumn('classname', 'Classname', 'VARCHAR', true, 32, null);
        $this->addColumn('pos', 'Pos', 'VARCHAR', false, 64, null);
        $this->addColumn('inventory', 'Inventory', 'LONGVARCHAR', true, null, null);
        $this->addColumn('gear', 'Gear', 'LONGVARCHAR', true, null, null);
        $this->addColumn('dir', 'Dir', 'VARCHAR', false, 128, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', true, 1, false);
        $this->addColumn('owned', 'Owned', 'BOOLEAN', false, 1, false);
        $this->addColumn('insert_time', 'InsertTime', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Slimworks\Models\ArmaLife\Container $obj A \Slimworks\Models\ArmaLife\Container object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getId() || is_scalar($obj->getId()) || is_callable([$obj->getId(), '__toString']) ? (string) $obj->getId() : $obj->getId()), (null === $obj->getPid() || is_scalar($obj->getPid()) || is_callable([$obj->getPid(), '__toString']) ? (string) $obj->getPid() : $obj->getPid())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \Slimworks\Models\ArmaLife\Container object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Slimworks\Models\ArmaLife\Container) {
                $key = serialize([(null === $value->getId() || is_scalar($value->getId()) || is_callable([$value->getId(), '__toString']) ? (string) $value->getId() : $value->getId()), (null === $value->getPid() || is_scalar($value->getPid()) || is_callable([$value->getPid(), '__toString']) ? (string) $value->getPid() : $value->getPid())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Slimworks\Models\ArmaLife\Container object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Pid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Pid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Pid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Pid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Pid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Pid', TableMap::TYPE_PHPNAME, $indexType)])]);
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
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('Pid', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? ContainerTableMap::CLASS_DEFAULT : ContainerTableMap::OM_CLASS;
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
     * @return array           (Container object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ContainerTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ContainerTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ContainerTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ContainerTableMap::OM_CLASS;
            /** @var Container $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ContainerTableMap::addInstanceToPool($obj, $key);
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
            $key = ContainerTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ContainerTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Container $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ContainerTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ContainerTableMap::COL_ID);
            $criteria->addSelectColumn(ContainerTableMap::COL_PID);
            $criteria->addSelectColumn(ContainerTableMap::COL_CLASSNAME);
            $criteria->addSelectColumn(ContainerTableMap::COL_POS);
            $criteria->addSelectColumn(ContainerTableMap::COL_INVENTORY);
            $criteria->addSelectColumn(ContainerTableMap::COL_GEAR);
            $criteria->addSelectColumn(ContainerTableMap::COL_DIR);
            $criteria->addSelectColumn(ContainerTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(ContainerTableMap::COL_OWNED);
            $criteria->addSelectColumn(ContainerTableMap::COL_INSERT_TIME);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.pid');
            $criteria->addSelectColumn($alias . '.classname');
            $criteria->addSelectColumn($alias . '.pos');
            $criteria->addSelectColumn($alias . '.inventory');
            $criteria->addSelectColumn($alias . '.gear');
            $criteria->addSelectColumn($alias . '.dir');
            $criteria->addSelectColumn($alias . '.active');
            $criteria->addSelectColumn($alias . '.owned');
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
        return Propel::getServiceContainer()->getDatabaseMap(ContainerTableMap::DATABASE_NAME)->getTable(ContainerTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ContainerTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ContainerTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ContainerTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Container or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Container object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ContainerTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Slimworks\Models\ArmaLife\Container) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ContainerTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(ContainerTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(ContainerTableMap::COL_PID, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = ContainerQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ContainerTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ContainerTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the containers table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ContainerQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Container or Criteria object.
     *
     * @param mixed               $criteria Criteria or Container object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContainerTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Container object
        }

        if ($criteria->containsKey(ContainerTableMap::COL_ID) && $criteria->keyContainsValue(ContainerTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ContainerTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ContainerQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ContainerTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ContainerTableMap::buildTableMap();
