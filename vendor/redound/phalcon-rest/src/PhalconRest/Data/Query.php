<?php

namespace PhalconRest\Data;

use PhalconRest\Data\Query\Condition;
use PhalconRest\Data\Query\Sorter;

class Query
{
    const OPERATOR_IS_EQUAL = 0;
    const OPERATOR_IS_GREATER_THAN = 1;
    const OPERATOR_IS_GREATER_THAN_OR_EQUAL = 2;
    const OPERATOR_IS_IN = 3;
    const OPERATOR_IS_LESS_THAN = 4;
    const OPERATOR_IS_LESS_THAN_OR_EQUAL = 5;
    const OPERATOR_IS_LIKE = 6;
    const OPERATOR_IS_NOT_EQUAL = 7;

    protected $offset = null;
    protected $limit = null;
    protected $fields = [];
    protected $conditions = [];
    protected $sorters = [];

    public function __construct()
    {

    }


    public function addField($field)
    {
        $this->fields[] = $field;
        return $this;
    }

    public function addManyFields($fields)
    {
        $this->fields = array_merge($this->fields, $fields);
        return $this;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function hasFields()
    {
        return !empty($this->fields);
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function hasOffset()
    {
        return !is_null($this->offset);
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function hasLimit()
    {
        return !is_null($this->limit);
    }

    public function addCondition(Condition $condition)
    {
        $this->conditions[] = $condition;
        return $this;
    }

    public function addManyConditions($conditions)
    {
        $this->conditions = array_merge($this->conditions, $conditions);
        return $this;
    }

    public function getConditions()
    {
        return $this->conditions;
    }

    public function hasConditions()
    {
        return !empty($this->conditions);
    }

    public function addSorter(Sorter $sorter)
    {
        $this->sorters[] = $sorter;
        return $this;
    }

    public function addManySorters($sorters)
    {
        $this->sorters = array_merge($this->sorters, $sorters);
        return $this;
    }

    public function getSorters()
    {
        return $this->sorters;
    }

    public function hasSorters()
    {
        return !empty($this->sorters);
    }

    public function merge(Query $query)
    {
        if ($query->hasFields()) {
            $this->addManyFields($query->getFields());
        }

        if ($query->hasOffset()) {
            $this->setOffset($query->getOffset());
        }

        if ($query->hasLimit()) {
            $this->setLimit($query->getLimit());
        }

        if ($query->hasConditions()) {
            $this->addManyConditions($query->getConditions());
        }

        if ($query->hasSorters()) {
            $this->addManySorters($query->getSorters());
        }

        return $this;
    }
}