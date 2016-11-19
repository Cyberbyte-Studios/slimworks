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
use Slimworks\Models\ArmaLife\Vehicle;
use Slimworks\Models\ArmaLife\VehicleQuery;


/**
 * This class defines the structure of the 'vehicles' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class VehicleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Slimworks.Models.ArmaLife.Map.VehicleTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'armalife';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'vehicles';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Slimworks\\Models\\ArmaLife\\Vehicle';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Slimworks.Models.ArmaLife.Vehicle';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 16;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 16;

    /**
     * the column name for the id field
     */
    const COL_ID = 'vehicles.id';

    /**
     * the column name for the side field
     */
    const COL_SIDE = 'vehicles.side';

    /**
     * the column name for the classname field
     */
    const COL_CLASSNAME = 'vehicles.classname';

    /**
     * the column name for the type field
     */
    const COL_TYPE = 'vehicles.type';

    /**
     * the column name for the pid field
     */
    const COL_PID = 'vehicles.pid';

    /**
     * the column name for the alive field
     */
    const COL_ALIVE = 'vehicles.alive';

    /**
     * the column name for the blacklist field
     */
    const COL_BLACKLIST = 'vehicles.blacklist';

    /**
     * the column name for the active field
     */
    const COL_ACTIVE = 'vehicles.active';

    /**
     * the column name for the plate field
     */
    const COL_PLATE = 'vehicles.plate';

    /**
     * the column name for the plateString field
     */
    const COL_PLATESTRING = 'vehicles.plateString';

    /**
     * the column name for the color field
     */
    const COL_COLOR = 'vehicles.color';

    /**
     * the column name for the inventory field
     */
    const COL_INVENTORY = 'vehicles.inventory';

    /**
     * the column name for the gear field
     */
    const COL_GEAR = 'vehicles.gear';

    /**
     * the column name for the fuel field
     */
    const COL_FUEL = 'vehicles.fuel';

    /**
     * the column name for the damage field
     */
    const COL_DAMAGE = 'vehicles.damage';

    /**
     * the column name for the insert_time field
     */
    const COL_INSERT_TIME = 'vehicles.insert_time';

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
        self::TYPE_PHPNAME       => array('Id', 'Side', 'Classname', 'Type', 'Pid', 'Alive', 'Blacklist', 'Active', 'Plate', 'Platestring', 'Color', 'Inventory', 'Gear', 'Fuel', 'Damage', 'InsertTime', ),
        self::TYPE_CAMELNAME     => array('id', 'side', 'classname', 'type', 'pid', 'alive', 'blacklist', 'active', 'plate', 'platestring', 'color', 'inventory', 'gear', 'fuel', 'damage', 'insertTime', ),
        self::TYPE_COLNAME       => array(VehicleTableMap::COL_ID, VehicleTableMap::COL_SIDE, VehicleTableMap::COL_CLASSNAME, VehicleTableMap::COL_TYPE, VehicleTableMap::COL_PID, VehicleTableMap::COL_ALIVE, VehicleTableMap::COL_BLACKLIST, VehicleTableMap::COL_ACTIVE, VehicleTableMap::COL_PLATE, VehicleTableMap::COL_PLATESTRING, VehicleTableMap::COL_COLOR, VehicleTableMap::COL_INVENTORY, VehicleTableMap::COL_GEAR, VehicleTableMap::COL_FUEL, VehicleTableMap::COL_DAMAGE, VehicleTableMap::COL_INSERT_TIME, ),
        self::TYPE_FIELDNAME     => array('id', 'side', 'classname', 'type', 'pid', 'alive', 'blacklist', 'active', 'plate', 'plateString', 'color', 'inventory', 'gear', 'fuel', 'damage', 'insert_time', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Side' => 1, 'Classname' => 2, 'Type' => 3, 'Pid' => 4, 'Alive' => 5, 'Blacklist' => 6, 'Active' => 7, 'Plate' => 8, 'Platestring' => 9, 'Color' => 10, 'Inventory' => 11, 'Gear' => 12, 'Fuel' => 13, 'Damage' => 14, 'InsertTime' => 15, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'side' => 1, 'classname' => 2, 'type' => 3, 'pid' => 4, 'alive' => 5, 'blacklist' => 6, 'active' => 7, 'plate' => 8, 'platestring' => 9, 'color' => 10, 'inventory' => 11, 'gear' => 12, 'fuel' => 13, 'damage' => 14, 'insertTime' => 15, ),
        self::TYPE_COLNAME       => array(VehicleTableMap::COL_ID => 0, VehicleTableMap::COL_SIDE => 1, VehicleTableMap::COL_CLASSNAME => 2, VehicleTableMap::COL_TYPE => 3, VehicleTableMap::COL_PID => 4, VehicleTableMap::COL_ALIVE => 5, VehicleTableMap::COL_BLACKLIST => 6, VehicleTableMap::COL_ACTIVE => 7, VehicleTableMap::COL_PLATE => 8, VehicleTableMap::COL_PLATESTRING => 9, VehicleTableMap::COL_COLOR => 10, VehicleTableMap::COL_INVENTORY => 11, VehicleTableMap::COL_GEAR => 12, VehicleTableMap::COL_FUEL => 13, VehicleTableMap::COL_DAMAGE => 14, VehicleTableMap::COL_INSERT_TIME => 15, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'side' => 1, 'classname' => 2, 'type' => 3, 'pid' => 4, 'alive' => 5, 'blacklist' => 6, 'active' => 7, 'plate' => 8, 'plateString' => 9, 'color' => 10, 'inventory' => 11, 'gear' => 12, 'fuel' => 13, 'damage' => 14, 'insert_time' => 15, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
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
        $this->setName('vehicles');
        $this->setPhpName('Vehicle');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Slimworks\\Models\\ArmaLife\\Vehicle');
        $this->setPackage('Slimworks.Models.ArmaLife');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 12, null);
        $this->addColumn('side', 'Side', 'VARCHAR', true, 16, null);
        $this->addColumn('classname', 'Classname', 'VARCHAR', true, 64, null);
        $this->addColumn('type', 'Type', 'VARCHAR', true, 16, null);
        $this->addColumn('pid', 'Pid', 'VARCHAR', true, 32, null);
        $this->addColumn('alive', 'Alive', 'BOOLEAN', true, 1, true);
        $this->addColumn('blacklist', 'Blacklist', 'BOOLEAN', true, 1, false);
        $this->addColumn('active', 'Active', 'BOOLEAN', true, 1, false);
        $this->addColumn('plate', 'Plate', 'VARCHAR', true, 64, null);
        $this->addColumn('plateString', 'Platestring', 'VARCHAR', true, 64, null);
        $this->addColumn('color', 'Color', 'INTEGER', true, 20, null);
        $this->addColumn('inventory', 'Inventory', 'LONGVARCHAR', true, null, null);
        $this->addColumn('gear', 'Gear', 'LONGVARCHAR', true, null, null);
        $this->addColumn('fuel', 'Fuel', 'DOUBLE', true, null, 1);
        $this->addColumn('damage', 'Damage', 'VARCHAR', true, 256, null);
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
        return (int) $row[
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
        return $withPrefix ? VehicleTableMap::CLASS_DEFAULT : VehicleTableMap::OM_CLASS;
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
     * @return array           (Vehicle object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = VehicleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = VehicleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + VehicleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = VehicleTableMap::OM_CLASS;
            /** @var Vehicle $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            VehicleTableMap::addInstanceToPool($obj, $key);
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
            $key = VehicleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = VehicleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Vehicle $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                VehicleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(VehicleTableMap::COL_ID);
            $criteria->addSelectColumn(VehicleTableMap::COL_SIDE);
            $criteria->addSelectColumn(VehicleTableMap::COL_CLASSNAME);
            $criteria->addSelectColumn(VehicleTableMap::COL_TYPE);
            $criteria->addSelectColumn(VehicleTableMap::COL_PID);
            $criteria->addSelectColumn(VehicleTableMap::COL_ALIVE);
            $criteria->addSelectColumn(VehicleTableMap::COL_BLACKLIST);
            $criteria->addSelectColumn(VehicleTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(VehicleTableMap::COL_PLATE);
            $criteria->addSelectColumn(VehicleTableMap::COL_PLATESTRING);
            $criteria->addSelectColumn(VehicleTableMap::COL_COLOR);
            $criteria->addSelectColumn(VehicleTableMap::COL_INVENTORY);
            $criteria->addSelectColumn(VehicleTableMap::COL_GEAR);
            $criteria->addSelectColumn(VehicleTableMap::COL_FUEL);
            $criteria->addSelectColumn(VehicleTableMap::COL_DAMAGE);
            $criteria->addSelectColumn(VehicleTableMap::COL_INSERT_TIME);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.side');
            $criteria->addSelectColumn($alias . '.classname');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.pid');
            $criteria->addSelectColumn($alias . '.alive');
            $criteria->addSelectColumn($alias . '.blacklist');
            $criteria->addSelectColumn($alias . '.active');
            $criteria->addSelectColumn($alias . '.plate');
            $criteria->addSelectColumn($alias . '.plateString');
            $criteria->addSelectColumn($alias . '.color');
            $criteria->addSelectColumn($alias . '.inventory');
            $criteria->addSelectColumn($alias . '.gear');
            $criteria->addSelectColumn($alias . '.fuel');
            $criteria->addSelectColumn($alias . '.damage');
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
        return Propel::getServiceContainer()->getDatabaseMap(VehicleTableMap::DATABASE_NAME)->getTable(VehicleTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(VehicleTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(VehicleTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new VehicleTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Vehicle or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Vehicle object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(VehicleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Slimworks\Models\ArmaLife\Vehicle) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(VehicleTableMap::DATABASE_NAME);
            $criteria->add(VehicleTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = VehicleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            VehicleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                VehicleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the vehicles table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return VehicleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Vehicle or Criteria object.
     *
     * @param mixed               $criteria Criteria or Vehicle object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VehicleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Vehicle object
        }

        if ($criteria->containsKey(VehicleTableMap::COL_ID) && $criteria->keyContainsValue(VehicleTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.VehicleTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = VehicleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // VehicleTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
VehicleTableMap::buildTableMap();
