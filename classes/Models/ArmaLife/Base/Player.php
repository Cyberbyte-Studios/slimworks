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
use Slimworks\Models\ArmaLife\PlayerQuery as ChildPlayerQuery;
use Slimworks\Models\ArmaLife\Map\PlayerTableMap;

/**
 * Base class that represents a row from the 'players' table.
 *
 *
 *
 * @package    propel.generator.Slimworks.Models.ArmaLife.Base
 */
abstract class Player implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Slimworks\\Models\\ArmaLife\\Map\\PlayerTableMap';


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
     * The value for the uid field.
     *
     * @var        int
     */
    protected $uid;

    /**
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the aliases field.
     *
     * @var        string
     */
    protected $aliases;

    /**
     * The value for the playerid field.
     *
     * @var        string
     */
    protected $playerid;

    /**
     * The value for the cash field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $cash;

    /**
     * The value for the bankacc field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $bankacc;

    /**
     * The value for the coplevel field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $coplevel;

    /**
     * The value for the mediclevel field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $mediclevel;

    /**
     * The value for the civ_licenses field.
     *
     * @var        string
     */
    protected $civ_licenses;

    /**
     * The value for the cop_licenses field.
     *
     * @var        string
     */
    protected $cop_licenses;

    /**
     * The value for the med_licenses field.
     *
     * @var        string
     */
    protected $med_licenses;

    /**
     * The value for the civ_gear field.
     *
     * @var        string
     */
    protected $civ_gear;

    /**
     * The value for the cop_gear field.
     *
     * @var        string
     */
    protected $cop_gear;

    /**
     * The value for the med_gear field.
     *
     * @var        string
     */
    protected $med_gear;

    /**
     * The value for the civ_stats field.
     *
     * Note: this column has a database default value of: '"[100,100,0]"'
     * @var        string
     */
    protected $civ_stats;

    /**
     * The value for the cop_stats field.
     *
     * Note: this column has a database default value of: '"[100,100,0]"'
     * @var        string
     */
    protected $cop_stats;

    /**
     * The value for the med_stats field.
     *
     * Note: this column has a database default value of: '"[100,100,0]"'
     * @var        string
     */
    protected $med_stats;

    /**
     * The value for the arrested field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $arrested;

    /**
     * The value for the adminlevel field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $adminlevel;

    /**
     * The value for the donorlevel field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $donorlevel;

    /**
     * The value for the blacklist field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $blacklist;

    /**
     * The value for the civ_alive field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $civ_alive;

    /**
     * The value for the civ_position field.
     *
     * Note: this column has a database default value of: '"[]"'
     * @var        string
     */
    protected $civ_position;

    /**
     * The value for the playtime field.
     *
     * Note: this column has a database default value of: '"[0,0,0]"'
     * @var        string
     */
    protected $playtime;

    /**
     * The value for the insert_time field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $insert_time;

    /**
     * The value for the last_seen field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $last_seen;

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
        $this->cash = 0;
        $this->bankacc = 0;
        $this->coplevel = '0';
        $this->mediclevel = '0';
        $this->civ_stats = '"[100,100,0]"';
        $this->cop_stats = '"[100,100,0]"';
        $this->med_stats = '"[100,100,0]"';
        $this->arrested = false;
        $this->adminlevel = '0';
        $this->donorlevel = '0';
        $this->blacklist = false;
        $this->civ_alive = false;
        $this->civ_position = '"[]"';
        $this->playtime = '"[0,0,0]"';
    }

    /**
     * Initializes internal state of Slimworks\Models\ArmaLife\Base\Player object.
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
     * Compares this with another <code>Player</code> instance.  If
     * <code>obj</code> is an instance of <code>Player</code>, delegates to
     * <code>equals(Player)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Player The current object, for fluid interface
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
     * Get the [uid] column value.
     *
     * @return int
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [aliases] column value.
     *
     * @return string
     */
    public function getAliases()
    {
        return $this->aliases;
    }

    /**
     * Get the [playerid] column value.
     *
     * @return string
     */
    public function getPlayerid()
    {
        return $this->playerid;
    }

    /**
     * Get the [cash] column value.
     *
     * @return int
     */
    public function getCash()
    {
        return $this->cash;
    }

    /**
     * Get the [bankacc] column value.
     *
     * @return int
     */
    public function getBankacc()
    {
        return $this->bankacc;
    }

    /**
     * Get the [coplevel] column value.
     *
     * @return string
     */
    public function getCoplevel()
    {
        return $this->coplevel;
    }

    /**
     * Get the [mediclevel] column value.
     *
     * @return string
     */
    public function getMediclevel()
    {
        return $this->mediclevel;
    }

    /**
     * Get the [civ_licenses] column value.
     *
     * @return string
     */
    public function getCivLicenses()
    {
        return $this->civ_licenses;
    }

    /**
     * Get the [cop_licenses] column value.
     *
     * @return string
     */
    public function getCopLicenses()
    {
        return $this->cop_licenses;
    }

    /**
     * Get the [med_licenses] column value.
     *
     * @return string
     */
    public function getMedLicenses()
    {
        return $this->med_licenses;
    }

    /**
     * Get the [civ_gear] column value.
     *
     * @return string
     */
    public function getCivGear()
    {
        return $this->civ_gear;
    }

    /**
     * Get the [cop_gear] column value.
     *
     * @return string
     */
    public function getCopGear()
    {
        return $this->cop_gear;
    }

    /**
     * Get the [med_gear] column value.
     *
     * @return string
     */
    public function getMedGear()
    {
        return $this->med_gear;
    }

    /**
     * Get the [civ_stats] column value.
     *
     * @return string
     */
    public function getCivStats()
    {
        return $this->civ_stats;
    }

    /**
     * Get the [cop_stats] column value.
     *
     * @return string
     */
    public function getCopStats()
    {
        return $this->cop_stats;
    }

    /**
     * Get the [med_stats] column value.
     *
     * @return string
     */
    public function getMedStats()
    {
        return $this->med_stats;
    }

    /**
     * Get the [arrested] column value.
     *
     * @return boolean
     */
    public function getArrested()
    {
        return $this->arrested;
    }

    /**
     * Get the [arrested] column value.
     *
     * @return boolean
     */
    public function isArrested()
    {
        return $this->getArrested();
    }

    /**
     * Get the [adminlevel] column value.
     *
     * @return string
     */
    public function getAdminlevel()
    {
        return $this->adminlevel;
    }

    /**
     * Get the [donorlevel] column value.
     *
     * @return string
     */
    public function getDonorlevel()
    {
        return $this->donorlevel;
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
     * Get the [civ_alive] column value.
     *
     * @return boolean
     */
    public function getCivAlive()
    {
        return $this->civ_alive;
    }

    /**
     * Get the [civ_alive] column value.
     *
     * @return boolean
     */
    public function isCivAlive()
    {
        return $this->getCivAlive();
    }

    /**
     * Get the [civ_position] column value.
     *
     * @return string
     */
    public function getCivPosition()
    {
        return $this->civ_position;
    }

    /**
     * Get the [playtime] column value.
     *
     * @return string
     */
    public function getPlaytime()
    {
        return $this->playtime;
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
     * Get the [optionally formatted] temporal [last_seen] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getLastSeen($format = NULL)
    {
        if ($format === null) {
            return $this->last_seen;
        } else {
            return $this->last_seen instanceof \DateTimeInterface ? $this->last_seen->format($format) : null;
        }
    }

    /**
     * Set the value of [uid] column.
     *
     * @param int $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setUid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->uid !== $v) {
            $this->uid = $v;
            $this->modifiedColumns[PlayerTableMap::COL_UID] = true;
        }

        return $this;
    } // setUid()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[PlayerTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [aliases] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setAliases($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->aliases !== $v) {
            $this->aliases = $v;
            $this->modifiedColumns[PlayerTableMap::COL_ALIASES] = true;
        }

        return $this;
    } // setAliases()

    /**
     * Set the value of [playerid] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setPlayerid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->playerid !== $v) {
            $this->playerid = $v;
            $this->modifiedColumns[PlayerTableMap::COL_PLAYERID] = true;
        }

        return $this;
    } // setPlayerid()

    /**
     * Set the value of [cash] column.
     *
     * @param int $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setCash($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->cash !== $v) {
            $this->cash = $v;
            $this->modifiedColumns[PlayerTableMap::COL_CASH] = true;
        }

        return $this;
    } // setCash()

    /**
     * Set the value of [bankacc] column.
     *
     * @param int $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setBankacc($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->bankacc !== $v) {
            $this->bankacc = $v;
            $this->modifiedColumns[PlayerTableMap::COL_BANKACC] = true;
        }

        return $this;
    } // setBankacc()

    /**
     * Set the value of [coplevel] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setCoplevel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->coplevel !== $v) {
            $this->coplevel = $v;
            $this->modifiedColumns[PlayerTableMap::COL_COPLEVEL] = true;
        }

        return $this;
    } // setCoplevel()

    /**
     * Set the value of [mediclevel] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setMediclevel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mediclevel !== $v) {
            $this->mediclevel = $v;
            $this->modifiedColumns[PlayerTableMap::COL_MEDICLEVEL] = true;
        }

        return $this;
    } // setMediclevel()

    /**
     * Set the value of [civ_licenses] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setCivLicenses($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->civ_licenses !== $v) {
            $this->civ_licenses = $v;
            $this->modifiedColumns[PlayerTableMap::COL_CIV_LICENSES] = true;
        }

        return $this;
    } // setCivLicenses()

    /**
     * Set the value of [cop_licenses] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setCopLicenses($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cop_licenses !== $v) {
            $this->cop_licenses = $v;
            $this->modifiedColumns[PlayerTableMap::COL_COP_LICENSES] = true;
        }

        return $this;
    } // setCopLicenses()

    /**
     * Set the value of [med_licenses] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setMedLicenses($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->med_licenses !== $v) {
            $this->med_licenses = $v;
            $this->modifiedColumns[PlayerTableMap::COL_MED_LICENSES] = true;
        }

        return $this;
    } // setMedLicenses()

    /**
     * Set the value of [civ_gear] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setCivGear($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->civ_gear !== $v) {
            $this->civ_gear = $v;
            $this->modifiedColumns[PlayerTableMap::COL_CIV_GEAR] = true;
        }

        return $this;
    } // setCivGear()

    /**
     * Set the value of [cop_gear] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setCopGear($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cop_gear !== $v) {
            $this->cop_gear = $v;
            $this->modifiedColumns[PlayerTableMap::COL_COP_GEAR] = true;
        }

        return $this;
    } // setCopGear()

    /**
     * Set the value of [med_gear] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setMedGear($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->med_gear !== $v) {
            $this->med_gear = $v;
            $this->modifiedColumns[PlayerTableMap::COL_MED_GEAR] = true;
        }

        return $this;
    } // setMedGear()

    /**
     * Set the value of [civ_stats] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setCivStats($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->civ_stats !== $v) {
            $this->civ_stats = $v;
            $this->modifiedColumns[PlayerTableMap::COL_CIV_STATS] = true;
        }

        return $this;
    } // setCivStats()

    /**
     * Set the value of [cop_stats] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setCopStats($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cop_stats !== $v) {
            $this->cop_stats = $v;
            $this->modifiedColumns[PlayerTableMap::COL_COP_STATS] = true;
        }

        return $this;
    } // setCopStats()

    /**
     * Set the value of [med_stats] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setMedStats($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->med_stats !== $v) {
            $this->med_stats = $v;
            $this->modifiedColumns[PlayerTableMap::COL_MED_STATS] = true;
        }

        return $this;
    } // setMedStats()

    /**
     * Sets the value of the [arrested] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setArrested($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->arrested !== $v) {
            $this->arrested = $v;
            $this->modifiedColumns[PlayerTableMap::COL_ARRESTED] = true;
        }

        return $this;
    } // setArrested()

    /**
     * Set the value of [adminlevel] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setAdminlevel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->adminlevel !== $v) {
            $this->adminlevel = $v;
            $this->modifiedColumns[PlayerTableMap::COL_ADMINLEVEL] = true;
        }

        return $this;
    } // setAdminlevel()

    /**
     * Set the value of [donorlevel] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setDonorlevel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->donorlevel !== $v) {
            $this->donorlevel = $v;
            $this->modifiedColumns[PlayerTableMap::COL_DONORLEVEL] = true;
        }

        return $this;
    } // setDonorlevel()

    /**
     * Sets the value of the [blacklist] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
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
            $this->modifiedColumns[PlayerTableMap::COL_BLACKLIST] = true;
        }

        return $this;
    } // setBlacklist()

    /**
     * Sets the value of the [civ_alive] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setCivAlive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->civ_alive !== $v) {
            $this->civ_alive = $v;
            $this->modifiedColumns[PlayerTableMap::COL_CIV_ALIVE] = true;
        }

        return $this;
    } // setCivAlive()

    /**
     * Set the value of [civ_position] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setCivPosition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->civ_position !== $v) {
            $this->civ_position = $v;
            $this->modifiedColumns[PlayerTableMap::COL_CIV_POSITION] = true;
        }

        return $this;
    } // setCivPosition()

    /**
     * Set the value of [playtime] column.
     *
     * @param string $v new value
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setPlaytime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->playtime !== $v) {
            $this->playtime = $v;
            $this->modifiedColumns[PlayerTableMap::COL_PLAYTIME] = true;
        }

        return $this;
    } // setPlaytime()

    /**
     * Sets the value of [insert_time] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setInsertTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->insert_time !== null || $dt !== null) {
            if ($this->insert_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->insert_time->format("Y-m-d H:i:s.u")) {
                $this->insert_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PlayerTableMap::COL_INSERT_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setInsertTime()

    /**
     * Sets the value of [last_seen] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object (for fluent API support)
     */
    public function setLastSeen($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->last_seen !== null || $dt !== null) {
            if ($this->last_seen === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->last_seen->format("Y-m-d H:i:s.u")) {
                $this->last_seen = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PlayerTableMap::COL_LAST_SEEN] = true;
            }
        } // if either are not null

        return $this;
    } // setLastSeen()

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
            if ($this->cash !== 0) {
                return false;
            }

            if ($this->bankacc !== 0) {
                return false;
            }

            if ($this->coplevel !== '0') {
                return false;
            }

            if ($this->mediclevel !== '0') {
                return false;
            }

            if ($this->civ_stats !== '"[100,100,0]"') {
                return false;
            }

            if ($this->cop_stats !== '"[100,100,0]"') {
                return false;
            }

            if ($this->med_stats !== '"[100,100,0]"') {
                return false;
            }

            if ($this->arrested !== false) {
                return false;
            }

            if ($this->adminlevel !== '0') {
                return false;
            }

            if ($this->donorlevel !== '0') {
                return false;
            }

            if ($this->blacklist !== false) {
                return false;
            }

            if ($this->civ_alive !== false) {
                return false;
            }

            if ($this->civ_position !== '"[]"') {
                return false;
            }

            if ($this->playtime !== '"[0,0,0]"') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PlayerTableMap::translateFieldName('Uid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PlayerTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PlayerTableMap::translateFieldName('Aliases', TableMap::TYPE_PHPNAME, $indexType)];
            $this->aliases = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PlayerTableMap::translateFieldName('Playerid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->playerid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PlayerTableMap::translateFieldName('Cash', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cash = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PlayerTableMap::translateFieldName('Bankacc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bankacc = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PlayerTableMap::translateFieldName('Coplevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->coplevel = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PlayerTableMap::translateFieldName('Mediclevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mediclevel = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PlayerTableMap::translateFieldName('CivLicenses', TableMap::TYPE_PHPNAME, $indexType)];
            $this->civ_licenses = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PlayerTableMap::translateFieldName('CopLicenses', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cop_licenses = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : PlayerTableMap::translateFieldName('MedLicenses', TableMap::TYPE_PHPNAME, $indexType)];
            $this->med_licenses = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : PlayerTableMap::translateFieldName('CivGear', TableMap::TYPE_PHPNAME, $indexType)];
            $this->civ_gear = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : PlayerTableMap::translateFieldName('CopGear', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cop_gear = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : PlayerTableMap::translateFieldName('MedGear', TableMap::TYPE_PHPNAME, $indexType)];
            $this->med_gear = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : PlayerTableMap::translateFieldName('CivStats', TableMap::TYPE_PHPNAME, $indexType)];
            $this->civ_stats = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : PlayerTableMap::translateFieldName('CopStats', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cop_stats = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : PlayerTableMap::translateFieldName('MedStats', TableMap::TYPE_PHPNAME, $indexType)];
            $this->med_stats = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : PlayerTableMap::translateFieldName('Arrested', TableMap::TYPE_PHPNAME, $indexType)];
            $this->arrested = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : PlayerTableMap::translateFieldName('Adminlevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->adminlevel = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : PlayerTableMap::translateFieldName('Donorlevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->donorlevel = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : PlayerTableMap::translateFieldName('Blacklist', TableMap::TYPE_PHPNAME, $indexType)];
            $this->blacklist = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : PlayerTableMap::translateFieldName('CivAlive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->civ_alive = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : PlayerTableMap::translateFieldName('CivPosition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->civ_position = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : PlayerTableMap::translateFieldName('Playtime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->playtime = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : PlayerTableMap::translateFieldName('InsertTime', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->insert_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : PlayerTableMap::translateFieldName('LastSeen', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->last_seen = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 26; // 26 = PlayerTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Slimworks\\Models\\ArmaLife\\Player'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(PlayerTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPlayerQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
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
     * @see Player::setDeleted()
     * @see Player::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PlayerTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPlayerQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PlayerTableMap::DATABASE_NAME);
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
                PlayerTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[PlayerTableMap::COL_UID] = true;
        if (null !== $this->uid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PlayerTableMap::COL_UID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PlayerTableMap::COL_UID)) {
            $modifiedColumns[':p' . $index++]  = 'uid';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_ALIASES)) {
            $modifiedColumns[':p' . $index++]  = 'aliases';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_PLAYERID)) {
            $modifiedColumns[':p' . $index++]  = 'playerid';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_CASH)) {
            $modifiedColumns[':p' . $index++]  = 'cash';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_BANKACC)) {
            $modifiedColumns[':p' . $index++]  = 'bankacc';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_COPLEVEL)) {
            $modifiedColumns[':p' . $index++]  = 'coplevel';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_MEDICLEVEL)) {
            $modifiedColumns[':p' . $index++]  = 'mediclevel';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_CIV_LICENSES)) {
            $modifiedColumns[':p' . $index++]  = 'civ_licenses';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_COP_LICENSES)) {
            $modifiedColumns[':p' . $index++]  = 'cop_licenses';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_MED_LICENSES)) {
            $modifiedColumns[':p' . $index++]  = 'med_licenses';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_CIV_GEAR)) {
            $modifiedColumns[':p' . $index++]  = 'civ_gear';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_COP_GEAR)) {
            $modifiedColumns[':p' . $index++]  = 'cop_gear';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_MED_GEAR)) {
            $modifiedColumns[':p' . $index++]  = 'med_gear';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_CIV_STATS)) {
            $modifiedColumns[':p' . $index++]  = 'civ_stats';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_COP_STATS)) {
            $modifiedColumns[':p' . $index++]  = 'cop_stats';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_MED_STATS)) {
            $modifiedColumns[':p' . $index++]  = 'med_stats';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_ARRESTED)) {
            $modifiedColumns[':p' . $index++]  = 'arrested';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_ADMINLEVEL)) {
            $modifiedColumns[':p' . $index++]  = 'adminlevel';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_DONORLEVEL)) {
            $modifiedColumns[':p' . $index++]  = 'donorlevel';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_BLACKLIST)) {
            $modifiedColumns[':p' . $index++]  = 'blacklist';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_CIV_ALIVE)) {
            $modifiedColumns[':p' . $index++]  = 'civ_alive';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_CIV_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'civ_position';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_PLAYTIME)) {
            $modifiedColumns[':p' . $index++]  = 'playtime';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_INSERT_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'insert_time';
        }
        if ($this->isColumnModified(PlayerTableMap::COL_LAST_SEEN)) {
            $modifiedColumns[':p' . $index++]  = 'last_seen';
        }

        $sql = sprintf(
            'INSERT INTO players (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'uid':
                        $stmt->bindValue($identifier, $this->uid, PDO::PARAM_INT);
                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'aliases':
                        $stmt->bindValue($identifier, $this->aliases, PDO::PARAM_STR);
                        break;
                    case 'playerid':
                        $stmt->bindValue($identifier, $this->playerid, PDO::PARAM_STR);
                        break;
                    case 'cash':
                        $stmt->bindValue($identifier, $this->cash, PDO::PARAM_INT);
                        break;
                    case 'bankacc':
                        $stmt->bindValue($identifier, $this->bankacc, PDO::PARAM_INT);
                        break;
                    case 'coplevel':
                        $stmt->bindValue($identifier, $this->coplevel, PDO::PARAM_STR);
                        break;
                    case 'mediclevel':
                        $stmt->bindValue($identifier, $this->mediclevel, PDO::PARAM_STR);
                        break;
                    case 'civ_licenses':
                        $stmt->bindValue($identifier, $this->civ_licenses, PDO::PARAM_STR);
                        break;
                    case 'cop_licenses':
                        $stmt->bindValue($identifier, $this->cop_licenses, PDO::PARAM_STR);
                        break;
                    case 'med_licenses':
                        $stmt->bindValue($identifier, $this->med_licenses, PDO::PARAM_STR);
                        break;
                    case 'civ_gear':
                        $stmt->bindValue($identifier, $this->civ_gear, PDO::PARAM_STR);
                        break;
                    case 'cop_gear':
                        $stmt->bindValue($identifier, $this->cop_gear, PDO::PARAM_STR);
                        break;
                    case 'med_gear':
                        $stmt->bindValue($identifier, $this->med_gear, PDO::PARAM_STR);
                        break;
                    case 'civ_stats':
                        $stmt->bindValue($identifier, $this->civ_stats, PDO::PARAM_STR);
                        break;
                    case 'cop_stats':
                        $stmt->bindValue($identifier, $this->cop_stats, PDO::PARAM_STR);
                        break;
                    case 'med_stats':
                        $stmt->bindValue($identifier, $this->med_stats, PDO::PARAM_STR);
                        break;
                    case 'arrested':
                        $stmt->bindValue($identifier, (int) $this->arrested, PDO::PARAM_INT);
                        break;
                    case 'adminlevel':
                        $stmt->bindValue($identifier, $this->adminlevel, PDO::PARAM_STR);
                        break;
                    case 'donorlevel':
                        $stmt->bindValue($identifier, $this->donorlevel, PDO::PARAM_STR);
                        break;
                    case 'blacklist':
                        $stmt->bindValue($identifier, (int) $this->blacklist, PDO::PARAM_INT);
                        break;
                    case 'civ_alive':
                        $stmt->bindValue($identifier, (int) $this->civ_alive, PDO::PARAM_INT);
                        break;
                    case 'civ_position':
                        $stmt->bindValue($identifier, $this->civ_position, PDO::PARAM_STR);
                        break;
                    case 'playtime':
                        $stmt->bindValue($identifier, $this->playtime, PDO::PARAM_STR);
                        break;
                    case 'insert_time':
                        $stmt->bindValue($identifier, $this->insert_time ? $this->insert_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'last_seen':
                        $stmt->bindValue($identifier, $this->last_seen ? $this->last_seen->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
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
        $this->setUid($pk);

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
        $pos = PlayerTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getUid();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getAliases();
                break;
            case 3:
                return $this->getPlayerid();
                break;
            case 4:
                return $this->getCash();
                break;
            case 5:
                return $this->getBankacc();
                break;
            case 6:
                return $this->getCoplevel();
                break;
            case 7:
                return $this->getMediclevel();
                break;
            case 8:
                return $this->getCivLicenses();
                break;
            case 9:
                return $this->getCopLicenses();
                break;
            case 10:
                return $this->getMedLicenses();
                break;
            case 11:
                return $this->getCivGear();
                break;
            case 12:
                return $this->getCopGear();
                break;
            case 13:
                return $this->getMedGear();
                break;
            case 14:
                return $this->getCivStats();
                break;
            case 15:
                return $this->getCopStats();
                break;
            case 16:
                return $this->getMedStats();
                break;
            case 17:
                return $this->getArrested();
                break;
            case 18:
                return $this->getAdminlevel();
                break;
            case 19:
                return $this->getDonorlevel();
                break;
            case 20:
                return $this->getBlacklist();
                break;
            case 21:
                return $this->getCivAlive();
                break;
            case 22:
                return $this->getCivPosition();
                break;
            case 23:
                return $this->getPlaytime();
                break;
            case 24:
                return $this->getInsertTime();
                break;
            case 25:
                return $this->getLastSeen();
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

        if (isset($alreadyDumpedObjects['Player'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Player'][$this->hashCode()] = true;
        $keys = PlayerTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getUid(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getAliases(),
            $keys[3] => $this->getPlayerid(),
            $keys[4] => $this->getCash(),
            $keys[5] => $this->getBankacc(),
            $keys[6] => $this->getCoplevel(),
            $keys[7] => $this->getMediclevel(),
            $keys[8] => $this->getCivLicenses(),
            $keys[9] => $this->getCopLicenses(),
            $keys[10] => $this->getMedLicenses(),
            $keys[11] => $this->getCivGear(),
            $keys[12] => $this->getCopGear(),
            $keys[13] => $this->getMedGear(),
            $keys[14] => $this->getCivStats(),
            $keys[15] => $this->getCopStats(),
            $keys[16] => $this->getMedStats(),
            $keys[17] => $this->getArrested(),
            $keys[18] => $this->getAdminlevel(),
            $keys[19] => $this->getDonorlevel(),
            $keys[20] => $this->getBlacklist(),
            $keys[21] => $this->getCivAlive(),
            $keys[22] => $this->getCivPosition(),
            $keys[23] => $this->getPlaytime(),
            $keys[24] => $this->getInsertTime(),
            $keys[25] => $this->getLastSeen(),
        );
        if ($result[$keys[24]] instanceof \DateTime) {
            $result[$keys[24]] = $result[$keys[24]]->format('c');
        }

        if ($result[$keys[25]] instanceof \DateTime) {
            $result[$keys[25]] = $result[$keys[25]]->format('c');
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
     * @return $this|\Slimworks\Models\ArmaLife\Player
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PlayerTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Slimworks\Models\ArmaLife\Player
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setUid($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setAliases($value);
                break;
            case 3:
                $this->setPlayerid($value);
                break;
            case 4:
                $this->setCash($value);
                break;
            case 5:
                $this->setBankacc($value);
                break;
            case 6:
                $this->setCoplevel($value);
                break;
            case 7:
                $this->setMediclevel($value);
                break;
            case 8:
                $this->setCivLicenses($value);
                break;
            case 9:
                $this->setCopLicenses($value);
                break;
            case 10:
                $this->setMedLicenses($value);
                break;
            case 11:
                $this->setCivGear($value);
                break;
            case 12:
                $this->setCopGear($value);
                break;
            case 13:
                $this->setMedGear($value);
                break;
            case 14:
                $this->setCivStats($value);
                break;
            case 15:
                $this->setCopStats($value);
                break;
            case 16:
                $this->setMedStats($value);
                break;
            case 17:
                $this->setArrested($value);
                break;
            case 18:
                $this->setAdminlevel($value);
                break;
            case 19:
                $this->setDonorlevel($value);
                break;
            case 20:
                $this->setBlacklist($value);
                break;
            case 21:
                $this->setCivAlive($value);
                break;
            case 22:
                $this->setCivPosition($value);
                break;
            case 23:
                $this->setPlaytime($value);
                break;
            case 24:
                $this->setInsertTime($value);
                break;
            case 25:
                $this->setLastSeen($value);
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
        $keys = PlayerTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setUid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAliases($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPlayerid($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCash($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setBankacc($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCoplevel($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setMediclevel($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCivLicenses($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCopLicenses($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setMedLicenses($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCivGear($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCopGear($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setMedGear($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setCivStats($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setCopStats($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setMedStats($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setArrested($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setAdminlevel($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setDonorlevel($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setBlacklist($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setCivAlive($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setCivPosition($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setPlaytime($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setInsertTime($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setLastSeen($arr[$keys[25]]);
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
     * @return $this|\Slimworks\Models\ArmaLife\Player The current object, for fluid interface
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
        $criteria = new Criteria(PlayerTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PlayerTableMap::COL_UID)) {
            $criteria->add(PlayerTableMap::COL_UID, $this->uid);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_NAME)) {
            $criteria->add(PlayerTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_ALIASES)) {
            $criteria->add(PlayerTableMap::COL_ALIASES, $this->aliases);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_PLAYERID)) {
            $criteria->add(PlayerTableMap::COL_PLAYERID, $this->playerid);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_CASH)) {
            $criteria->add(PlayerTableMap::COL_CASH, $this->cash);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_BANKACC)) {
            $criteria->add(PlayerTableMap::COL_BANKACC, $this->bankacc);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_COPLEVEL)) {
            $criteria->add(PlayerTableMap::COL_COPLEVEL, $this->coplevel);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_MEDICLEVEL)) {
            $criteria->add(PlayerTableMap::COL_MEDICLEVEL, $this->mediclevel);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_CIV_LICENSES)) {
            $criteria->add(PlayerTableMap::COL_CIV_LICENSES, $this->civ_licenses);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_COP_LICENSES)) {
            $criteria->add(PlayerTableMap::COL_COP_LICENSES, $this->cop_licenses);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_MED_LICENSES)) {
            $criteria->add(PlayerTableMap::COL_MED_LICENSES, $this->med_licenses);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_CIV_GEAR)) {
            $criteria->add(PlayerTableMap::COL_CIV_GEAR, $this->civ_gear);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_COP_GEAR)) {
            $criteria->add(PlayerTableMap::COL_COP_GEAR, $this->cop_gear);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_MED_GEAR)) {
            $criteria->add(PlayerTableMap::COL_MED_GEAR, $this->med_gear);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_CIV_STATS)) {
            $criteria->add(PlayerTableMap::COL_CIV_STATS, $this->civ_stats);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_COP_STATS)) {
            $criteria->add(PlayerTableMap::COL_COP_STATS, $this->cop_stats);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_MED_STATS)) {
            $criteria->add(PlayerTableMap::COL_MED_STATS, $this->med_stats);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_ARRESTED)) {
            $criteria->add(PlayerTableMap::COL_ARRESTED, $this->arrested);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_ADMINLEVEL)) {
            $criteria->add(PlayerTableMap::COL_ADMINLEVEL, $this->adminlevel);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_DONORLEVEL)) {
            $criteria->add(PlayerTableMap::COL_DONORLEVEL, $this->donorlevel);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_BLACKLIST)) {
            $criteria->add(PlayerTableMap::COL_BLACKLIST, $this->blacklist);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_CIV_ALIVE)) {
            $criteria->add(PlayerTableMap::COL_CIV_ALIVE, $this->civ_alive);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_CIV_POSITION)) {
            $criteria->add(PlayerTableMap::COL_CIV_POSITION, $this->civ_position);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_PLAYTIME)) {
            $criteria->add(PlayerTableMap::COL_PLAYTIME, $this->playtime);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_INSERT_TIME)) {
            $criteria->add(PlayerTableMap::COL_INSERT_TIME, $this->insert_time);
        }
        if ($this->isColumnModified(PlayerTableMap::COL_LAST_SEEN)) {
            $criteria->add(PlayerTableMap::COL_LAST_SEEN, $this->last_seen);
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
        $criteria = ChildPlayerQuery::create();
        $criteria->add(PlayerTableMap::COL_UID, $this->uid);

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
        $validPk = null !== $this->getUid();

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
        return $this->getUid();
    }

    /**
     * Generic method to set the primary key (uid column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setUid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getUid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Slimworks\Models\ArmaLife\Player (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setAliases($this->getAliases());
        $copyObj->setPlayerid($this->getPlayerid());
        $copyObj->setCash($this->getCash());
        $copyObj->setBankacc($this->getBankacc());
        $copyObj->setCoplevel($this->getCoplevel());
        $copyObj->setMediclevel($this->getMediclevel());
        $copyObj->setCivLicenses($this->getCivLicenses());
        $copyObj->setCopLicenses($this->getCopLicenses());
        $copyObj->setMedLicenses($this->getMedLicenses());
        $copyObj->setCivGear($this->getCivGear());
        $copyObj->setCopGear($this->getCopGear());
        $copyObj->setMedGear($this->getMedGear());
        $copyObj->setCivStats($this->getCivStats());
        $copyObj->setCopStats($this->getCopStats());
        $copyObj->setMedStats($this->getMedStats());
        $copyObj->setArrested($this->getArrested());
        $copyObj->setAdminlevel($this->getAdminlevel());
        $copyObj->setDonorlevel($this->getDonorlevel());
        $copyObj->setBlacklist($this->getBlacklist());
        $copyObj->setCivAlive($this->getCivAlive());
        $copyObj->setCivPosition($this->getCivPosition());
        $copyObj->setPlaytime($this->getPlaytime());
        $copyObj->setInsertTime($this->getInsertTime());
        $copyObj->setLastSeen($this->getLastSeen());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setUid(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Slimworks\Models\ArmaLife\Player Clone of current object.
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
        $this->uid = null;
        $this->name = null;
        $this->aliases = null;
        $this->playerid = null;
        $this->cash = null;
        $this->bankacc = null;
        $this->coplevel = null;
        $this->mediclevel = null;
        $this->civ_licenses = null;
        $this->cop_licenses = null;
        $this->med_licenses = null;
        $this->civ_gear = null;
        $this->cop_gear = null;
        $this->med_gear = null;
        $this->civ_stats = null;
        $this->cop_stats = null;
        $this->med_stats = null;
        $this->arrested = null;
        $this->adminlevel = null;
        $this->donorlevel = null;
        $this->blacklist = null;
        $this->civ_alive = null;
        $this->civ_position = null;
        $this->playtime = null;
        $this->insert_time = null;
        $this->last_seen = null;
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
        return (string) $this->exportTo(PlayerTableMap::DEFAULT_STRING_FORMAT);
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
