<?php namespace App\Router;

class RouteBind
{
    const TYPE_INT = 'int';
    const TYPE_FILTER = 'filter';


    /** @var string */
    public $variable;
    /** @var string */
    public $type;
    /** @var callable|null */
    public $filterFunction;

    /**
     * RouteBind constructor.
     * @param string $variable
     * @param string $type
     * @param callable|null $filterFunction
     */
    public function __construct(string $variable, string $type, ?callable $filterFunction = null)
    {
        $this->variable = $variable;
        $this->type = $type;
        $this->filterFunction = $filterFunction;
    }

    public function checkValue(string $value){
        switch ($this->type){
            case self::TYPE_INT : return ctype_digit($value);
            case self::TYPE_FILTER : return ($this->filterFunction)($value);
        }
    }
}