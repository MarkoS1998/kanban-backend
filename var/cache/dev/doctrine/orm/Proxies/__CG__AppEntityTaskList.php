<?php

namespace Proxies\__CG__\App\Entity;


/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class TaskList extends \App\Entity\TaskList implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\Entity\\TaskList' . "\0" . 'id', '' . "\0" . 'App\\Entity\\TaskList' . "\0" . 'name', '' . "\0" . 'App\\Entity\\TaskList' . "\0" . 'open_tasks', '' . "\0" . 'App\\Entity\\TaskList' . "\0" . 'completed_tasks', '' . "\0" . 'App\\Entity\\TaskList' . "\0" . 'position', '' . "\0" . 'App\\Entity\\TaskList' . "\0" . 'is_completed', '' . "\0" . 'App\\Entity\\TaskList' . "\0" . 'is_trashed', '' . "\0" . 'App\\Entity\\TaskList' . "\0" . 'tasks'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entity\\TaskList' . "\0" . 'id', '' . "\0" . 'App\\Entity\\TaskList' . "\0" . 'name', '' . "\0" . 'App\\Entity\\TaskList' . "\0" . 'open_tasks', '' . "\0" . 'App\\Entity\\TaskList' . "\0" . 'completed_tasks', '' . "\0" . 'App\\Entity\\TaskList' . "\0" . 'position', '' . "\0" . 'App\\Entity\\TaskList' . "\0" . 'is_completed', '' . "\0" . 'App\\Entity\\TaskList' . "\0" . 'is_trashed', '' . "\0" . 'App\\Entity\\TaskList' . "\0" . 'tasks'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (TaskList $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load(): void
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized(): bool
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized): void
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null): void
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer(): ?\Closure
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null): void
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner(): ?\Closure
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties(): array
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getName', []);

        return parent::getName();
    }

    /**
     * {@inheritDoc}
     */
    public function setName(string $name): static
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setName', [$name]);

        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getOpenTasks(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOpenTasks', []);

        return parent::getOpenTasks();
    }

    /**
     * {@inheritDoc}
     */
    public function setOpenTasks(int $open_tasks): static
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOpenTasks', [$open_tasks]);

        return parent::setOpenTasks($open_tasks);
    }

    /**
     * {@inheritDoc}
     */
    public function getCompletedTasks(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCompletedTasks', []);

        return parent::getCompletedTasks();
    }

    /**
     * {@inheritDoc}
     */
    public function setCompletedTasks(int $completed_tasks): static
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCompletedTasks', [$completed_tasks]);

        return parent::setCompletedTasks($completed_tasks);
    }

    /**
     * {@inheritDoc}
     */
    public function getPosition(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPosition', []);

        return parent::getPosition();
    }

    /**
     * {@inheritDoc}
     */
    public function setPosition(int $position): static
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPosition', [$position]);

        return parent::setPosition($position);
    }

    /**
     * {@inheritDoc}
     */
    public function isIsCompleted(): ?bool
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isIsCompleted', []);

        return parent::isIsCompleted();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsCompleted(bool $is_completed): static
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsCompleted', [$is_completed]);

        return parent::setIsCompleted($is_completed);
    }

    /**
     * {@inheritDoc}
     */
    public function isIsTrashed(): ?bool
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isIsTrashed', []);

        return parent::isIsTrashed();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsTrashed(bool $is_trashed): static
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsTrashed', [$is_trashed]);

        return parent::setIsTrashed($is_trashed);
    }

    /**
     * {@inheritDoc}
     */
    public function getTasks(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTasks', []);

        return parent::getTasks();
    }

    /**
     * {@inheritDoc}
     */
    public function addTask(\App\Entity\Task $task): static
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addTask', [$task]);

        return parent::addTask($task);
    }

    /**
     * {@inheritDoc}
     */
    public function removeTask(\App\Entity\Task $task): static
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeTask', [$task]);

        return parent::removeTask($task);
    }

}
