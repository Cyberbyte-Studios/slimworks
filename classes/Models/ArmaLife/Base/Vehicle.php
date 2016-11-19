<?php

namespace Slimworks\Models\ArmaLife\Base;

use \DateTime;
use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use Slimworks\Models\ArmaLife\VehicleQuery as ChildVehicleQuery;
use Slimworks\Models\ArmaLife\Map\VehicleTableMap;

/**
 * Base class that represents a row from the 'vehicles' table.
 *
 *
 *
 * @package    propel.generator.Slimworks.Models.ArmaLife.Base
 */
abstract class Vehicle implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Slimworks\\Models\\ArmaLife\\Map\\VehicleTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the side field.
     *
     * @var        string
     */
    protected $side;

    /**
     * The value for the classname field.
     *
     * @var        string
     */
    protected $classname;

    /**
     * The value for the type field.
     *
     * @var        string
     */
    protected $type;

    /**
     * The value for the pid field.
     *
     * @var        string
     */
    protected $pid;

    /**
     * The value for the alive field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $alive;

    /**
     * The value for the blacklist field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $blacklist;

    /**
     * The value for the active field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $active;

    /**
     * The value for the plate field.
     *
     * @var        string
     */
    protected $plate;

    /**
     * The value for the platestring field.
     *
     * @var        string
     */
    protected $platestring;

    /**
     * The value for the color field.
     *
     * @var        int
     */
    protected $color;

    /**
     * The value for the inventory field.
     *
     * @var        string
     */
    protected $inventory;

    /**
     * The value for the gear field.
     *
     * @var        string
     */
    protected $gear;

    /**
     * The value for the fuel field.
     *
     * Note: this column has a database default value of: 1.0
     * @var        double
     */
    protected $fuel;

    /**
     * The value for the damage field.
     *
     * @var        string
     */
    protected $damage;

    /**
     * The value for the insert_time field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $insert_time;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->alive = true;
        $this->blacklist = false;
        $this->active = false;
        $this->fuel = 1.0;
    }

    /**
     * Initializes internal state of Slimworks\Models\ArmaLife\Base\Vehicle object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Vehicle</code> instance.  If
     * <code>obj</code> is an instance of <code>Vehicle</code>, delegates to
     * <code>equals(Vehicle)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Vehicle The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [side] column value.
     *
     * @return string
     */
    public function getSide()
    {
        return $this->side;
    }

    /**
     * Get the [classname] column value.
     *
     * @return string
     */
    public function getClassname()
    {
        return $this->classname;
    }

    /**
     * Get the [type] column value.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the [pid] column value.
     *
     * @return string
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * Get the [alive] column value.
     *
     * @return boolean
     */
    public function getAlive()
    {
        return $this->alive;
    }

    /**
     * Get the [alive] column value.
     *
     * @return boolean
     */
    public function isAlive()
    {
        return $this->getAlive();
    }

    /**
     * Get the [blacklist] column value.
     *
     * @return boolean
     */
    public function getBlacklist()
    {
        return $this->blacklist;
    }

    /**
     * Get the [blacklist] column value.
     *
     * @return boolean
     */
    public function isBlacklist()
    {
        return $this->getBlacklist();
    }

    /**
     * Get the [active] column value.
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get the [active] column value.
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->getActive();
    }

    /**
     * Get the [plate] column value.
     *
     * @return string
     */
    public function getPlate()
    {
        return $this->plate;
    }

    /**
     * Get the [platestring] column value.
     *
     * @return string
     */
    public function getPlatestring()
    {
        return $this->platestring;
    }

    /**
     * Get the [color] column value.
     *
     * @return int
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Get the [inventory] column value.
     *
     * @return string
     */
    public function getInventory()
    {
        return $this->inventory;
    }

    /**
     * Get the [gear] column value.
     *
     * @return string
     */
    public function getGear()
    {
        return $this->gear;
    }

    /**
     * Get the [fuel] column value.
     *
     * @return double
     */
    public function getFuel()
    {
        return $this->fuel;
    }

    /**
     * Get the [damage] column value.
     *
     * @return string
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * Get the [optionally formatted] temporal [insert_time] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getInsertTime($format = NULL)
    {
        if ($format === null) {
            return $this->insert_time;
        } else {
            return $this->insert_time instanceof \DateTimeInterface ? $this->insert_time->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[VehicleTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [side] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle The current object (for fluent API support)
     */
    public function setSide($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->side !== $v) {
            $this->side = $v;
            $this->modifiedColumns[VehicleTableMap::COL_SIDE] = true;
        }

        return $this;
    } // setSide()

    /**
     * Set the value of [classname] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle The current object (for fluent API support)
     */
    public function setClassname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->classname !== $v) {
            $this->classname = $v;
            $this->modifiedColumns[VehicleTableMap::COL_CLASSNAME] = true;
        }

        return $this;
    } // setClassname()

    /**
     * Set the value of [type] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[VehicleTableMap::COL_TYPE] = true;
        }

        return $this;
    } // setType()

    /**
     * Set the value of [pid] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle The current object (for fluent API support)
     */
    public function setPid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pid !== $v) {
            $this->pid = $v;
            $this->modifiedColumns[VehicleTableMap::COL_PID] = true;
        }

        return $this;
    } // setPid()

    /**
     * Sets the value of the [alive] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle The current object (for fluent API support)
     */
    public function setAlive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->alive !== $v) {
            $this->alive = $v;
            $this->modifiedColumns[VehicleTableMap::COL_ALIVE] = true;
        }

        return $this;
    } // setAlive()

    /**
     * Sets the value of the [blacklist] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle The current object (for fluent API support)
     */
    public function setBlacklist($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->blacklist !== $v) {
            $this->blacklist = $v;
            $this->modifiedColumns[VehicleTableMap::COL_BLACKLIST] = true;
        }

        return $this;
    } // setBlacklist()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->active !== $v) {
            $this->active = $v;
            $this->modifiedColumns[VehicleTableMap::COL_ACTIVE] = true;
        }

        return $this;
    } // setActive()

    /**
     * Set the value of [plate] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle The current object (for fluent API support)
     */
    public function setPlate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->plate !== $v) {
            $this->plate = $v;
            $this->modifiedColumns[VehicleTableMap::COL_PLATE] = true;
        }

        return $this;
    } // setPlate()

    /**
     * Set the value of [platestring] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle The current object (for fluent API support)
     */
    public function setPlatestring($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->platestring !== $v) {
            $this->platestring = $v;
            $this->modifiedColumns[VehicleTableMap::COL_PLATESTRING] = true;
        }

        return $this;
    } // setPlatestring()

    /**
     * Set the value of [color] column.
     *
     * @param int $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle The current object (for fluent API support)
     */
    public function setColor($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->color !== $v) {
            $this->color = $v;
            $this->modifiedColumns[VehicleTableMap::COL_COLOR] = true;
        }

        return $this;
    } // setColor()

    /**
     * Set the value of [inventory] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle The current object (for fluent API support)
     */
    public function setInventory($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->inventory !== $v) {
            $this->inventory = $v;
            $this->modifiedColumns[VehicleTableMap::COL_INVENTORY] = true;
        }

        return $this;
    } // setInventory()

    /**
     * Set the value of [gear] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle The current object (for fluent API support)
     */
    public function setGear($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gear !== $v) {
            $this->gear = $v;
            $this->modifiedColumns[VehicleTableMap::COL_GEAR] = true;
        }

        return $this;
    } // setGear()

    /**
     * Set the value of [fuel] column.
     *
     * @param double $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle The current object (for fluent API support)
     */
    public function setFuel($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->fuel !== $v) {
            $this->fuel = $v;
            $this->modifiedColumns[VehicleTableMap::COL_FUEL] = true;
        }

        return $this;
    } // setFuel()

    /**
     * Set the value of [damage] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle The current object (for fluent API support)
     */
    public function setDamage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->damage !== $v) {
            $this->damage = $v;
            $this->modifiedColumns[VehicleTableMap::COL_DAMAGE] = true;
        }

        return $this;
    } // setDamage()

    /**
     * Sets the value of [insert_time] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle The current object (for fluent API support)
     */
    public function setInsertTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->insert_time !== null || $dt !== null) {
            if ($this->insert_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->insert_time->format("Y-m-d H:i:s.u")) {
                $this->insert_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[VehicleTableMap::COL_INSERT_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setInsertTime()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->alive !== true) {
                return false;
            }

            if ($this->blacklist !== false) {
                return false;
            }

            if ($this->active !== false) {
                return false;
            }

            if ($this->fuel !== 1.0) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : VehicleTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : VehicleTableMap::translateFieldName('Side', TableMap::TYPE_PHPNAME, $indexType)];
            $this->side = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : VehicleTableMap::translateFieldName('Classname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->classname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : VehicleTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : VehicleTableMap::translateFieldName('Pid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : VehicleTableMap::translateFieldName('Alive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->alive = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : VehicleTableMap::translateFieldName('Blacklist', TableMap::TYPE_PHPNAME, $indexType)];
            $this->blacklist = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : VehicleTableMap::translateFieldName('Active', TableMap::TYPE_PHPNAME, $indexType)];
            $this->active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : VehicleTableMap::translateFieldName('Plate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->plate = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : VehicleTableMap::translateFieldName('Platestring', TableMap::TYPE_PHPNAME, $indexType)];
            $this->platestring = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : VehicleTableMap::translateFieldName('Color', TableMap::TYPE_PHPNAME, $indexType)];
            $this->color = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : VehicleTableMap::translateFieldName('Inventory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->inventory = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : VehicleTableMap::translateFieldName('Gear', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gear = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : VehicleTableMap::translateFieldName('Fuel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fuel = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : VehicleTableMap::translateFieldName('Damage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->damage = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : VehicleTableMap::translateFieldName('InsertTime', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->insert_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 16; // 16 = VehicleTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Slimworks\\Models\\ArmaLife\\Vehicle'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VehicleTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildVehicleQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Vehicle::setDeleted()
     * @see Vehicle::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(VehicleTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildVehicleQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(VehicleTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                VehicleTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[VehicleTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . VehicleTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(VehicleTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(VehicleTableMap::COL_SIDE)) {
            $modifiedColumns[':p' . $index++]  = 'side';
        }
        if ($this->isColumnModified(VehicleTableMap::COL_CLASSNAME)) {
            $modifiedColumns[':p' . $index++]  = 'classname';
        }
        if ($this->isColumnModified(VehicleTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'type';
        }
        if ($this->isColumnModified(VehicleTableMap::COL_PID)) {
            $modifiedColumns[':p' . $index++]  = 'pid';
        }
        if ($this->isColumnModified(VehicleTableMap::COL_ALIVE)) {
            $modifiedColumns[':p' . $index++]  = 'alive';
        }
        if ($this->isColumnModified(VehicleTableMap::COL_BLACKLIST)) {
            $modifiedColumns[':p' . $index++]  = 'blacklist';
        }
        if ($this->isColumnModified(VehicleTableMap::COL_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'active';
        }
        if ($this->isColumnModified(VehicleTableMap::COL_PLATE)) {
            $modifiedColumns[':p' . $index++]  = 'plate';
        }
        if ($this->isColumnModified(VehicleTableMap::COL_PLATESTRING)) {
            $modifiedColumns[':p' . $index++]  = 'plateString';
        }
        if ($this->isColumnModified(VehicleTableMap::COL_COLOR)) {
            $modifiedColumns[':p' . $index++]  = 'color';
        }
        if ($this->isColumnModified(VehicleTableMap::COL_INVENTORY)) {
            $modifiedColumns[':p' . $index++]  = 'inventory';
        }
        if ($this->isColumnModified(VehicleTableMap::COL_GEAR)) {
            $modifiedColumns[':p' . $index++]  = 'gear';
        }
        if ($this->isColumnModified(VehicleTableMap::COL_FUEL)) {
            $modifiedColumns[':p' . $index++]  = 'fuel';
        }
        if ($this->isColumnModified(VehicleTableMap::COL_DAMAGE)) {
            $modifiedColumns[':p' . $index++]  = 'damage';
        }
        if ($this->isColumnModified(VehicleTableMap::COL_INSERT_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'insert_time';
        }

        $sql = sprintf(
            'INSERT INTO vehicles (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'side':
                        $stmt->bindValue($identifier, $this->side, PDO::PARAM_STR);
                        break;
                    case 'classname':
                        $stmt->bindValue($identifier, $this->classname, PDO::PARAM_STR);
                        break;
                    case 'type':
                        $stmt->bindValue($identifier, $this->type, PDO::PARAM_STR);
                        break;
                    case 'pid':
                        $stmt->bindValue($identifier, $this->pid, PDO::PARAM_STR);
                        break;
                    case 'alive':
                        $stmt->bindValue($identifier, (int) $this->alive, PDO::PARAM_INT);
                        break;
                    case 'blacklist':
                        $stmt->bindValue($identifier, (int) $this->blacklist, PDO::PARAM_INT);
                        break;
                    case 'active':
                        $stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);
                        break;
                    case 'plate':
                        $stmt->bindValue($identifier, $this->plate, PDO::PARAM_STR);
                        break;
                    case 'plateString':
                        $stmt->bindValue($identifier, $this->platestring, PDO::PARAM_STR);
                        break;
                    case 'color':
                        $stmt->bindValue($identifier, $this->color, PDO::PARAM_INT);
                        break;
                    case 'inventory':
                        $stmt->bindValue($identifier, $this->inventory, PDO::PARAM_STR);
                        break;
                    case 'gear':
                        $stmt->bindValue($identifier, $this->gear, PDO::PARAM_STR);
                        break;
                    case 'fuel':
                        $stmt->bindValue($identifier, $this->fuel, PDO::PARAM_STR);
                        break;
                    case 'damage':
                        $stmt->bindValue($identifier, $this->damage, PDO::PARAM_STR);
                        break;
                    case 'insert_time':
                        $stmt->bindValue($identifier, $this->insert_time ? $this->insert_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = VehicleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getSide();
                break;
            case 2:
                return $this->getClassname();
                break;
            case 3:
                return $this->getType();
                break;
            case 4:
                return $this->getPid();
                break;
            case 5:
                return $this->getAlive();
                break;
            case 6:
                return $this->getBlacklist();
                break;
            case 7:
                return $this->getActive();
                break;
            case 8:
                return $this->getPlate();
                break;
            case 9:
                return $this->getPlatestring();
                break;
            case 10:
                return $this->getColor();
                break;
            case 11:
                return $this->getInventory();
                break;
            case 12:
                return $this->getGear();
                break;
            case 13:
                return $this->getFuel();
                break;
            case 14:
                return $this->getDamage();
                break;
            case 15:
                return $this->getInsertTime();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {

        if (isset($alreadyDumpedObjects['Vehicle'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Vehicle'][$this->hashCode()] = true;
        $keys = VehicleTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getSide(),
            $keys[2] => $this->getClassname(),
            $keys[3] => $this->getType(),
            $keys[4] => $this->getPid(),
            $keys[5] => $this->getAlive(),
            $keys[6] => $this->getBlacklist(),
            $keys[7] => $this->getActive(),
            $keys[8] => $this->getPlate(),
            $keys[9] => $this->getPlatestring(),
            $keys[10] => $this->getColor(),
            $keys[11] => $this->getInventory(),
            $keys[12] => $this->getGear(),
            $keys[13] => $this->getFuel(),
            $keys[14] => $this->getDamage(),
            $keys[15] => $this->getInsertTime(),
        );
        if ($result[$keys[15]] instanceof \DateTime) {
            $result[$keys[15]] = $result[$keys[15]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }


        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = VehicleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setSide($value);
                break;
            case 2:
                $this->setClassname($value);
                break;
            case 3:
                $this->setType($value);
                break;
            case 4:
                $this->setPid($value);
                break;
            case 5:
                $this->setAlive($value);
                break;
            case 6:
                $this->setBlacklist($value);
                break;
            case 7:
                $this->setActive($value);
                break;
            case 8:
                $this->setPlate($value);
                break;
            case 9:
                $this->setPlatestring($value);
                break;
            case 10:
                $this->setColor($value);
                break;
            case 11:
                $this->setInventory($value);
                break;
            case 12:
                $this->setGear($value);
                break;
            case 13:
                $this->setFuel($value);
                break;
            case 14:
                $this->setDamage($value);
                break;
            case 15:
                $this->setInsertTime($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = VehicleTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setSide($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setClassname($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setType($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPid($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAlive($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setBlacklist($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setActive($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setPlate($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setPlatestring($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setColor($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setInventory($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setGear($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setFuel($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setDamage($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setInsertTime($arr[$keys[15]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Slimworks\Models\ArmaLife\Vehicle The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(VehicleTableMap::DATABASE_NAME);

        if ($this->isColumnModified(VehicleTableMap::COL_ID)) {
            $criteria->add(VehicleTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(VehicleTableMap::COL_SIDE)) {
            $criteria->add(VehicleTableMap::COL_SIDE, $this->side);
        }
        if ($this->isColumnModified(VehicleTableMap::COL_CLASSNAME)) {
            $criteria->add(VehicleTableMap::COL_CLASSNAME, $this->classname);
        }
        if ($this->isColumnModified(VehicleTableMap::COL_TYPE)) {
            $criteria->add(VehicleTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(VehicleTableMap::COL_PID)) {
            $criteria->add(VehicleTableMap::COL_PID, $this->pid);
        }
        if ($this->isColumnModified(VehicleTableMap::COL_ALIVE)) {
            $criteria->add(VehicleTableMap::COL_ALIVE, $this->alive);
        }
        if ($this->isColumnModified(VehicleTableMap::COL_BLACKLIST)) {
            $criteria->add(VehicleTableMap::COL_BLACKLIST, $this->blacklist);
        }
        if ($this->isColumnModified(VehicleTableMap::COL_ACTIVE)) {
            $criteria->add(VehicleTableMap::COL_ACTIVE, $this->active);
        }
        if ($this->isColumnModified(VehicleTableMap::COL_PLATE)) {
            $criteria->add(VehicleTableMap::COL_PLATE, $this->plate);
        }
        if ($this->isColumnModified(VehicleTableMap::COL_PLATESTRING)) {
            $criteria->add(VehicleTableMap::COL_PLATESTRING, $this->platestring);
        }
        if ($this->isColumnModified(VehicleTableMap::COL_COLOR)) {
            $criteria->add(VehicleTableMap::COL_COLOR, $this->color);
        }
        if ($this->isColumnModified(VehicleTableMap::COL_INVENTORY)) {
            $criteria->add(VehicleTableMap::COL_INVENTORY, $this->inventory);
        }
        if ($this->isColumnModified(VehicleTableMap::COL_GEAR)) {
            $criteria->add(VehicleTableMap::COL_GEAR, $this->gear);
        }
        if ($this->isColumnModified(VehicleTableMap::COL_FUEL)) {
            $criteria->add(VehicleTableMap::COL_FUEL, $this->fuel);
        }
        if ($this->isColumnModified(VehicleTableMap::COL_DAMAGE)) {
            $criteria->add(VehicleTableMap::COL_DAMAGE, $this->damage);
        }
        if ($this->isColumnModified(VehicleTableMap::COL_INSERT_TIME)) {
            $criteria->add(VehicleTableMap::COL_INSERT_TIME, $this->insert_time);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildVehicleQuery::create();
        $criteria->add(VehicleTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Slimworks\Models\ArmaLife\Vehicle (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setSide($this->getSide());
        $copyObj->setClassname($this->getClassname());
        $copyObj->setType($this->getType());
        $copyObj->setPid($this->getPid());
        $copyObj->setAlive($this->getAlive());
        $copyObj->setBlacklist($this->getBlacklist());
        $copyObj->setActive($this->getActive());
        $copyObj->setPlate($this->getPlate());
        $copyObj->setPlatestring($this->getPlatestring());
        $copyObj->setColor($this->getColor());
        $copyObj->setInventory($this->getInventory());
        $copyObj->setGear($this->getGear());
        $copyObj->setFuel($this->getFuel());
        $copyObj->setDamage($this->getDamage());
        $copyObj->setInsertTime($this->getInsertTime());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Slimworks\Models\ArmaLife\Vehicle Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->side = null;
        $this->classname = null;
        $this->type = null;
        $this->pid = null;
        $this->alive = null;
        $this->blacklist = null;
        $this->active = null;
        $this->plate = null;
        $this->platestring = null;
        $this->color = null;
        $this->inventory = null;
        $this->gear = null;
        $this->fuel = null;
        $this->damage = null;
        $this->insert_time = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(VehicleTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
